<?php

namespace es\ucm\fdi\aw;

require_once 'config.php';

use PDO;
use PDOException;

class DatabaseProxy
{
    //  Constants
    public const HOST_KEY = 'host';
    public const DATABASE_NAME_KEY = 'name';
    public const USERNAME_KEY = 'user';
    public const PASSWORD_KEY = 'pass';
    public const PDO_OPTIONS_KEY = 'pdo_options';

    private const DEFAULT_OPTIONS = array(
        self::HOST_KEY => DATABASE_HOST,
        self::DATABASE_NAME_KEY => DATABASE_NAME,
        self::USERNAME_KEY => DATABASE_USERNAME,
        self::PASSWORD_KEY => DATABASE_PASSWORD,
        self::PDO_OPTIONS_KEY => array(
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
        )
    );

    //  Fields
    private $m_Connection;

    //  Constructors
    public function __construct($databaseOptions = array())
    {
        $databaseOptions = array_merge(self::DEFAULT_OPTIONS, $databaseOptions);

        $host = $databaseOptions[self::HOST_KEY];
        $name = $databaseOptions[self::DATABASE_NAME_KEY];
        $username = $databaseOptions[self::USERNAME_KEY];
        $password = $databaseOptions[self::PASSWORD_KEY];
        $PDOOptions = $databaseOptions[self::PDO_OPTIONS_KEY];

        try {
            $this->m_Connection = new PDO("mysql:host=$host;dbname=$name", $username, $password, $PDOOptions);
        } catch (PDOException $e) {
            die('PDO connection error: ' . $e->getMessage());
        }
    }

    public function prepare($query)
    {
        return $this->m_Connection->prepare($query);
    }

    public function lastInsertId()
    {
        return $this->m_Connection->lastInsertId();
    }
}
