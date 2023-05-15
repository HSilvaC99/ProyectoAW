<?php

namespace es\ucm\fdi\aw\DTO;

require_once dirname(__DIR__) . '/config.php';

class ProductManufacturerDTO extends DTO
{
    private $m_ProductID;
    private $m_ManufacturerID;

    //  Constructors
    public function __construct($productID, $manufacturerID)
    {
        $this->m_ProductID = $productID;
        $this->m_ManufacturerID = $manufacturerID;
    }

    //  Methods
    public function getProductID()
    {
        return $this->m_ProductID;
    }

    public function getManufacturerID()
    {
        return $this->m_ManufacturerID;
    }
}
