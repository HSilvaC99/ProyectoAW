<?php

namespace es\ucm\fdi\aw\DTO;

require_once dirname(__DIR__).'/config.php';

class WishListsUsersDTO extends DTO
{
    //  Fields
    private $m_listID;
    private $m_userID;
    
    

    //  Constructors
    public function __construct($listID, $userID)
    {
        $this->m_listID = $listID;
        $this->m_userID = $userID;
        
        
    }

    //  Methods
    public function getListID()
    {
        return $this->m_listID;
    }
    
    public function getUserID()
    {
        return $this->m_userID;
    }

   
}
