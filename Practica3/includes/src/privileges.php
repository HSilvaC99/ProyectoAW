<?php

include 'role.php';
include 'includes/DAO/UserRolesDAO.php';

class Privileges
{
    const DELIMITER = '.';

    private $m_PrivilegeSet;

    public function __construct()
    {
        $this->m_PrivilegeSet = array();
    }

    public static function buildFromUser($connection, $userMail) {
        $userRolesDAO = new UserRolesDAO($connection);
        $userRoles = $userRolesDAO->get('mail', $userMail);
        $privileges = new Privileges();

        foreach ($userRoles as $row) {
            $role = Role::createFromFile($row['role']);

            if ($role != null) {
                $privileges->merge($role->getPrivileges());
            }
        }

        return $privileges;
    }
    public function hasPrivilege($privilege)
    {
        return isset($this->m_PrivilegeSet[$privilege]);
    }
    public function getAllPrivileges() {
        return $this->m_PrivilegeSet;
    }
    public function addPrivilege($privilege)
    {
        $this->m_PrivilegeSet[$privilege] = true;
    }
    public function removePrivilege($privilege)
    {
        unset($this->m_PrivilegeSet[$privilege]);
    }
    public function merge($privileges) {
        foreach($privileges->m_PrivilegeSet as $key => $value) {
            $this->addPrivilege($key);
        }
    }
}