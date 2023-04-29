<?php

namespace es\ucm\fdi\aw\DAO;

require_once 'includes/config.php';

use es\ucm\fdi\aw\DTO\DTO;
use es\ucm\fdi\aw\DTO\UserProductDTO;

class UserProductDAO extends DAO
{
    private const TABLE_NAME = 'users_products';
    private const USER_ID_KEY = 'userID';
    private const PRODUCT_ID_KEY = 'productID';
    private const AMOUNT_KEY = 'amount';

    public function __construct()
    {
        parent::__construct(self::TABLE_NAME);
    }

    public function getUserCart($userID): array
    {
        $query = "SELECT * FROM users_products WHERE userID = :userID";
        $statement = $this->m_DatabaseProxy->prepare($query);

        $statement->bindParam(':userID', $userID);
        $statement->execute();

        $results = array();
        $userProductDAO = new UserProductDAO();

        foreach ($statement as $result) {
            array_push($results, $userProductDAO->createDTOFromArray($result));
        }

        return $results;
    }

    public function getCartProduct($userID, $productID): DTO
    {
        $query = "SELECT u.amount FROM users_products u WHERE u.userID = :userID and u.productID = :productID";
        $statement = $this->m_DatabaseProxy->prepare($query);

        $statement->bindParam(':userID', $userID);
        $statement->bindParam(':productID', $productID);
        $statement->execute();

        $amount = $statement->fetchColumn();
        $userProductDTO = new UserProductDTO($userID, $productID, $amount);


        return $userProductDTO;
    }

    public function deleteCart(): bool
    {
        $query = 'DELETE FROM users_products';
        $statement = $this->m_DatabaseProxy->prepare($query);

        return $statement->execute();
    }


    public function getAmount($productID): bool
    {
        $query = 'SELECT amount FROM users_products WHERE productID = :productID';
        $statement = $this->m_DatabaseProxy->prepare($query);
        $statement->bindParam(':productID', $productID);

        return $statement->execute();
    }

    public function updateWithCompoundKey($dto)
    {
        $dtoArray = $this->createArrayFromDTO($dto);
        $dtoArrayKeys = array_keys($dtoArray);

        $updateVariables = "{$dtoArrayKeys[0]} = :{$dtoArrayKeys[0]}";

        for ($i = 1; $i < count($dtoArrayKeys); ++$i) {
            $column = $dtoArrayKeys[$i];
            $updateVariables .= ", $column = :$column";
        }

        $idKey1 = self::USER_ID_KEY;
        $idKey2 = self::PRODUCT_ID_KEY;
        $query = "UPDATE users_products SET $updateVariables WHERE $idKey1 = {$dto->getID1()} AND $idKey2 = {$dto->getID2()}";

        $statement = $this->m_DatabaseProxy->prepare($query);

        foreach ($dtoArrayKeys as $key) {
            $statement->bindParam(":$key", $dtoArray[$key]);
        }

        return $statement->execute();
    }

    public function deleteProduct($userID, $productID): bool
    {
        $query = 'DELETE FROM users_products WHERE userID = :userID AND productID = :productID';

        $statement = $this->m_DatabaseProxy->prepare($query);
        $statement->bindParam(':userID', $userID);
        $statement->bindParam(':productID', $productID);

        return $statement->execute();
    }

    public function deleteCart(): bool
    {
        
        $query = 'DELETE FROM users_products' ;
        $statement = $this->m_DatabaseProxy->prepare($query);
        

        return $statement->execute();
    }

    public function getAmount($productID): bool
    {
        
        $query = 'SELECT amount FROM users_products WHERE productID = :productID' ;
        $statement = $this->m_DatabaseProxy->prepare($query);
        $statement->bindParam(':productID', $productID);

        return $statement->execute();
    }

    

    

    protected function createDTOFromArray($array): DTO
    {

        $userID = $array[self::USER_ID_KEY];
        $productID = $array[self::PRODUCT_ID_KEY];
        $amount = $array[self::AMOUNT_KEY];


        return new UserProductDTO($userID, $productID, $amount);
    }

    protected function createArrayFromDTO($dto): array
    {
        $dtoArray = array(
            self::USER_ID_KEY => $dto->getID1(),
            self::PRODUCT_ID_KEY => $dto->getID2(),
            self::AMOUNT_KEY => $dto->getAmount()
        );

        return $dtoArray;
    }
}
