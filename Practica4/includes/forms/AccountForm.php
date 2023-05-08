<?php

namespace es\ucm\fdi\aw\forms;

use es\ucm\fdi\aw\DAO\UserDAO;


require_once 'includes/config.php';


class AccountForm extends Form
{
    //  Constants
    private const FORM_ID = 'account_form';
    private const URL_REDIRECTION = 'account.php';
    private $m_userID;

    //  Constructors
    public function __construct($m_userID)
    {
        $this->m_userID = $m_userID;

        parent::__construct(self::FORM_ID, array(parent::URL_REDIRECTION_KEY => self::URL_REDIRECTION . "?userID=$m_userID"));
    }

    //  Methods
    protected function processForm($data)
    {

        if (!isset($data['userName']) || empty($data['userName'])) {
            $this->m_Errors['empty_name'] = 'El nombre del usuario no puede estar vacío.';
            $success = false;
            return;
        }

        if (!isset($data['userSurname']) || empty($data['userSurname'])) {
            $this->m_Errors['empty_surname'] = 'El apellido del usuario no puede estar vacío.';
            $success = false;
            return;
        }

        if (!isset($data['email']) || empty($data['email'])) {
            $this->m_Errors['empty_email'] = 'El email del usuario no puede estar vacío.';
            $success = false;
            return;
        }

        $userDAO = new UserDAO();
        $usersDTO = $userDAO->read();

        //tambien hay que comprobar que el email del usaurio no sea igual a ninguno otro ya existente pero que sea diferente al suyo
        foreach ($usersDTO as $user) {
            if ($data["email"] == $user->getEmail() && $this->m_userID != $user->getID()) {
                $this->m_Errors['existent_email'] = 'El email del usuario ya esta registrado';
                $success = false;
                return;
            }
        }

        $usersDTO = $userDAO->read($this->m_userID)[0];
        $usersDTO->setName($data['userName']);
        $usersDTO->setSurname($data['userSurname']);
        $usersDTO->setEmail($data['email']);
        if (!$userDAO->update($usersDTO)) {
            $this->m_Errors['bad_update'] = 'Ha ocurrido un error inesperado al actualizar el usuario.';
            $success = false;
            return;
        }
    }

    protected function generateFormFields($data)
    {
        $userDAO = new UserDAO();
        $userID = $this->m_userID;
        $userDTO = $userDAO->read($this->m_userID)[0];
        $userName = $userDTO->getName();
        $userSurname = $userDTO->getSurname();
        $email = $userDTO->getEmail();
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





        return <<<HTML
        <div class="row g-3 p-5">
            <hr class="mt-1">

            {$errorsHTML}

            <div class="col-sm-12">
                <label for="email" class="form-label">Correo electrónico</label>
                <input type="email" class="form-control" name="email" value="$email" >
            </div>

            <div class="col-sm-12">
                <label for="password" class="form-label">Contraseña</label>
                <input type="password" class="form-control" name="password" placeholder="********" required readonly>
            </div>

            <div class="col-sm-6">
                <label for="userName" class="form-label">Nombre</label>
                <input type="text" class="form-control" name="userName" value="$userName" >
                
            </div>

            <div class="col-sm-6">
                <label for="userSurname" class="form-label">Apellidos</label>
                <input type="text" class="form-control" name="userSurname" value="$userSurname" >
                
            </div>
        </div>
        

        <hr class="my-4">

        <button class="w-100 btn btn-primary btn-lg" type="submit">Guardar Cambios</button>
        HTML;
    }
}
