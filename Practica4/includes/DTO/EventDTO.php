<?php

namespace es\ucm\fdi\aw\DTO;

require_once dirname(__DIR__).'/config.php';

class EventDTO extends DTO
{
    //  Fields
    private $m_ID;
    private $m_Name;
    private $m_Description;
    private $m_Date;

    //  Constructors
    public function __construct($id, $name, $description, $date)
    {
        $this->m_ID = $id;
        $this->m_Name = $name;
        $this->m_Description = $description;
        $this->m_Date = $date;
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

    public function getDescription()
    {
        return $this->m_Description;
    }
    public function setDescription($description)
    {
        $this->m_Description = $description;
    }

    public function getDate()
    {
        return $this->m_Date;
    }
    public function setDate($date)
    {
        $this->m_Date = $date;
    }
}
