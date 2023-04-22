<?php

namespace es\ucm\fdi\aw\DTO;

require_once dirname(__DIR__).'/config.php';

class UserAnswerDTO extends DTO
{
    //  Fields
    private $m_UserID;
    private $m_AnswerID;
    private $m_QuestionID;

    //  Constructors
    public function __construct($userID, $answerID, $questionID)
    {
        $this->m_UserID = $userID;
        $this->m_AnswerID = $answerID;
        $this->m_QuestionID = $questionID;
    }

    //  Methods
    public function getUserID()
    {
        return $this->m_UserID;
    }

    public function getAnswerID()
    {
        return $this->m_AnswerID;
    }

    public function getQuestionID()
    {
        return $this->m_QuestionID;
    }
}
