<?php

namespace es\ucm\fdi\aw\DAO;

require_once 'includes/config.php';

use es\ucm\fdi\aw\DTO\DTO;
use es\ucm\fdi\aw\DTO\UserQuestionDTO;

class UserQuestionDAO extends DAO
{
    private const TABLE_NAME = 'users_questions';
    
    private const USER_ID_KEY = 'userID';
    private const QUESTION_ID_KEY = 'questionID';

    //  Constructors
    public function __construct()
    {
        parent::__construct(self::TABLE_NAME);
    }

    //  Methods
    protected function createDTOFromArray($array): DTO
    {
        $userID = $array[self::USER_ID_KEY];
        $questionID = $array[self::QUESTION_ID_KEY];

        return new UserQuestionDTO($userID, $questionID);
    }
    protected function createArrayFromDTO($dto): array
    {
        return array(
            self::USER_ID_KEY => $dto->getUserID(),
            self::QUESTION_ID_KEY => $dto->getQuestionID()
        );
    }
}
