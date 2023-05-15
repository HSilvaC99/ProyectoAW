<?php

namespace es\ucm\fdi\aw\DAO;

require_once 'includes/config.php';

use es\ucm\fdi\aw\DTO\DTO;
use es\ucm\fdi\aw\DTO\ManufacturerDTO;

class ManufacturerDAO extends DAO
{
    //  Constants
    private const TABLE_NAME = 'manufacturers';
    private const MANUFACTURER_ID_KEY = 'id';
    private const MANUFACTURER_NAME_KEY = 'name';

    //  Constructors
    public function __construct()
    {
        parent::__construct(self::TABLE_NAME);
    }

    //  Methods
    public function createDTOFromArray($array): DTO
    {
        $manufacturerID = $array[self::MANUFACTURER_ID_KEY];
        $manufacturerName = $array[self::MANUFACTURER_NAME_KEY];

        return new ManufacturerDTO($manufacturerID, $manufacturerName);
    }
    public function createArrayFromDTO($dto): array
    {
        return array(
            self::MANUFACTURER_ID_KEY => $dto->getID(),
            self::MANUFACTURER_NAME_KEY => $dto->getName()
        );
    }
}