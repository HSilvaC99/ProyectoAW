<?php

namespace es\ucm\fdi\aw\DAO;

require_once 'includes/config.php';

use es\ucm\fdi\aw\DTO\DTO;
use es\ucm\fdi\aw\DTO\ProductCategoryDTO;

class ProductCategoryDAO extends DAO
{
    private const TABLE_NAME = 'products_categories';
    private const PRODUCT_ID_KEY = 'productID';
    private const CATEGORY_ID_KEY = 'categoryID';
    public function __construct()
    {
        parent::__construct(self::TABLE_NAME);
    }

    //  Methods
    protected function createDTOFromArray($array): DTO
    {
        $productID = $array[self::PRODUCT_ID_KEY];
        $categoryID = $array[self::CATEGORY_ID_KEY];

        return new ProductCategoryDTO($productID, $categoryID);
    }
    protected function createArrayFromDTO($dto): array
    {
        return array(
            self::PRODUCT_ID_KEY => $dto->getProductID(),
            self::CATEGORY_ID_KEY => $dto->getCategoryID()
        );
    }
}