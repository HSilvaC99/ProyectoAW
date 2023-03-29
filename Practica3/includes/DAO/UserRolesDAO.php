<?php

namespace es\ucm\fdi\aw\DAO;

require_once 'DAO.php';

class UserRolesDAO extends DAO {

    public function __construct() {
        parent::__construct("user_roles");
    }
  
    public function create($data) {
        $this->insert($data);
    }
}