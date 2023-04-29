<?php

namespace es\ucm\fdi\aw\DAO;

require_once 'includes/config.php';

use es\ucm\fdi\aw\DTO\DTO;
use es\ucm\fdi\aw\DTO\UserAddressDTO;

class UserAddressDAO extends DAO
{
    private const TABLE_NAME = 'users_addresses';
    
    private const USER_ID_KEY = 'userID';
    private const ADDRESS_ID_KEY = 'addressID';

    //  Constructors
    public function __construct()
    {
        parent::__construct(self::TABLE_NAME);
    }

    //  Methods
    protected function createDTOFromArray($array): DTO
    {
        $userID = $array[self::USER_ID_KEY];
        $addressID = $array[self::ADDRESS_KEY];

        return new UserAddressDTO($userID, $orderID);
    }
    protected function createArrayFromDTO($dto): array
    {
        return array(
            self::USER_ID_KEY => $dto->getUserID(),
            self::ADDRESS_KEY => $dto->getAddressID()
        );
    }

    public function insert($userID, $addressID): bool
    {
        $query = 'INSERT users_addresses SET userID = :userID, addressID = :addressID' ;
        $statement = $this->m_DatabaseProxy->prepare($query);
        $statement->bindValue(':userID', $userID);
        $statement->bindValue(':addressID', $addressID);


        return $statement->execute();
    }
}
