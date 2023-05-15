<?php

namespace es\ucm\fdi\aw\DAO;

require_once 'includes/config.php';

use es\ucm\fdi\aw\DTO\DTO;
use es\ucm\fdi\aw\DTO\QuestionAnswerDTO;

class QuestionAnswerDAO extends DAO
{
    private const TABLE_NAME = 'questions_answers';
    
    private const QUESTION_ID_KEY = 'questionID';
    private const ANSWER_ID_KEY = 'answerID';

    //  Constructors
    public function __construct()
    {
        parent::__construct(self::TABLE_NAME);
    }

    //  Methods
    protected function createDTOFromArray($array): DTO
    {
        $questionID = $array[self::QUESTION_ID_KEY];
        $answerID = $array[self::ANSWER_ID_KEY];

        return new QuestionAnswerDTO($questionID, $answerID);
    }
    protected function createArrayFromDTO($dto): array
    {
        return array(
            self::QUESTION_ID_KEY => $dto->getQuestionID(),
            self::ANSWER_ID_KEY => $dto->getAnswerID()
        );
    }
}
