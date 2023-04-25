<?php

namespace es\ucm\fdi\aw\DTO;

require_once dirname(__DIR__).'/config.php';

class QuestionAnswerDTO extends DTO
{
    //  Fields
    private $m_QuestionID;
    private $m_AnswerID;

    //  Constructors
    public function __construct($questionID, $answerID)
    {
        $this->m_QuestionID = $questionID;
        $this->m_AnswerID = $answerID;
    }

    //  Methods
    public function getQuestionID()
    {
        return $this->m_QuestionID;
    }
    
    public function getAnswerID()
    {
        return $this->m_AnswerID;
    }
}