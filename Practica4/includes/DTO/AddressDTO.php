<?php

namespace es\ucm\fdi\aw\DTO;

require_once 'includes/config.php';

class AddressDTO extends DTO
{
    //  Fields
    private $m_ID;
    private $m_Street;
    private $m_Floor;
    private $m_Zip;
    private $m_City;
    private $m_Province;
    private $m_Country;

    //  Constructors
    public function __construct($id, $street, $floor, $zip, $city, $province, $country)
    {
        $this->m_ID = $id;
        $this->m_Street = $street;
        $this->m_Floor = $floor;
        $this->m_Zip = $zip;
        $this->m_City = $city;
        $this->m_Province = $province;
        $this->m_Country = $country;
    }

    //  Methods
    public function getID()
    {
        return $this->m_ID;
    }

    public function getStreet()
    {
        return $this->m_Street;
    }
    public function setStreet($street)
    {
        $this->m_Street = $street;
    }

    public function getFloor(){
        return $this->m_Floor;
    }
    public function setFloor($floor)
    {
        $this->m_Floor = $floor;
    }

    public function getZip()
    {
        return $this->m_Zip;
    }

    public function getCity()
    {
        return $this->m_City;
    }
    public function setCity($city)
    {
        $this->m_City = $city;
    }

    public function getProvince()
    {
        return $this->m_Province;
    }
    public function setProvince($province)
    {
        $this->m_Province = $province;
    }

    public function getCountry()
    {
        return $this->m_Country;
    }
    public function setCountry($country)
    {
        $this->m_Country = $country;
    }
}

