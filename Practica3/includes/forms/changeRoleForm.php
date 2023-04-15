<?php

namespace es\ucm\fdi\aw\forms;

use es\ucm\fdi\aw\DAO\RoleDAO;
use es\ucm\fdi\aw\DAO\UserDAO;
use es\ucm\fdi\aw\DAO\UserRoleDAO;
use es\ucm\fdi\aw\DTO\UserRoleDTO;

require_once 'includes/config.php';

class ChangeRoleForm extends Form
{
    //  Constants
    private const FORM_ID = 'change-role_form';
    private const URL_REDIRECTION = 'adminPanel.php';

    //  Constructors
    public function __construct()
    {
        parent::__construct(self::FORM_ID, array(parent::URL_REDIRECTION_KEY => self::URL_REDIRECTION));
    }

    //  Methods
    protected function processForm($data)
    {
        $userID = $_REQUEST["user"];
        $roleID = $_REQUEST["role"];

        if ($userID == 0 || $roleID == 0) {
            $this->m_Errors["fields_not_selected"] = "Seleccione tanto usuario como rol para llevar a cabo esta acción";
            return;
        }

        $userRoleDAO = new UserRoleDAO;
        $userDAO = new UserDAO;
        
        $userRoles = $userDAO->getUserRoles($userID);

        if (isset($_POST["addRole"])) {
            foreach ($userRoles as $role) {
                if ($role->getID() == $roleID)
                    $this->m_Errors['role_already_assigned'] = "El rol seleccionado ya está asignado a este usuario";
                    return;
            }

            $userRoleDAO->create(new UserRoleDTO($userID, $roleID));
        }
        if (isset($_POST["deleteRole"])) {
            $userRoleDAO->deleteCompoundKey($userID, $roleID);
        }
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

        $userDAO = new UserDAO;
        $users = $userDAO->read();

        $usersHTML = '';
        foreach ($users as $user) {
            $userName = $user->getName() . " " . $user->getSurname() . " - (" . $user->getEmail() . ")";
            $usersHTML .= <<<HTML_USERS
                <option value="{$user->getID()}">{$userName}</option>
            HTML_USERS;
        }

        $roleDAO = new RoleDAO;
        $roles = $roleDAO->read();

        $rolesHTML = '';
        foreach ($roles as $role) {
            $rolesHTML .= <<<HTML_ROLES
                <option value="{$role->getID()}">{$role->getRoleName()}</option>
            HTML_ROLES;
        }

        return <<<HTML_FORM
        <div class="row">
            {$errorsHTML}
            <div class="col-12 my-2">
                <label for="name" class="form-label">Usuario</label>
                <select class="form-select" aria-label=".form-select-lg example" name="user">
                    <option selected value="0">Seleccione un usuario</option>
                    {$usersHTML}
                </select>
            </div>
            <div class="col-12 my-2">
                <label for="name" class="form-label">Rol</label>
                <select class="form-select" aria-label=".form-select-lg example" name="role">
                    <option selected value="0">Seleccione un rol</option>
                    {$rolesHTML}
                </select>
            </div>
        </div>
        <div class="row my-4">
            <div class="col m-1">
                <button class="btn btn-primary btn-lg w-100" type="submit" name="addRole">Añadir rol</button>
            </div>
            <div class="col m-1">
                <button class="btn btn-outline-danger btn-lg w-100" type="submit" name="deleteRole">Eliminar rol</button>
            </div>
        </div>
        HTML_FORM;
    }
}
