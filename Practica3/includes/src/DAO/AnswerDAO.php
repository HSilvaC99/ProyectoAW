<?php
namespace es\ucm\fdi\aw\src\DAO;
class AnswerDAO extends DAO
{
  public function __construct()
  {
    parent::__construct("foro_respuestas");
  }
  public function updateA($id, $data)
  {
    $this->update('id', $id, $data);
  }
}
?>