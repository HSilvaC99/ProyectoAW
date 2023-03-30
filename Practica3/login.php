<?php
  require_once __DIR__ . '/includes/config.php';

  use es\ucm\fdi\aw\src\DAO\UserDAO;

  $title = 'Login';
  $error = null;

  if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $userModel = new UserDAO();
    $user = $userModel->get("mail", $_POST["mail"]);
    $user = $user[0];

    if (!$user) {
      $error = "¡Error! Credenciales incorrectas.";
    }
    else {
      if (!password_verify($_POST["password"], $user["password"])) {
        $error = "¡Error! Credenciales incorrectas.";
      }
      else {
        session_start();
        unset($user["password"]);
        $_SESSION["user"] = $user;

        header("Location: index.php");
      }
    }
  }
?>

<?php ob_start() ?>
<div class="wrapper">
<div class="container d-flex justify-content-center col-lg-4" id="borders-form">
  <form class="needs-validation" method="post" action="login.php">
    <div class="row g-3 p-4">
      <h2 class="mb-3 d-flex justify-content-center">Inciar sesión</h2>

      <hr class="my-4">
      
      <?php if ($error): ?>
        <br>
        <div class="alert alert-danger m-2 justify-content-center align-center" role="alert">
          <?= $error ?>
        </div>
      <?php endif ?>

      <div class="col-sm-12">
        <label for="mail" class="form-label">Correo electrónico</label>
        <input type="email" class="form-control" name="mail" placeholder="usuario@dominio.ext" required>
        <div class="invalid-feedback">
          Por favor, introduzca una dirección de correo electrónico válida.
        </div>
      </div>

      <div class="col-sm-12">
        <label for="password" class="form-label">Contraseña</label>
        <input type="password" class="form-control" name="password" placeholder="********" required>
        <div class="invalid-feedback">
          Por favor, rellene los campos obligatorios.
        </div>
      </div>

      <hr class="my-4">

      <button class="w-100 btn btn-primary btn-lg" type="submit">Entrar</button>
  </form>
</div>
</div>
<br><br>
<?php $content = ob_get_clean(); ?>

<?php require 'includes/template/template.php'; ?>