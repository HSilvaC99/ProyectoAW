<?php
namespace es\ucm\fdi\aw\DAO;
class UserDAO extends DAO
{
  public function __construct($connection)
  {
    parent::__construct("users", $connection);
  }
}
?>