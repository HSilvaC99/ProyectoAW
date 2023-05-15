<?php

namespace es\ucm\fdi\aw\DAO;

require_once 'includes/config.php';

use es\ucm\fdi\aw\DTO\DTO;
use es\ucm\fdi\aw\DTO\WishListDTO;

class WishListDAO extends DAO
{
    //  Constants
    private const TABLE_NAME = 'wish_list';

    private const LIST_ID_KEY = 'id';
    private const LIST_NOMBRE_KEY = 'nombre';
    private const LIST_TIPO_KEY = 'tipo';


    //  Constructors
    public function __construct()
    {
        parent::__construct(self::TABLE_NAME);
    }

    //  Methods   
    protected function createDTOFromArray($array): DTO
    {

        $id = $array[self::LIST_ID_KEY];
        $name = $array[self::LIST_NOMBRE_KEY];
        $type = $array[self::LIST_TIPO_KEY];

        return new WishListDTO($id, $name, $type);
    }
    protected function createArrayFromDTO($dto): array
    {
        $dtoArray = array(
            self::LIST_ID_KEY => $dto->getId(),
            self::LIST_NOMBRE_KEY => $dto->getName(),
            self::LIST_TIPO_KEY => $dto->getType()
        );


        return $dtoArray;
    }

    public function getListName($id)
    {
        $query = "SELECT * FROM wish_list WHERE id = :id";
        $statement = $this->m_DatabaseProxy->prepare($query);

        $statement->bindValue(':id', $id);
        $statement->execute();

        $results = array();

        foreach ($statement as $result)
            array_push($results, $this->createDTOFromArray($result));

        $name = $results[0]->getName();
        return $name;
    }

    public function deleteList($id): bool
    {
        $query = 'DELETE FROM wish_list WHERE id = :id';

        $statement = $this->m_DatabaseProxy->prepare($query);
        $statement->bindParam(':id', $id);

        return $statement->execute();
    }
}
