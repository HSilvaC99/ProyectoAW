<?php

namespace es\ucm\fdi\aw\DAO;

require_once 'includes/config.php';

use es\ucm\fdi\aw\DTO\DTO;
use es\ucm\fdi\aw\DTO\CardDTO;

class CardDAO extends DAO
{
    //  Constants
    private const TABLE_NAME = 'card';

    private const ID_KEY = 'id';
    private const NUMBER_KEY = 'number';
    private const EXPIRATE_KEY = 'expirate';
    private const CVV_KEY = 'cvv';
    private const NAME_KEY = 'name';



    //  Constructors
    public function __construct()
    {
        parent::__construct(self::TABLE_NAME);
    }

    //  Methods   
    protected function createDTOFromArray($array): DTO
    {
        $id = $array[self::ID_KEY] ?? -1;
        $number = $array[self::NUMBER_KEY];
        $expirate = $array[self::EXPIRATE_KEY];
        $cvv = $array[self::CVV_KEY];
        $name = $array[self::NAME_KEY];


        return new CardDTO($id, $number, $expirate, $cvv, $name);
    }
    protected function createArrayFromDTO($dto): array
    {
        $dtoArray = array(
            self::NUMBER_KEY => $dto->getNumber(),
            self::EXPIRATE_KEY => $dto->getExpirate(),
            self::CVV_KEY => $dto->getCvv(),
            self::NAME_KEY => $dto->getName(),
        );

        if ($dto->getID() != -1)
            $dtoArray[self::ID_KEY] = $dto->getID();

        return $dtoArray;
    }

    public function insertCard($number, $expirate, $cvv, $name): bool
    {
        
        $query = 'INSERT card SET number = :number, expirate = :expirate, cvv = :cvv, name = :name' ;
        $statement = $this->m_DatabaseProxy->prepare($query);
        $statement->bindValue(':number', $number);
        $statement->bindValue(':expirate', $expirate);
        $statement->bindValue(':cvv', $cvv);
        $statement->bindValue(':name', $name);

        return $statement->execute();
    }
}
