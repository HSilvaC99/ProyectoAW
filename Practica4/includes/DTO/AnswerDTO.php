<?php

namespace es\ucm\fdi\aw\DTO;

require_once dirname(__DIR__).'/config.php';

class AnswerDTO extends DTO
{
  private $m_ID;
  private $m_Message;
  private $m_Date;

  public function __construct($id, $message, $date)
  {
    $this->m_ID = $id;
    $this->m_Message = $message;
    $this->m_Date = $date;
  }

  public function getID()
  {
    return $this->m_ID;
  }

  public function getMessage()
  {
    return $this->m_Message;
  }

  public function getCreationDate()
  {
    return $this->m_Date;
  }
}
?>