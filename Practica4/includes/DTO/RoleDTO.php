<?php

namespace es\ucm\fdi\aw\DTO;

require_once dirname(__DIR__).'/config.php';

class RoleDTO extends DTO
{
    //  Fields
    private $m_ID;
    private $m_RoleName;

    //  Constructors
    public function __construct($id, $roleName)
    {
        $this->m_ID = $id;
        $this->m_RoleName = $roleName;
    }

    //  Methods
    public function getID()
    {
        return $this->m_ID;
    }

    public function getRoleName()
    {
        return $this->m_RoleName;
    }
    public function setRoleName($roleName)
    {
        $this->m_RoleName = $roleName;
    }
}
