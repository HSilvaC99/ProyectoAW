<?php 
namespace es\ucm\fdi\aw\src\DAO;

class QuestionDAO extends DAO 
{ 
  public function __construct()
  {
    parent::__construct("foro_preguntas");
  }

  public function updateQ($id, $column, $value)
  {
    $this->updateOnce('id', $id, $column, $value);
  }
}
?>