<?php

namespace es\ucm\fdi\aw\DTO;

require_once dirname(__DIR__).'/config.php';

class CategoryDTO extends DTO
{
    //  Fields
    private $m_ID;
    private $m_Name;

    //  Constructors
    public function __construct($id, $name)
    {
        $this->m_ID = $id;
        $this->m_Name = $name;
    }

    //  Methods
    public function getID()
    {
        return $this->m_ID;
    }

    public function getName()
    {
        return $this->m_Name;
    }
    public function setName($name)
    {
        $this->m_Name = $name;
    }
}
