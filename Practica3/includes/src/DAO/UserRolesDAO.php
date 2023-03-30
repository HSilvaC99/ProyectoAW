<?php

namespace es\ucm\fdi\aw\src\DAO;

class UserRolesDAO extends DAO {

    public function __construct() {
        parent::__construct("user_roles");
    }
  
    public function create($data) {
        $this->insert($data);
    }

    public function getUserRoles($userMail) {
        $db = \es\ucm\fdi\aw\Application::getSingleton()->connect();

        $statement = $db->prepare("SELECT * FROM user_roles ur WHERE ur.user_mail = :userMail");
        $statement->bindParam(':userMail', $userMail);
        $statement->execute();

        return $statement->fetchAll();
    }
}