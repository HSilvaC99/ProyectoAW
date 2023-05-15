<?php

namespace es\ucm\fdi\aw\DAO;

require_once 'includes/config.php';

use es\ucm\fdi\aw\DTO\DTO;
use es\ucm\fdi\aw\DTO\CategoryDTO;

class CategoryDAO extends DAO
{
    //  Constants
    private const TABLE_NAME = 'categories';
    private const CATEGORY_ID_KEY = 'id';
    private const CATEGORY_NAME_KEY = 'name';

    //  Constructors
    public function __construct()
    {
        parent::__construct(self::TABLE_NAME);
    }

    //  Methods
    public function createDTOFromArray($array): DTO
    {
        $manufacturerID = $array[self::CATEGORY_ID_KEY];
        $manufacturerName = $array[self::CATEGORY_NAME_KEY];

        return new CategoryDTO($manufacturerID, $manufacturerName);
    }
    public function createArrayFromDTO($dto): array
    {
        return array(
            self::CATEGORY_ID_KEY => $dto->getID(),
            self::CATEGORY_NAME_KEY => $dto->getName()
        );
    }
}