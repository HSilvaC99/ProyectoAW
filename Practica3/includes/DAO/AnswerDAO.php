<?php
namespace es\ucm\fdi\aw\DAO;
class AnswerDAO extends DAO 
{ 
  public function __construct() 
  { 
    parent::__construct("foro_respuestas"); 
  } 

  public function deleteById($id) 
  { 
    $this->delete('id_pregunta', $id); 
  }
  
  public function getById($id) 
  { 
    $this->get('id', $id); 
  } 

  public function updateA($id, $data) 
  { 
    $this->update('id', $id, $data); 
  } 
} 

?>