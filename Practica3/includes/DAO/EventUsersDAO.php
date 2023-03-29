<?php 
namespace es\ucm\fdi\aw\DAO;

use es\ucm\fdi\aw\Application;

class EventUsersDAO extends DAO { 
  public function __construct() { 
    parent::__construct("events_users"); 
  }

  public function getUserInfoInEvent($eventID) {
    $statement = Application::getSingleton()->connect()->prepare("SELECT * FROM events_users eu LEFT JOIN users u ON u.mail = eu.user WHERE eu.event_id = :event_id");
    $statement->bindParam('event_id', $eventID);
    $statement->execute();

    return $statement->fetchAll();
  }
}
