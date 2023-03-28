<?php 
include 'database.php'; 
include 'includes/DAO/DAO.php'; 
include 'includes/DAO/QuestionDAO.php'; 
include 'includes/DAO/AnswerDAO.php'; 

require "includes/comun/header.php"; 

// Obtener la información del usuario actual desde la sesión 
$user = isset($_SESSION['user']) ? $_SESSION['user'] : null; 

// Verificar si el usuario actual es un administrador 
$isAdmin = $user && $user['privileged'] == 1; 

$database = new Database; 
$connection = $database->getConnection(); 

$answerDAO = new AnswerDAO($connection); 
$questionDAO = new QuestionDAO($connection); 

// Obtener el ID de la pregunta de la URL 
$preguntaId = $_GET['question_id']; 

// Obtener la pregunta y sus respuestas del DAO de preguntas y respuestas 
$answers = $answerDAO->getAll(); 

if (isset($_POST['edit_question']) && $isAdmin) { 
    // Obtener los datos del formulario 
    
    $questionText = $_POST['question_text']; 
    $answerText = $_POST['answer_text']; 

    // Actualizar la pregunta 
    $questionDAO->updateQ($preguntaId, 'pregunta', $questionText); 

    // Redirigir al usuario de vuelta al foro 
    header("Location: foro.php"); 
    exit; 
} 
?> 

<!DOCTYPE html> 
<html> 
<head> 
    <meta charset="UTF-8"> 
    <title>Editar pregunta y respuesta</title> 
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css"> 
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script> 
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script> 
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script> 
</head> 
<body> 
    <br> 

    <div class="container"> 
        <div class="row justify-content-center"> 
            <div class="col-md-8"> 
                <div class="card"> 
                    <div class="card-header">Editar pregunta </div> 
                    <div class="card-body"> 
                        <form id="editForm" method="POST"> 
                            <div class="form-group"> 
                                <label for="editQuestion">Pregunta:</label> 
                                <textarea class="form-control" id="editQuestion" name="question_text" rows="3"><?php echo htmlspecialchars($_GET['pregunta']); ?></textarea> 
                            </div> 

                            <div class="form-group"> 
                                <label for="editAnswer">Respuesta:</label> 
                                <?php foreach ($answers as $answer): ?> 
                                    <?php if ($answer['id_pregunta'] == $preguntaId): ?> 
                                        <p><textarea class="form-control" id="editAnswer" name="answer_text" rows="3" readonly><?php echo htmlspecialchars($answer['respuesta']); ?></textarea></p> 
                                    <?php endif; ?> 
                                <?php endforeach; ?> 
                            </div> 
                            <button type="submit" name="edit_question" class="btn btn-primary">Guardar cambios</button> 
                            <a href="foro.php" class="btn btn-secondary">Cerrar</a> 
                        </form> 
                    </div> 
                </div> 
            </div> 
        </div> 
    </div> 
    <?php require "includes/comun/footer.php"?> 
</body> 
</html> 

