<?php

abstract class User {
    private $m_Name;
    private $m_Email;
    private $m_PasswordHash;

    public function __construct($name, $email, $passwordHash) {
        $this->m_Name = $name;
        $this->m_Email = $email;
        $this->m_PasswordHash = $passwordHash;
    }

    //  Name
    public function getName() {
        return $this->m_Name;
    }
    public function setName($name) {
        $this->m_Name = $name;
    }
    //  Email
    public function getEmail() {
        return $this->m_Email;
    }
    public function setEmail($email) {
        $this->m_Email = $email;
    }
    //  Password hash
    public function getPasswordHash() {
        return $this->m_PasswordHash;
    }
    public function setPasswordHash($password) {
        $this->m_PasswordHash = password_hash($password, PASSWORD_BCRYPT);
    }
}
