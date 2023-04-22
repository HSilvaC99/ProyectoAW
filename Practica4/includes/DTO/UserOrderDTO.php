<?php

namespace es\ucm\fdi\aw\DTO;

require_once dirname(__DIR__).'/config.php';

class UserOrderDTO extends DTO
{
    //  Fields
    private $m_UserID;
    private $m_OrderID;

    //  Constructors
    public function __construct($userID, $orderID)
    {
        $this->m_UserID = $userID;
        $this->m_OrderID = $orderID;
    }

    //  Methods
    public function getUserID()
    {
        return $this->m_UserID;
    }

    public function getOrderID()
    {
        return $this->m_OrderID;
    }
}