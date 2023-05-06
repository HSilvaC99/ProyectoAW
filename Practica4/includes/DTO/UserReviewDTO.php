<?php

namespace es\ucm\fdi\aw\DTO;

require_once dirname(__DIR__).'/config.php';

class UserReviewDTO extends DTO
{
    //  Fields
    private $m_ProductID;
    private $m_UserID;
    private $m_ReviewID;

    //  Constructors
    public function __construct($userID, $productID, $reviewID)
    {
        $this->m_UserID = $userID;
        $this->m_ProductID = $productID;
        $this->m_ReviewID = $reviewID;
    }

    //  Methods
    public function getUserID()
    {
        return $this->m_UserID;
    }
    
    public function getProductID()
    {
        return $this->m_ProductID;
    }

    public function getReviewID()
    {
        return $this->m_ReviewID;
    }
}
