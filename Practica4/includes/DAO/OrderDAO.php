<?php

namespace es\ucm\fdi\aw\DAO;

require_once 'includes/config.php';

use es\ucm\fdi\aw\DTO\DTO;
use es\ucm\fdi\aw\DTO\OrderDTO;

class OrderDAO extends DAO
{
    private const TABLE_NAME = 'orders';

    private const ID_KEY = 'id';
    private const STATE_KEY = 'state';
    private const DATE_KEY = 'date';
    private const AMOUNT_KEY = 'amount';
    private const QUANTITY_KEY = 'quantity';
    private const PAYMENT_KEY = 'paymentMethod';
    private const ADDRESS_KEY = 'address';

    //  Constructors
    public function __construct()
    {
        parent::__construct(self::TABLE_NAME);
    }

    //  Methods

    protected function createDTOFromArray($array): DTO
    {
        $id = $array[self::ID_KEY];
        $state = $array[self::STATE_KEY];
        $date = $array[self::DATE_KEY];
        $amount = $array[self::AMOUNT_KEY];
        $quantity = $array[self::QUANTITY_KEY];
        $payment = $array[self::PAYMENT_KEY];
        $address = $array[self::ADDRESS_KEY];

        return new OrderDTO($id,  $state, $date, $amount, $quantity, $payment, $address);
    }
    protected function createArrayFromDTO($dto): array
    {
        $dtoArray = array(
            self::STATE_KEY => $dto->getState(),
            self::DATE_KEY => $dto->getDate(),
            self::AMOUNT_KEY => $dto->getAmount(),
            self::QUANTITY_KEY => $dto->getQuantity(),
            self::PAYMENT_KEY => $dto->getPayment(),
            self::ADDRESS_KEY => $dto->getAddres()

        );


        if ($dto->getID() != -1)
            $dtoArray[self::ID_KEY] = $dto->getID();

        return $dtoArray;
    }

    public function getOrderForUser($userID): array
    {
        $query = 'SELECT o.id AS orderID,  o.state AS stateO, o.date AS dateO, o.amount AS amountO, o.quantity AS quantityO, o.paymentMethod AS paymentMethodO, o.address AS addressO
        FROM orders o
        INNER JOIN users_orders uo ON o.id = uo.orderID
        WHERE uo.userID = :userID';

        $statement = $this->m_DatabaseProxy->prepare($query);
        $statement->bindParam(':userID', $userID);
        $statement->execute();

        return $statement->fetchAll();
    }



    public function cancelOrder($orderID): bool
    {
        $query = 'UPDATE orders SET state = "cancelado" WHERE id = :orderID AND state != "cancelado"';

        $statement = $this->m_DatabaseProxy->prepare($query);
        $statement->bindParam(':orderID', $orderID);

        return $statement->execute();
    }

    public function UpdateAddress($orderID, $address): bool
    {
        $query = 'UPDATE orders SET address = :address WHERE id = :orderID';
        $statement = $this->m_DatabaseProxy->prepare($query);
        $statement->bindValue(':orderID', $orderID);
        $statement->bindValue(':address', $address);


        return $statement->execute();
    }

    public function InsertOrder($price, $metodo, $dir, $date): bool
    {
        $query = 'INSERT orders SET state = "pendiente", date = :date, amount = :price, quantity = "1", paymentMethod = :metodo, address= :dir';
        $statement = $this->m_DatabaseProxy->prepare($query);
        $statement->bindValue(':price', $price);
        $statement->bindValue(':metodo', $metodo);
        $statement->bindValue(':dir', $dir);
        $statement->bindValue(':date', $date);


        return $statement->execute();
    }

    public function InsertOrderCard($price, $metodo, $dir, $date): bool
    {
        $query = 'INSERT orders SET state = "en proceso", date = :date, amount = :price, quantity = "1", paymentMethod = :metodo, address= :dir' ;
        $statement = $this->m_DatabaseProxy->prepare($query);
        $statement->bindValue(':price', $price);
        $statement->bindValue(':metodo', $metodo);
        $statement->bindValue(':dir', $dir);
        $statement->bindValue(':date', $date);


        return $statement->execute();
    }

    public function InsertOrderCart($price, $metodo, $dir, $date, $cartCount): bool
    {
        
        $query = 'INSERT orders SET state = "pendiente", date = :date, amount = :price, quantity = :cartCount, paymentMethod = :metodo, address= :dir' ;
        $statement = $this->m_DatabaseProxy->prepare($query);
        $statement->bindValue(':price', $price);
        $statement->bindValue(':metodo', $metodo);
        $statement->bindValue(':dir', $dir);
        $statement->bindValue(':date', $date);
        $statement->bindValue(':cartCount', $cartCount);

        return $statement->execute();
    }

    public function InsertOrderCartCard($price, $metodo, $dir, $date, $cartCount): bool
    {
        
        $query = 'INSERT orders SET state = "en proceso", date = :date, amount = :price, quantity = :cartCount, paymentMethod = :metodo, address= :dir' ;
        $statement = $this->m_DatabaseProxy->prepare($query);
        $statement->bindValue(':price', $price);
        $statement->bindValue(':metodo', $metodo);
        $statement->bindValue(':dir', $dir);
        $statement->bindValue(':date', $date);
        $statement->bindValue(':cartCount', $cartCount);

        return $statement->execute();
    }


    public function getLastInsertID() {
        return $this->m_DatabaseProxy->lastInsertId();
    }
}
