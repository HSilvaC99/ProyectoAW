<?php

namespace es\ucm\fdi\aw\forms;

use es\ucm\fdi\aw\Application;
use es\ucm\fdi\aw\DAO\RoleDAO;
use es\ucm\fdi\aw\DAO\UserDAO;
use es\ucm\fdi\aw\DAO\UserRoleDAO;
use es\ucm\fdi\aw\DTO\UserDTO;
use es\ucm\fdi\aw\DTO\UserRoleDTO;

require_once 'includes/config.php';

class RegisterForm extends Form
{
    //  Constants
    private const FORM_ID = 'register_form';
    private const URL_REDIRECTION = 'index.php';

    //  Constructors
    public function __construct()
    {
        parent::__construct(self::FORM_ID, array(parent::URL_REDIRECTION_KEY => self::URL_REDIRECTION));
    }

    //  Methods
    protected function processForm($data)
    {
        if (!isset($data['email']) || empty($data['email']))
            $this->m_Errors['empty_email'] = 'El email no puede estar vacío.';

        if (!isset($data['password']) || empty($data['password']))
            $this->m_Errors['empty_password'] = 'La contraseña no puede estar vacía.';

        if (!isset($data['name']) || empty($data['name']))
            $this->m_Errors['empty_name'] = 'El nombre no puede estar vacío.';

        if (!isset($data['surname']) || empty($data['surname']))
            $this->m_Errors['empty_surname'] = 'Los apellidos no pueden estar vacíos.';

        if (count($this->m_Errors) > 0)
            return;

        $email = $data['email'];
        $userDAO = new UserDAO();

        $userDTOResults = $userDAO->read(null, ['email' => $email]);

        if (count($userDTOResults) > 0) {
            $this->m_Errors['email_in_use'] = 'El email ya está en uso. Por favor, escoja otra.';
            return;
        }

        $name = $data['name'];
        $surname = $data['surname'];
        $password = filter_var($data['password'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);

        $userDTO = new UserDTO(-1, $name, $surname, $email, password_hash($password, PASSWORD_BCRYPT));

        if (!$userDAO->create($userDTO)) {
            $this->m_Errors['unknown'] = 'An unknown error has ocurred.';
            return;
        }

        $userDTO = $userDAO->read(null, ['email' => $email])[0];
        
        // Preferimos utilizar un método más ortodoxo para pedir la ID del rol
        // a la DAO, pero se podría perfectamente introducir el ID del rol a pelo.
        $roleDAO = new RoleDAO();
        $defaultRole = $roleDAO->read(null, ["roleName" => "user"])[0];
        
        $userRoleDAO = new UserRoleDAO();
        $userRoleDTO = new UserRoleDTO($userDTO->getID(), $defaultRole->getID());

        $userRoleDAO->create($userRoleDTO);

        Application::getInstance()->loginUser($userDTO);
    }
    protected function generateFormFields($data)
    {
        $errorsHTML = '';

        if (count($this->m_Errors) > 0) {
            foreach ($this->m_Errors as $error) {
                $errorsHTML .= <<<HTML_ERROR
                <div class="alert alert-danger m-2 justify-content-center align-center" role="alert">
                    <b>Error:</b> {$error}
                </div>
                HTML_ERROR;
            }
        }

        return <<<HTML_FORM
        <div class="row g-3 p-4">
            <h2 class="mb-3 d-flex justify-content-center">Registro</h2>
            
            <hr class="mt-1">

            {$errorsHTML}

            <div class="col-sm-12">
                <label for="email" class="form-label">Correo electrónico</label>
                <input type="email" class="form-control" name="email" placeholder="usuario@dominio.ext" required>
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
        </div>
        <div class="g-3 m-1">
        <div class="form-check col-md-9">
            <input type="checkbox" class="form-check-input" id="same-address" required>
            <label class="form-check-label" for="same-address">Marque esta casilla para verificar que ha leído nuestros <a
                href="information.php#politica">política de privacidad</a> y los <a href="information.php#condiciones">términos y condiciones</a> del servicio.</label>
        </div>
        </div>

        <hr class="my-4">

        <button class="w-100 btn btn-primary btn-lg" type="submit">Registrarse</button>
        HTML_FORM;
    }
}
