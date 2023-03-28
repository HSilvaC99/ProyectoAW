<?php 
namespace es\ucm\fdi\aw; 
class QuestionDAO extends DAO 
{ 
  public function __construct()
  {
    parent::__construct("foro_preguntas");
  }

  public function deleteById($id)
  {
    $this->delete('id', $id); 
  }

  public function getById($id) 
  { 
    $this->get('id', $id); 
  } 

  public function updateQ($id, $column, $value) 
{ 
    $this->updateOnce('id', $id, $column, $value); 
} 
} 
?>