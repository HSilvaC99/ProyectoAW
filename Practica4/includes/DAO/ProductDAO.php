<?php

namespace es\ucm\fdi\aw\DAO;

require_once dirname(__DIR__) . '/config.php';

use es\ucm\fdi\aw\DTO\DTO;
use es\ucm\fdi\aw\DTO\ProductDTO;

class ProductDAO extends DAO
{
    //  Constants
    private const TABLE_NAME = 'products';
    private const ID_KEY = 'id';
    private const NAME_KEY = 'name';
    private const DESCRIPTION_KEY = 'description';
    private const IMG_NAME_KEY = 'imgName';
    private const PRICE_KEY = 'price';
    private const OFFER_KEY = 'offer';

    private const FILTER_CRITERIA_FIREARM_NAME_KEY = 'name';
    private const FILTER_CRITERIA_FIREARM_NAME_VALUE = ':name';
    private const FILTER_CRITERIA_FIREARM_TYPE_KEY = 'filterCriteriaFirearmType';
    private const FILTER_CRITERIA_FIREARM_TYPE_VALUE = ':category_id';
    private const FILTER_CRITERIA_FIREARM_MANUFACTURER_KEY = 'filterCriteriaFirearmManufacturer';
    private const FILTER_CRITERIA_FIREARM_MANUFACTURER_VALUE = ':manufacturer_id';

    //  Constructors
    public function __construct()
    {
        parent::__construct(self::TABLE_NAME);
    }

    //  Methods
    public function searchProducts(array $filters, string $orderBy): array
    {
        $filtersStatement = '';
        $allFilters = array();

        $cateogoryFilter = '';
        $manufacturerFilter = '';

        foreach ($filters as $filterKey => $filterValue) {
            switch ($filterKey) {
                case self::FILTER_CRITERIA_FIREARM_TYPE_KEY: {
                        $value = self::FILTER_CRITERIA_FIREARM_TYPE_VALUE;
                        $cateogoryFilter = "pc.categoryID = {$value}";
                        array_push($allFilters, $cateogoryFilter);
                    }
                    break;
                case self::FILTER_CRITERIA_FIREARM_MANUFACTURER_KEY: {
                        $value = self::FILTER_CRITERIA_FIREARM_MANUFACTURER_VALUE;
                        $manufacturerFilter = "pm.manufacturer_id = {$value}";
                        array_push($allFilters, $manufacturerFilter);
                    }
                    break;
                case self::FILTER_CRITERIA_FIREARM_NAME_KEY: {
                        $value = self::FILTER_CRITERIA_FIREARM_NAME_VALUE;
                        $manufacturerFilter = "p.name LIKE {$value}";
                        array_push($allFilters, $manufacturerFilter);
                    }
            }
        }

        if (count($allFilters) > 0) {
            $filtersStatement = "WHERE {$allFilters[0]}";

            for ($i = 1; $i < count($allFilters); ++$i)
                $filtersStatement .= " AND {$allFilters[$i]}";
        }

        $orderValue = '';

        switch ($orderBy) {
            case 'name ascending':
                $orderValue = 'p.name ASC';
                break;
            case 'name descending':
                $orderValue = 'p.name DESC';
                break;
            case 'manufacturer ascending':
                $orderValue = 'm.name ASC';
                break;
            case 'manufacturer descending':
                $orderValue = 'm.name DESC';
                break;
            case 'manufactureYear ascending':
                $orderValue = 'p.manufactureYear ASC';
                break;
            case 'manufactureYear descending':
                $orderValue = 'p.manufactureYear DESC';
                break;
        }

        $query = <<<HTML
            SELECT
            p.id AS id,
            p.name AS name,
            p.description AS description,
            p.imgName AS imgName,
            p.price AS price,
            p.offer AS offer
        FROM
            products p
        INNER JOIN products_categories pc ON p.id = pc.productID
        INNER JOIN products_manufacturers pm ON p.id = pm.product_id
        INNER JOIN manufacturers m ON pm.manufacturer_id = m.id
            {$filtersStatement}
        ORDER BY
            $orderValue
        ;
        HTML;

        //  Prepare statement
        $statement = $this->m_DatabaseProxy->prepare($query);

        foreach ($filters as $filterKey => $filterValue) {
            switch ($filterKey) {
                case self::FILTER_CRITERIA_FIREARM_TYPE_KEY:
                    $statement->bindValue(self::FILTER_CRITERIA_FIREARM_TYPE_VALUE, $filterValue);
                    break;
                case self::FILTER_CRITERIA_FIREARM_MANUFACTURER_KEY:
                    $statement->bindValue(self::FILTER_CRITERIA_FIREARM_MANUFACTURER_VALUE, $filterValue);
                    break;
                case self::FILTER_CRITERIA_FIREARM_NAME_KEY: {
                        $nameLength = strlen($filterValue);
                        $value = '%';

                        for ($i = 0; $i < $nameLength; $i++) {
                            $value .= $filterValue[$i] . '%';
                        }

                        $statement->bindValue(self::FILTER_CRITERIA_FIREARM_NAME_VALUE, $value);
                        break;
                    }
            }
        }

        $statement->execute();

        return $statement->fetchAll();
    }

    public function createDTOFromArray($array): DTO
    {
        $id = $array[self::ID_KEY];
        $name = $array[self::NAME_KEY];
        $description = $array[self::DESCRIPTION_KEY];
        $imgName = $array[self::IMG_NAME_KEY];
        $price = $array[self::PRICE_KEY];
        $offer = $array[self::OFFER_KEY];
        return new ProductDTO($id, $name, $description, $imgName, $price, $offer);
    }
    public function createArrayFromDTO($dto): array
    {
        $dtoArray = array(
            self::ID_KEY => $dto->getID(),
            self::NAME_KEY => $dto->getName(),
            self::DESCRIPTION_KEY => $dto->getDescription(),
            self::IMG_NAME_KEY => $dto->getImgName(),
            self::PRICE_KEY => $dto->getPrice(),
            self::OFFER_KEY => $dto->getOffer(),
        );

        if ($dto->getID() != -1)
            $dtoArray[self::ID_KEY] = $dto->getID();

        return $dtoArray;
    }
}
