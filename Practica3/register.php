<?php
include 'database.php';
include 'includes/DAO/DAO.php';
include 'includes/DAO/UserDAO.php';
include 'includes/DAO/StateDAO.php';

$database = new Database;
$connection = $database->getConnection();

$stateModel = new StateDAO($connection);

$error = null;

if ($_SERVER["REQUEST_METHOD"] == "POST")
{
  $userModel = new UserDAO($connection);
  $user = $userModel->get("mail", $_POST["mail"]);

  if ($user)
  {
    $error = "Este mail ya está registrado";
  }
  else
  {
    $userData = array (
    "name" => $_POST["name"],
    "surname" => $_POST["surname"],
    "mail" => $_POST["mail"],
    "password" => password_hash($_POST["password"], PASSWORD_BCRYPT),
    "address1" => $_POST["address1"],
    "address2" => $_POST["address2"],
    "state" => $_POST["state"],
    "zip" => $_POST["zip"]
  );
  $userModel->insert($userData);
  $user = $userModel->get("mail", $_POST["mail"]);

  session_start();
  $_SESSION["user"] = $user;

  header("Location: index.php");
  }
}

$states = $stateModel->getAll();

require "includes/comun/header.php";
?>


<div class="container d-flex col-lg-5" id="borders-form">
  <form class="needs-validation" action="register.php" method="post">
    <div class="row g-3 p-4">
      <?php if ($error): ?>
        <div class="alert alert-danger m-2 align-center" role="alert">
          <?= $error ?>
        </div>
      <?php endif ?>
      <h2 class="mb-3 d-flex justify-content-center">Registro</h2>
      
      <hr class="mt-1">

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

      <div class="col-sm-6">
        <label for="firstName" class="form-label">Nombre</label>
        <input type="text" class="form-control" name="name" placeholder="Lorem" required>
        <div class="invalid-feedback">
          Por favor, rellene los campos obligatorios.
        </div>
      </div>

      <div class="col-sm-6">
        <label for="lastName" class="form-label">Apellidos</label>
        <input type="text" class="form-control" name="surname" placeholder="Ipsum" required>
        <div class="invalid-feedback">
          Por favor, rellene los campos obligatorios.
        </div>
      </div>

      <div class="col-12">
        <label for="address1" class="form-label">Dirección de correo postal</label>
        <input type="text" class="form-control" name="address1" placeholder="Calle/Avenida..." required>
        <div class="invalid-feedback">
          Por favor, rellene los campos obligatorios.
        </div>
      </div>

      <div class="col-12">
        <label for="address2" class="form-label">Portal, piso, puerta... <span
            class="text-muted">(Optional)</span></label>
        <input type="text" class="form-control" name="address2" placeholder="Portal 1, escalera A">
      </div>

      <div class="col-md-4">
        <label for="country" class="form-label">País</label>
        <span class="form-control">España</span>
      </div>

      <div class="col-md-5">
        <label for="state" class="form-label">Comunidad Autónoma</label>
        <select class="form-select" name="state" required>
          <option>Seleccionar...</option>
          <?php foreach ($states as $state): ?>
            <option><?= $state["name"] ?></option>
          <?php endforeach ?>
        </select>
        <div class="invalid-feedback">
          Por favor, rellene los campos obligatorios.
        </div>
      </div>

      <div class="col-md-3">
        <label for="zip" class="form-label">Código postal</label>
        <input type="text" class="form-control" name="zip" required>
        <div class="invalid-feedback">
          Por favor, rellene los campos obligatorios.
        </div>
      </div>
    </div>
    <div class="row g-3 m-1">
      <div class="form-check col-md-9">
        <input type="checkbox" class="form-check-input" id="same-address" required>
        <label class="form-check-label" for="same-address">Marque esta casilla para verificar que ha leído nuestros <a
            href="info.php#politica">política de privacidad</a> y los <a href="info.php#condiciones">términos y condiciones</a> del servicio.</label>
      </div>
    </div>

    <hr class="my-4">

    <button class="w-100 btn btn-primary btn-lg" type="submit">Registrarse</button>
  </form>
</div>
<br><br>
<?php require "includes/comun/footer.php" ?>