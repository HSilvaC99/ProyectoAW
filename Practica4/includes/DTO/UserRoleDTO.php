<?php

namespace es\ucm\fdi\aw\DTO;

require_once dirname(__DIR__).'/config.php';

class UserRoleDTO extends DTO
{
    //  Fields
    private $m_UserID;
    private $m_RoleID;

    //  Constructors
    public function __construct($userID, $roleID)
    {
        $this->m_UserID = $userID;
        $this->m_RoleID = $roleID;
    }

    //  Methods
    public function getUserID()
    {
        return $this->m_UserID;
    }
    
    public function getRoleID()
    {
        return $this->m_RoleID;
    }
}
