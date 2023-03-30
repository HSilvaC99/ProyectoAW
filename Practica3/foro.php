<?php

require_once __DIR__ . '/includes/config.php';

use es\ucm\fdi\aw\src\DAO\AnswerDAO;
use es\ucm\fdi\aw\src\DAO\QuestionDAO;
use es\ucm\fdi\aw\src\DAO\UserRolesDAO;

// Obtener la información del usuario actual desde la sesión

$user = isset($_SESSION['user']) ? $_SESSION['user'] : null;
// Verificar si el usuario actual es un administrador
$isAdmin = false;

if ($user) {
  $userRolesDAO = new UserRolesDAO();
  $userRoles = $userRolesDAO->get('user_mail', $user['mail']);

  foreach ($userRoles as $userRole) {
    if ($userRole['role'] == 'admin') {
      $isAdmin = true;
      break;
    }
  }
}
/*if (!isset($_SESSION['user'])) {
    header("Location: index.php");
    exit;
}*/
$questionDAO = new QuestionDAO();
$answerDAO = new AnswerDAO();

if (isset($_POST['ask_question'])) {
  $question = $_POST['question'];
  if (!isset($_SESSION['user'])) {
    echo '<script>alert("Debes estar registrado para hacer una pregunta.");</script>';
  } else {
    $user = $_SESSION['user'];
    $questionDAO->create(array('pregunta' => $question, 'fecha' => date('Y-m-d')));
  }
}

if (isset($_POST['answer_question'])) {
  $answer = $_POST['answer'];
  if (!isset($_SESSION['user'])) {
    echo '<script>alert("Debes estar registrado para responder a una pregunta.");</script>';
  } else {
    $question_id = $_POST['question_id'];
    $user = $_SESSION['user'];
    $answerDAO->create(array('id_pregunta' => $question_id, 'respuesta' => $answer,  'fecha' => date('Y-m-d')));
  }
}

// Procesar la eliminación de la pregunta si se ha enviado el formulario
if (isset($_POST['delete_question'])) {
  $question_id = $_POST['question_id'];
  if (!isset($_SESSION['user'])) {
    echo '<script>alert("Debes estar registrado para eliminar una pregunta.");</script>';
  } else {
    $answerDAO->delete('id', $question_id);
    $questionDAO->delete('id_pregunta', $question_id);
  }
}

$questions = $questionDAO->getAll();
$answers = $answerDAO->getAll();

$title = 'Foro de preguntas y respuestas'
?>

<?php ob_start(); ?>

<h2 class="mb-3 d-flex justify-content-center">Bienvenido al foro de preguntas y respuestas</h2>
<h3 class="mb-3 d-flex justify-content-center">Realiza una pregunta</h3>
<div class="container">
  <div class="mb-3">
    <form method="POST" action="">
      <label for="exampleFormControlTextarea1" class="form-label">Escribe aquí tu pregunta</label>
      <textarea name="question" class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea><br>
      <input type="submit" name="ask_question" value="Enviar pregunta" class="btn btn-primary">
    </form>
  </div>
</div>
<hr>
<h3 class="mb-3 d-flex justify-content-center">Preguntas y respuestas</h3>
<div class="container">
  <table class="table">
    <thead>
      <tr>
        <th scope="col">#</th>
        <th scope="col">Pregunta</th>
        <th scope="col">Respuestas</th>
        <th scope="col">Responder</th>
        <th scope="col"> </th>
        <th scope="col"> </th>
      </tr>
    </thead>
    <tbody>
      <?php foreach ($questions as $key => $question) : ?>
        <tr>
          <th scope="row"><?= $key + 1 ?></th>
          <td><?= $question['pregunta'] ?></td>
          <td>
            <?php foreach ($answers as $answer) : ?>
              <?php if ($answer['id_pregunta'] == $question['id']) : ?>
                <p><?= $answer['respuesta'] ?></p>
              <?php endif; ?>
            <?php endforeach; ?>
          </td>
          <td>
            <form method="POST" action="">
              <input type="hidden" name="question_id" value="<?= $question['id'] ?>">
              <textarea name="answer" class="form-control" rows="3"></textarea><br>
              <input type="submit" name="answer_question" value="Responder" class="btn btn-primary">
            </form>
          </td>
          <?php if ($isAdmin) : ?>
            <td>
              <form method="POST" action="">
                <input type="hidden" name="question_id" value="<?= $question['id'] ?>">
                <input type="submit" name="delete_question" value="Eliminar" class="btn btn-danger">
              </form>
            </td>
            <td>
              <form method="GET" action="editarforo.php">
                <input type="hidden" name="question_id" value="<?php echo $question['id']; ?>">
                <input type="hidden" name="question_text" value="<?php echo $question['pregunta']; ?>">
                <input type="hidden" name="pregunta" value="<?php echo $question['pregunta']; ?>">
                <button type="submit" name="edit_question" class="btn btn-primary">Editar</button>
              </form>
            </td>
          <?php endif; ?>
        </tr>
      <?php endforeach; ?>
    </tbody>
  </table>
</div>

<!--MODAL-->
<div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="editModalLabel">Editar pregunta y respuesta</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
      </div>
      <div class="modal-body">
        <form id="editForm">
          <div class="mb-3">
            <label for="editQuestion" class="form-label">Pregunta</label>
            <textarea class="form-control" id="editQuestion" name="editQuestion" rows="3"></textarea>
          </div>
          <div class="mb-3">
            <label for="editAnswer" class="form-label">Respuesta</label>
            <textarea class="form-control" id="editAnswer" name="editAnswer" rows="3"></textarea>
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
        <button type="button" class="btn btn-primary" id="saveChangesBtn">Guardar cambios</button>
      </div>
    </div>
  </div>
</div>

<!--SCRIPT-->
<script>
  $(document).ready(function() {
    $('.btn-edit').click(function() {
      var id = $(this).data('id');
      $.ajax({
        url: 'get_question.php',
        type: 'POST',
        data: {
          id: id
        },
        success: function(response) {
          var data = JSON.parse(response);
          $('#editForm input[name="id"]').val(data.id);
          $('#editForm textarea[name="question"]').val(data.pregunta);
          $('#editModal').modal('show');
        },
        error: function(xhr, status, error) {
          console.log(xhr.responseText);
        }
      });
    });
  });
</script>

<?php $content = ob_get_clean(); ?>

<?php require 'includes/template/template.php'; ?>