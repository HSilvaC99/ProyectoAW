<?php

namespace es\ucm\fdi\aw\DAO;

use es\ucm\fdi\aw\DTO\DTO;
use es\ucm\fdi\aw\DTO\EventDTO;

require_once 'includes/config.php';

class EventDAO extends DAO
{
    //  Constants
    private const TABLE_NAME = 'events';

    private const ID_KEY = 'id';
    private const NAME_KEY = 'name';
    private const DESCRIPTION_KEY = 'description';
    private const DATE_KEY = 'date';

    //  Constructors
    public function __construct()
    {
        parent::__construct(self::TABLE_NAME);
    }

    //  Methods
    public function getCountByRoleID($eventID, $roleID): int
    {
        $query = "SELECT COUNT(eu.eventRoleID) FROM events_users eu WHERE eu.eventID = :eventID AND eu.eventRoleID = :roleID GROUP BY eu.eventRoleID";

        $statement = $this->m_DatabaseProxy->prepare($query);
        $statement->bindParam(':eventID', $eventID);
        $statement->bindParam(':roleID', $roleID);
        $statement->execute();

        $result = $statement->fetch(); //  Should always be only 1 element (maybe check if more than 1 result was returned?)

        if (!$result)
            return 0;

        return reset($result);  //  Use reset to return first column (only one since it's a COUNT select)
    }
    public function getPlayersForEvent($eventID): array
    {
        $query = "SELECT u.name, eu.eventRoleID FROM users u INNER JOIN events_users eu ON u.id = eu.userID WHERE eu.eventID = :eventID";

        $statement = $this->m_DatabaseProxy->prepare($query);
        $statement->bindParam(':eventID', $eventID);
        $statement->execute();

        return $statement->fetchAll();
    }
    public function getEventForPlayer($playerID): array
    {
        $query = 'SELECT e.name AS eventName, e.id AS eventID FROM events_users eu INNER JOIN events e ON e.id = eu.eventID WHERE eu.userID = :playerID';

        $statement = $this->m_DatabaseProxy->prepare($query);
        $statement->bindParam(':playerID', $playerID);
        $statement->execute();

        return $statement->fetchAll();
    }
    public function joinEvent($playerID, $eventID, $eventRoleID): bool
    {
        $query = "INSERT INTO events_users (eventID, userID, eventRoleID) VALUES (:eventID, :userID, :eventRoleID)";

        $statement = $this->m_DatabaseProxy->prepare($query);
        $statement->bindParam(':eventID', $eventID);
        $statement->bindParam(':userID', $playerID);
        $statement->bindParam(':eventRoleID', $eventRoleID);

        return $statement->execute();
    }
    public function abandonEvent($playerID, $eventID): bool
    {
        $query = 'DELETE FROM events_users WHERE eventID = :eventID AND userID = :userID';

        $statement = $this->m_DatabaseProxy->prepare($query);
        $statement->bindParam(':eventID', $eventID);
        $statement->bindParam(':userID', $playerID);

        return $statement->execute();
    }
    public function playerHasJoinedEvent($playerID, $eventID): bool
    {
        $query = 'SELECT COUNT(*) FROM events_users eu WHERE eu.eventID = :eventID AND eu.userID = :userID GROUP BY eu.eventID';

        $statement = $this->m_DatabaseProxy->prepare($query);
        $statement->bindParam(':eventID', $eventID);
        $statement->bindParam(':userID', $playerID);

        if (!$statement->execute())
            return false;

        $results = $statement->fetch();

        if (!$results)
            return false;

        return count($results) != 0;
    }

    protected function createDTOFromArray($array): DTO
    {
        $id = $array[self::ID_KEY] ?? -1;
        $name = $array[self::NAME_KEY];
        $description = $array[self::DESCRIPTION_KEY];
        $date = $array[self::DATE_KEY];

        return new EventDTO($id, $name, $description, $date);
    }
    protected function createArrayFromDTO($dto): array
    {
        $dtoArray = array(
            self::NAME_KEY => $dto->getName(),
            self::DESCRIPTION_KEY => $dto->getDescription(),
            self::DATE_KEY => $dto->getDate()
        );

        if ($dto->getID() != -1)
            $dtoArray[self::ID_KEY] = $dto->getID();

        return $dtoArray;
    }
}
