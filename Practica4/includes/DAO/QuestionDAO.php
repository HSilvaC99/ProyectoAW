<?php

namespace es\ucm\fdi\aw\DAO;

require_once 'includes/config.php';

use es\ucm\fdi\aw\DAO\QuestionDAO as DAOQuestionDAO;
use es\ucm\fdi\aw\DTO\DTO;
use es\ucm\fdi\aw\DTO\QuestionDTO;

class QuestionDAO extends DAO
{
    private const TABLE_NAME = 'questions';

    private const ID_KEY = 'id';
    private const TITLE_KEY = 'title';
    private const MESSAGE_KEY = 'message';
    private const CREATION_DATE_KEY = 'creationDate';

    //  Constructors
    public function __construct()
    {
        parent::__construct(self::TABLE_NAME);
    }

    public function getLastQuestion(): QuestionDTO
    {
        $query = "SELECT * FROM questions ORDER BY id DESC LIMIT 1";

        $statement = $this->m_DatabaseProxy->prepare($query);
        $statement->execute();

        $questionDAO = new QuestionDAO;
        
        return $questionDAO->createDTOFromArray($statement->fetch());
    }

    //  Methods
    public function getQuestionAuthor($questionID): array
    {
        $query = "SELECT * FROM users u INNER JOIN users_questions uq ON u.id = uq.userID WHERE uq.questionID = :questionID;";

        $statement = $this->m_DatabaseProxy->prepare($query);
        $statement->bindParam(':questionID', $questionID);
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
        $title = $array[self::TITLE_KEY];
        $message = $array[self::MESSAGE_KEY];
        $creationDate = $array[self::CREATION_DATE_KEY];

        return new QuestionDTO($id, $title, $message, $creationDate);
    }
    protected function createArrayFromDTO($dto): array
    {
        $dtoArray = array(
            self::TITLE_KEY => $dto->getTitle(),
            self::MESSAGE_KEY => $dto->getMessage()
        );

        
        if ($dto->getID() != -1)
            $dtoArray[self::ID_KEY] = $dto->getID();

        return $dtoArray;
    }
}