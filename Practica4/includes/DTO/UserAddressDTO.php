<?php

namespace es\ucm\fdi\aw\DTO;

require_once 'includes/config.php';

class UserAddressDTO extends DTO
{
    //  Fields
    private $m_UserID;
    private $m_AddressID;

    //  Constructors
    public function __construct($userID, $addressID)
    {
        $this->m_UserID = $userID;
        $this->m_AddressID = $addressID;
    }

    //  Methods
    public function getUserID()
    {
        return $this->m_UserID;
    }

    public function getAddressID()
    {
        return $this->m_AddressID;
    }
}