<?php

namespace es\ucm\fdi\aw\DAO;

require_once 'includes/config.php';

use es\ucm\fdi\aw\DTO\DTO;
use es\ucm\fdi\aw\DTO\WishListsUsersDTO;

class WishListsUsersDAO extends DAO
{
    //  Constants
    private const TABLE_NAME = 'wish_lists_users';

    private const LIST_ID_KEY = 'listID';
    private const USER_ID_KEY = 'userID';
    


    //  Constructors
    public function __construct()
    {
        parent::__construct(self::TABLE_NAME);
    }

    //  Methods   
    protected function createDTOFromArray($array): DTO
    {
        
        $listID = $array[self::LIST_ID_KEY];
        $userID = $array[self::USER_ID_KEY];
        

        return new WishListsUsersDTO($listID,$userID);
    }
    protected function createArrayFromDTO($dto): array
    {
        $dtoArray = array(
            self::LIST_ID_KEY => $dto->getListID(),
            self::USER_ID_KEY => $dto->getUserID()
        );

       
        return $dtoArray;
    }

    public function getUserLists($userID): array
    {
        $query = "SELECT * FROM wish_lists_users WHERE userID = :userID";
        $statement = $this->m_DatabaseProxy->prepare($query);

        $statement->bindParam(':userID', $userID);
        $statement->execute();

        $results = array();
        $listsUsersDAO = new WishListsUsersDAO();

        foreach ($statement as $result) {
            array_push($results, $listsUsersDAO->createDTOFromArray($result));
        }

        return $results;
    }

}