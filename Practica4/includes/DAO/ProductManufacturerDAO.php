<?php

namespace es\ucm\fdi\aw\DAO;

require_once 'includes/config.php';

use es\ucm\fdi\aw\DTO\DTO;
use es\ucm\fdi\aw\DTO\ProductManufacturerDTO;

class ProductManufacturerDAO extends DAO
{
    private const TABLE_NAME = 'products_manufacturers';
    private const PRODUCT_ID_KEY = 'product_id';
    private const MANUFACTURER_ID_KEY = 'manufacturer_id';
    public function __construct()
    {
        parent::__construct(self::TABLE_NAME);
    }

    //  Methods
    protected function createDTOFromArray($array): DTO
    {
        $productID = $array[self::PRODUCT_ID_KEY];
        $manufacturerID = $array[self::MANUFACTURER_ID_KEY];

        return new ProductManufacturerDTO($productID, $manufacturerID);
    }
    protected function createArrayFromDTO($dto): array
    {
        return array(
            self::PRODUCT_ID_KEY => $dto->getProductID(),
            self::MANUFACTURER_ID_KEY => $dto->getManufacturerID()
        );
    }
}
