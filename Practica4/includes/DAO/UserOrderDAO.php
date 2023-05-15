<?php

namespace es\ucm\fdi\aw\DAO;

require_once 'includes/config.php';

use es\ucm\fdi\aw\DTO\DTO;
use es\ucm\fdi\aw\DTO\UserOrderDTO;

class UserOrderDAO extends DAO
{
    private const TABLE_NAME = 'users_orders';
    
    private const USER_ID_KEY = 'userID';
    private const ORDER_ID_KEY = 'orderID';

    //  Constructors
    public function __construct()
    {
        parent::__construct(self::TABLE_NAME);
    }

    //  Methods
    protected function createDTOFromArray($array): DTO
    {
        $userID = $array[self::USER_ID_KEY];
        $orderID = $array[self::ORDER_ID_KEY];

        return new UserOrderDTO($userID, $orderID);
    }
    protected function createArrayFromDTO($dto): array
    {
        return array(
            self::USER_ID_KEY => $dto->getUserID(),
            self::ORDER_ID_KEY => $dto->getOrderID()
        );
    }

    public function insert($userID, $orderID): bool
    {
        $query = 'INSERT users_orders SET userID = :userID, orderID = :orderID' ;
        $statement = $this->m_DatabaseProxy->prepare($query);
        $statement->bindValue(':userID', $userID);
        $statement->bindValue(':orderID', $orderID);


        return $statement->execute();
    }
}
