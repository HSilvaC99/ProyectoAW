<?php

namespace es\ucm\fdi\aw\DAO;

require_once 'includes/config.php';

use es\ucm\fdi\aw\DTO\DTO;
use es\ucm\fdi\aw\DTO\UserDTO;

class UserDAO extends DAO
{
    //  Constants
    private const TABLE_NAME = 'users';

    private const ID_KEY = 'id';
    private const NAME_KEY = 'name';
    private const SURNAME_KEY = 'surname';
    private const EMAIL_KEY = 'email';
    private const PASSWORD_HASH_KEY = 'passwordHash';

    //  Constructors
    public function __construct()
    {
        parent::__construct(self::TABLE_NAME);
    }

    //  Methods
    public function getUserRoles($userID): array
    {
        $query = "SELECT r.id, r.roleName FROM roles r INNER JOIN users_roles ur ON r.id = ur.roleID WHERE ur.userID = :userID;";

        $statement = $this->m_DatabaseProxy->prepare($query);
        $statement->bindParam(':userID', $userID);
        $statement->execute();

        $results = array();
        $roleDAO = new RoleDAO();

        foreach ($statement as $result) {
            array_push($results, $roleDAO->createDTOFromArray($result));
        }

        return $results;
    }


    
    public function getContact($userID): array
    {
        $query = 'SELECT name AS userName, surname AS sur, email AS em
        FROM users 
        WHERE id = :userID';

        $statement = $this->m_DatabaseProxy->prepare($query);
        $statement->bindParam(':userID', $userID);
        $statement->execute();

        return $statement->fetchAll();
    }

    public function UpdateEmail($userID, $email) : bool
    {
        $query = 'UPDATE users SET email = :email WHERE id = :userID';
        $statement = $this->m_DatabaseProxy->prepare($query);
        $statement->bindValue(':userID', $userID);
        $statement->bindValue(':email', $email);


        return $statement->execute();
    }

    public function UpdateContact($userID, $nombre, $apellido, $email): bool
    {
        $query = 'UPDATE users SET name = :nombre, surname = :apellido, email = :email WHERE id = :userID';
        $statement = $this->m_DatabaseProxy->prepare($query);
        $statement->bindValue(':userID', $userID);
        $statement->bindValue(':nombre', $nombre);
        $statement->bindValue(':apellido', $apellido);
        $statement->bindValue(':email', $email);


        return $statement->execute();
    }

    protected function createDTOFromArray($array): DTO
    {
        $id = $array[self::ID_KEY] ?? -1;
        $name = $array[self::NAME_KEY];
        $surname = $array[self::SURNAME_KEY];
        $email = $array[self::EMAIL_KEY];
        $passwordHash = $array[self::PASSWORD_HASH_KEY];

        return new UserDTO($id, $name, $surname, $email, $passwordHash);
    }
    protected function createArrayFromDTO($dto): array
    {
        $dtoArray = array(
            self::NAME_KEY => $dto->getName(),
            self::SURNAME_KEY => $dto->getSurname(),
            self::EMAIL_KEY => $dto->getEmail(),
            self::PASSWORD_HASH_KEY => $dto->getPasswordHash()
        );

        if ($dto->getID() != -1)
            $dtoArray[self::ID_KEY] = $dto->getID();

        return $dtoArray;
    }
}
