<?php

namespace es\ucm\fdi\aw\DAO;

require_once 'includes/config.php';

use es\ucm\fdi\aw\DTO\DTO;
use es\ucm\fdi\aw\DTO\RoleDTO;

class RoleDAO extends DAO
{
    //  Constants
    private const TABLE_NAME = 'roles';
    private const ID_KEY = 'id';
    private const ROLE_NAME_KEY = 'roleName';

    //  Constructors
    public function __construct()
    {
        parent::__construct(self::TABLE_NAME);
    }

    //  Methods
    protected function createDTOFromArray($array): DTO
    {
        $id = $array[self::ID_KEY];
        $roleName = $array[self::ROLE_NAME_KEY];

        return new RoleDTO($id, $roleName);
    }
    protected function createArrayFromDTO($dto): array
    {
        return array(
            self::ID_KEY => $dto->getID(),
            self::ROLE_NAME_KEY => $dto->getRoleName()
        );
    }
}