<?php

namespace es\ucm\fdi\aw\DAO;

require_once 'includes/config.php';

use es\ucm\fdi\aw\DTO\DTO;
use es\ucm\fdi\aw\DTO\DesiredProductsDTO;

class DesiredProductsDAO extends DAO
{
    //  Constants
    private const TABLE_NAME = 'desired_products';

    private const LIST_ID_KEY = 'listID';
    private const PRODUCT_ID_KEY = 'productID';
    private const DATE_KEY = 'date';


    //  Constructors
    public function __construct()
    {
        parent::__construct(self::TABLE_NAME);
    }

    //  Methods   
    protected function createDTOFromArray($array): DTO
    {
        
        $listID = $array[self::LIST_ID_KEY];
        $productID = $array[self::PRODUCT_ID_KEY];
        $date=$array[self::DATE_KEY];

        return new DesiredProductsDTO($listID,$productID,$date);
    }
    protected function createArrayFromDTO($dto): array
    {
        $dtoArray = array(
            self::LIST_ID_KEY => $dto->getListID(),
            self::USER_ID_KEY => $dto->getProductID(),
            self::DATE_KEY => $dto->getDate()
            
        );

       
        return $dtoArray;
    }

    public function getListProds($listID): array
    {
        $query = "SELECT * FROM desired_products WHERE listID = :listID";
        $statement = $this->m_DatabaseProxy->prepare($query);

        $statement->bindParam(':listID', $listID);
        $statement->execute();

        $results = array();
        $DesiredProductsDAO = new DesiredProductsDAO();

        foreach ($statement as $result) {
            array_push($results, $DesiredProductsDAO->createDTOFromArray($result));
        }

        return $results;


    }

}