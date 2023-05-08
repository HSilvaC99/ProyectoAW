<?php

namespace es\ucm\fdi\aw\DAO;

require_once 'includes/config.php';

use es\ucm\fdi\aw\DTO\DTO;
use es\ucm\fdi\aw\DTO\AddressDTO;

class AddressDAO extends DAO
{
    //  Constants
    private const TABLE_NAME = 'addresses';

    private const ID_KEY = 'id';
    private const STREET_KEY = 'street';
    private const FLOOR_KEY = 'floor';
    private const ZIP_KEY = 'zip';
    private const CITY_KEY = 'city';
    private const PROVINCE_KEY = 'province';
    private const COUNTRY_KEY = 'country';


    //  Constructors
    public function __construct()
    {
        parent::__construct(self::TABLE_NAME);
    }

    //  Methods   
    protected function createDTOFromArray($array): DTO
    {
        $id = $array[self::ID_KEY] ?? -1;
        $street = $array[self::STREET_KEY];
        $floor = $array[self::FLOOR_KEY];
        $zip = $array[self::ZIP_KEY];
        $city = $array[self::CITY_KEY];
        $province = $array[self::PROVINCE_KEY];
        $country = $array[self::COUNTRY_KEY];

        return new AddressDTO($id, $street, $floor, $zip, $city, $province, $country);
    }
    protected function createArrayFromDTO($dto): array
    {
        $dtoArray = array(
            self::STREET_KEY => $dto->getStreet(),
            self::FLOOR_KEY => $dto->getFloor(),
            self::ZIP_KEY => $dto->getZip(),
            self::CITY_KEY => $dto->getCity(),
            self::PROVINCE_KEY => $dto->getProvince(),
            self::COUNTRY_KEY => $dto->getCountry()
        );

        if ($dto->getID() != -1)
            $dtoArray[self::ID_KEY] = $dto->getID();

        return $dtoArray;
    }


    public function getAddressForUser($userID): array
    {
        $query = 'SELECT o.id AS addressID,  o.street AS streetO, o.floor AS floorO, o.zip AS zipO, o.city AS cityO, o.province AS provinceO, o.country AS countryO
        FROM addresses o
        INNER JOIN users_addresses uo ON o.id = uo.addressID
        WHERE uo.userID = :userID';

        $statement = $this->m_DatabaseProxy->prepare($query);
        $statement->bindParam(':userID', $userID);
        $statement->execute();

        return $statement->fetchAll();
    }

    public function getAddressForOrder($addressID): array
    {
        $query = 'SELECT street, floor, zip, city , province, country
        FROM addresses
        WHERE id = :addressID';

        $statement = $this->m_DatabaseProxy->prepare($query);
        $statement->bindParam(':addressID', $addressID);
        $statement->execute();

        return $statement->fetchAll();
    }
}
