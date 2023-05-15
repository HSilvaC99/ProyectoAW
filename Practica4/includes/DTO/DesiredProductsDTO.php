<?php

namespace es\ucm\fdi\aw\DTO;

require_once dirname(__DIR__).'/config.php';

class DesiredProductsDTO extends DTO
{
    //  Fields
    private $m_listID;
    private $m_productID;
    private $m_date;

    //  Constructors
    public function __construct($list, $prod,$date)
    {
        $this->m_listID = $list;
        $this->m_productID = $prod;
        $this->m_date = $date;
    }

    //  Methods
    public function getListID()
    {
        return $this->m_listID;
    }
    
    public function getProductID()
    {
        return $this->m_productID;
    }

    public function getDate()
    {
        return $this->m_date;
    }
}
