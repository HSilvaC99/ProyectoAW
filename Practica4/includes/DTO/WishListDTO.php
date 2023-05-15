<?php

namespace es\ucm\fdi\aw\DTO;

require_once dirname(__DIR__).'/config.php';

class WishListDTO extends DTO
{
    //  Fields
    private $m_ID;
    private $m_Name;
    private $m_Type;

    //  Constructors
    public function __construct($ID, $Name, $Type)
    {
        $this->m_ID = $ID;
        $this->m_Name = $Name;
        $this->m_Type = $Type;
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

    public function getType()
    {
        return $this->m_Type;
    }
}
