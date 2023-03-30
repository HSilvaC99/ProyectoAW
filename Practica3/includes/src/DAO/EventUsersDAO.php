<?php 
namespace es\ucm\fdi\aw\src\DAO;

class EventUsersDAO extends DAO { 
  public function __construct() { 
    parent::__construct("events_users"); 
  }

  public function getUserInfoInEvent($eventID) {
    $statement = $this->db->prepare("SELECT * FROM {$this->table} eu INNER JOIN users u ON u.mail = eu.user_mail WHERE eu.event_id = :event_id");
    $statement->bindParam('event_id', $eventID);
    $statement->execute();

    return $statement->fetchAll();
  }
  public function getEventsFromUser($userMail) {
    $statement = $this->db->prepare("SELECT e.id, e.name, e.description, e.date FROM {$this->table} eu INNER JOIN events e ON eu.event_id = e.id WHERE eu.user_mail = :user_mail");
    $statement->bindParam('user_mail', $userMail);
    $statement->execute();

    return $statement->fetchAll();
  }
}
