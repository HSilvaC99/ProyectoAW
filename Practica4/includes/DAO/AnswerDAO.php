<?php

namespace es\ucm\fdi\aw\DAO;

require_once 'includes/config.php';

use es\ucm\fdi\aw\DTO\DTO;
use es\ucm\fdi\aw\DTO\AnswerDTO;

class AnswerDAO extends DAO
{
    private const TABLE_NAME = 'answers';
    
    private const ID_KEY = 'id';
    private const MESSAGE_KEY = 'message';
    private const CREATION_DATE_KEY = 'creationDate';

    //  Constructors
    public function __construct()
    {
        parent::__construct(self::TABLE_NAME);
    }

    //  Methods

    public function getLastAnswer(): DTO
    {
        $query = "SELECT * FROM answers ORDER BY id DESC LIMIT 1";

        $statement = $this->m_DatabaseProxy->prepare($query);
        $statement->execute();

        $answerDAO = new AnswerDAO;
        
        return $answerDAO->createDTOFromArray($statement->fetch());
    }

    public function getQuestionAnswers($questionID): array
    {
        $query = "SELECT * FROM answers a INNER JOIN users_answers ua ON a.id = ua.answerID WHERE ua.questionID = :questionID;";

        $statement = $this->m_DatabaseProxy->prepare($query);
        $statement->bindParam(':questionID', $questionID);
        $statement->execute();

        $results = array();
        $answerDAO = new AnswerDAO;

        foreach ($statement as $result) {
            array_push($results, $answerDAO->createDTOFromArray($result));
        }
        
        return $results;
    }
    public function getAnswerAuthor($answerID, $questionID): array
    {
        $query = "SELECT * FROM users u INNER JOIN users_answers ua ON u.id = ua.userID WHERE ua.questionID = :questionID AND ua.answerID = :answerID;";

        $statement = $this->m_DatabaseProxy->prepare($query);
        $statement->bindParam(':questionID', $questionID);
        $statement->bindParam(':answerID', $answerID);
        $statement->execute();

        $results = array();
        $userDAO = new UserDAO();

        foreach ($statement as $result) {
            array_push($results, $userDAO->createDTOFromArray($result));
        }
        
        return $results;
    }

    protected function createDTOFromArray($array): DTO
    {
        $id = $array[self::ID_KEY];
        $message = $array[self::MESSAGE_KEY];
        $creationDate = $array[self::CREATION_DATE_KEY];

        return new AnswerDTO($id, $message, $creationDate);
    }

    protected function createArrayFromDTO($dto): array
    {
        $dtoArray = array(
            self::MESSAGE_KEY => $dto->getMessage()
        );
        
        if ($dto->getID() != -1)
            $dtoArray[self::ID_KEY] = $dto->getID();

        return $dtoArray;
    }
}