<?php

namespace es\ucm\fdi\aw\DTO;

require_once dirname(__DIR__).'/config.php';

class OrderDTO extends DTO
{
    private $m_ID;
    private $m_State;
    private $m_Date;
    private $m_Amount;
    private $m_Quantity;
    private $m_Payment;
    private $m_Address;

    public function __construct($id,  $state, $date, $amount, $quantity, $payment, $address)
    {
        $this->m_ID = $id;
        $this->m_State = $state;
        $this->m_Date = $date;
        $this->m_Amount = $amount;
        $this->m_Quantity = $quantity;
        $this->m_Payment = $payment;
        $this->m_Address = $address;
    }

    public function getID()
    {
        return $this->m_ID;
    }


    public function getState()
    {
        return $this->m_State;
    }

    public function getDate()
    {
        return $this->m_Date;
    }

    public function getAmount()
    {
        return $this->m_Amount;
    }

    public function getQuantity()
    {
        return $this->m_Quantity;
    }

    public function getPayment()
    {
        return $this->m_Payment;
    }

    public function getAddress()
    {
        return $this->m_Address;
    }
}
