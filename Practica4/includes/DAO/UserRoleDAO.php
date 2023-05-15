<?php

namespace es\ucm\fdi\aw\DAO;

require_once 'includes/config.php';

use es\ucm\fdi\aw\DTO\DTO;
use es\ucm\fdi\aw\DTO\UserRoleDTO;

class UserRoleDAO extends DAO
{
    private const TABLE_NAME = 'users_roles';
    private const USER_ID_KEY = 'userID';
    private const ROLE_ID_KEY = 'roleID';

    public function __construct()
    {
        parent::__construct(self::TABLE_NAME);
    }

    public function deleteCompoundKey($first_id, $second_id) : bool
    {
        $tableName = self::TABLE_NAME;
        $userID = self::USER_ID_KEY;
        $roleID = self::ROLE_ID_KEY;

        $query = "DELETE FROM $tableName WHERE $userID = :$userID AND $roleID = :$roleID";

        $statement = $this->m_DatabaseProxy->prepare($query);
        $statement->bindParam($userID, $first_id);
        $statement->bindParam($roleID, $second_id);
        
        return $statement->execute();
    }

    protected function createDTOFromArray($array): DTO
    {
        $userID = $array[self::USER_ID_KEY];
        $roleID = $array[self::ROLE_ID_KEY];

        return new UserRoleDTO($userID, $roleID);
    }
    
    protected function createArrayFromDTO($dto): array
    {
        $dtoArray = array(
            self::USER_ID_KEY => $dto->getUserID(),
            self::ROLE_ID_KEY => $dto->getRoleID(),
        );

        return $dtoArray;
    }
}
?>