<?php

namespace es\ucm\fdi\aw\DTO;

require_once dirname(__DIR__).'/config.php';

class UserQuestionDTO extends DTO
{
    //  Fields
    private $m_UserID;
    private $m_QuestionID;

    //  Constructors
    public function __construct($userID, $questionID)
    {
        $this->m_UserID = $userID;
        $this->m_QuestionID = $questionID;
    }

    //  Methods
    public function getUserID()
    {
        return $this->m_UserID;
    }

    public function getQuestionID()
    {
        return $this->m_QuestionID;
    }
}