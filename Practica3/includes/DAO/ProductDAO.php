<?php
namespace es\ucm\fdi\aw\DAO;
class ProductDAO extends DAO
{
  public function __construct($connection)
  {
    parent::__construct("products", $connection);
  }
}
?>