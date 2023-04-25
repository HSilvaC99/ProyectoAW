<?php

namespace es\ucm\fdi\aw\DTO;

require_once dirname(__DIR__).'/config.php';

class ProductCategoryDTO extends DTO
{
    private $m_ProductID;
    private $m_CategoryID;

    //  Constructors
    public function __construct($productID, $categoryID)
    {
        $this->m_ProductID = $productID;
        $this->m_CategoryID = $categoryID;
    }

    //  Methods
    public function getProductID()
    {
        return $this->m_ProductID;
    }
    
    public function getCategoryID()
    {
        return $this->m_CategoryID;
    }
}