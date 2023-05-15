<?php

namespace es\ucm\fdi\aw\DTO;

require_once 'includes/config.php';

class CardDTO extends DTO
{
    //  Fields
    private $m_ID;
    private $m_Number;
    private $m_Expirate;
    private $m_Cvv;
    private $m_Name;

    //  Constructors
    public function __construct($id, $number, $expirate, $cvv, $name)
    {
        $this->m_ID = $id;
        $this->m_Number = $number;
        $this->m_Expirate = $expirate;
        $this->m_Cvv = $cvv;
        $this->m_Name = $name;

    }

    //  Methods
    public function getID()
    {
        return $this->m_ID;
    }

    public function getNumber()
    {
        return $this->m_Number;
    }

    public function getExpirate(){
        return $this->m_Expirate;
    }

    public function getCvv()
    {
        return $this->m_Cvv;
    }

    public function getName()
    {
        return $this->m_Name;
    }
    
}

