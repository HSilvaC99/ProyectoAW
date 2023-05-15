<?php

namespace es\ucm\fdi\aw;

require_once 'config.php';

use es\ucm\fdi\aw\DAO\ProductDAO;
use es\ucm\fdi\aw\DatabaseProxy;

class Application
{
    //  Fields
    private static $s_Instance;

    private $m_DatabaseProxy;

    //  Constructors
    private function __construct()
    {
        $this->m_DatabaseProxy = new DatabaseProxy();
    }

    //  Methods
    public static function getInstance(): Application
    {
        if (!isset(self::$s_Instance))
            self::$s_Instance = new Application();

        return self::$s_Instance;
    }

    public function readProductsLikeName(string $name, array $filters): array
    {
        $productDAO = new ProductDAO();
        $results = $productDAO->readLikeName($name, $filters);

        return $results;
    }

    public function getDatabaseProxy(): DatabaseProxy
    {
        return $this->m_DatabaseProxy;
    }
    public function loginUser($userDTO): void
    {
        $_SESSION['user'] = $userDTO;
    }
}
