<?php

namespace es\ucm\fdi\aw\DAO;

use es\ucm\fdi\aw\DTO\DTO;
use es\ucm\fdi\aw\DTO\EventRoleDTO;

require_once 'includes/config.php';

class EventRolesDAO extends DAO
{
    //  Constants
    private const TABLE_NAME = 'event_roles';

    private const ID_KEY = 'id';
    private const NAME_KEY = 'name';

    //  Constructors
    public function __construct()
    {
        parent::__construct(self::TABLE_NAME);
    }

    //  Methods
    public function getRoleForPlayer($playerID, $eventID): string
    {
        $query = "SELECT er.name FROM event_roles er INNER JOIN events_users eu ON er.id = eu.eventRoleID WHERE eu.eventID = :eventID AND eu.userID = :playerID";

        $statement = $this->m_DatabaseProxy->prepare($query);
        $statement->bindParam(':eventID', $eventID);
        $statement->bindParam(':playerID', $playerID);
        $statement->execute();
        
        return $statement->fetch()['name'];
    }
    public function getRolesName(): array
    {
        $query = "SELECT er.id, er.name FROM event_roles er";

        $statement = $this->m_DatabaseProxy->prepare($query);
        $statement->execute();

        $results = array();

        foreach ($statement->fetchAll() as $result)
            $results[$result['id']] = $result['name'];

        return $results;
    }
    public function getCountPerRole($eventID): array
    {
        $query = "SELECT er.id, COUNT(*) AS count FROM events_users eu INNER JOIN event_roles er ON eu.eventRoleID = er.id WHERE eu.eventID = :eventID GROUP BY eventRoleID";

        $statement = $this->m_DatabaseProxy->prepare($query);
        $statement->bindParam(':eventID', $eventID);
        $statement->execute();

        $results = array();

        foreach ($statement->fetchAll() as $result)
            $results[$result['id']] = $result['count'];

        return $results;
    }
    public function getMaximumsPerRole(): array
    {
        $query = "SELECT er.id, er.maximum FROM event_roles er";
        
        $statement = $this->m_DatabaseProxy->prepare($query);
        $statement->execute();

        $results = array();

        foreach ($statement->fetchAll() as $result)
            $results[$result['id']] = $result['maximum'];

        return $results;
    }

    protected function createDTOFromArray($array): DTO
    {
        $id = $array[self::ID_KEY];
        $name = $array[self::NAME_KEY];

        return new EventRoleDTO($id, $name);
    }
    protected function createArrayFromDTO($dto): array
    {
        return array(
            self::ID_KEY => $dto->getID(),
            self::NAME_KEY => $dto->getName()
        );
    }
}
