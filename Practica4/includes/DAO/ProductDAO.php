<?php

namespace es\ucm\fdi\aw\DAO;

require_once dirname(__DIR__) . '/config.php';

use es\ucm\fdi\aw\DTO\DTO;
use es\ucm\fdi\aw\DTO\ProductDTO;

class ProductDAO extends DAO
{

    private const TABLE_NAME = 'products';
    private const ID_KEY = 'id';
    private const NAME_KEY = 'name';
    private const DESCRIPTION_KEY = 'description';
    private const IMG_NAME_KEY = 'imgName';
    private const PRICE_KEY = 'price';
    private const OFFER_KEY = 'offer';

    //  Constructors
    public function __construct()
    {
        parent::__construct(self::TABLE_NAME);
    }

    //  Methods
    public function readLikeName(string $name, array $filters): array
    {
        //  Name
        if (strlen($name) > 0) {
            $regex = "%{$name[0]}%";
            for ($i = 1; $i < strlen($name); ++$i)
                $regex .= "{$name[$i]}%";

            $nameKey = self::NAME_KEY;
            $regexStatement = "{$nameKey} LIKE :{$nameKey}";
        }
        //  Value filters
        $numFilters = count($filters);
        if ($numFilters > 0) {
            $filtersKeys = array_keys($filters);

            $filtersStatement = "{$filtersKeys[0]}=:{$filtersKeys[0]}";

            for ($i = 1; $i < $numFilters; ++$i)
                $filtersStatement .= " AND {$filtersKeys[$i]}=:{$filtersKeys[$i]}";
        }

        //  Final filter string
        $whereString = '';

        if (isset($regexStatement) && isset($filtersStatement)) {
            $whereString = "WHERE {$regexStatement} AND {$filtersStatement}";
        }
        else if (isset($regexStatement))
            $whereString = "WHERE {$regexStatement}";
        else if (isset($filtersStatement))
            $whereString = "WHERE {$filtersStatement}";

        //  Prepare statement
        $table = self::TABLE_NAME;
        $query = "SELECT * FROM {$table} {$whereString}";
        $statement = $this->m_DatabaseProxy->prepare($query);

        if (isset($regexStatement))
            $statement->bindParam($nameKey, $regex);

        if (isset($filtersStatement))
            for ($i = 0; $i < $numFilters; ++$i)
                $statement->bindParam($filtersKeys[$i], $filters[$i]);

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
