<?php

namespace es\ucm\fdi\aw\DTO;

require_once dirname(__DIR__).'/config.php';

class ProductDTO extends DTO
{
    private $m_ID;
    private $m_Name;
    private $m_Description;
    private $m_ImgName;
    private $m_Price;
    private $m_Offer;
    private $m_PriceOffer;

    public function __construct($id, $name, $description, $imgName, $price, $offer)
    {
        $this->m_ID = $id;
        $this->m_Name = $name;
        $this->m_Description = $description;
        $this->m_ImgName = $imgName;
        $this->m_Price = $price;
        $this->m_Offer = $offer;
        $this->m_PriceOffer = $price - $price*($offer/100);
    }
    public function getID()
    {
        return $this->m_ID;
    }
    
    public function getName()
    {
        return $this->m_Name;
    }
    
    public function getDescription()
    {
        return $this->m_Description;
    }
    
    public function getImgName()
    {
        return $this->m_ImgName;
    }
    
    public function getPrice()
    {
        return $this->m_Price;
    }
    
    public function getOffer() {
        return $this->m_Offer;
    }
    
    public function setName($name)
    {
        $this->m_Name = $name;
    }
    
    public function setDescription($description)
    {
        $this->m_Description = $description;
    }
    
    public function setImgName($imgName)
    {
        $this->m_ImgName = $imgName;
    }
    
    public function setPrice($price)
    {
        $this->m_Price = $price;
    }
    
    public function setOffer($offer) {
        $this->m_Offer = $offer;
    }
    
    public function getOfferPrice() {
        return $this->m_PriceOffer;
    }

    public function setOfferPrice($priceOffer) {
        $this->m_PriceOffer = $priceOffer;
    }
}