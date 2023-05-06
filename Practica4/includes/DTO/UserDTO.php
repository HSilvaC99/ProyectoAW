<?php

namespace es\ucm\fdi\aw\DTO;

require_once dirname(__DIR__).'/config.php';

class UserDTO extends DTO
{
    //  Fields
    private $m_ID;
    private $m_Name;
    private $m_Surname;
    private $m_Email;
    private $m_PasswordHash;

    //  Constructors
    public function __construct($id, $name, $surname, $email, $passwordHash)
    {
        $this->m_ID = $id;
        $this->m_Name = $name;
        $this->m_Surname = $surname;
        $this->m_Email = $email;
        $this->m_PasswordHash = $passwordHash;
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

    public function getSurname(){
        return $this->m_Surname;
    }
    public function setSurname($surname)
    {
        $this->m_Surname = $surname;
    }

    public function getEmail()
    {
        return $this->m_Email;
    }
    public function setEmail($email)
    {
        $this->m_Email = $email;
    }

    public function getPasswordHash()
    {
        return $this->m_PasswordHash;
    }
    public function setPasswordHash($passwordHash)
    {
        $this->m_PasswordHash = $passwordHash;
    }
}
