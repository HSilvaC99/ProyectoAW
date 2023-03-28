<?php 
namespace es\ucm\fdi\aw; 
class Application 
{ 
  private static $instance; 

  private $dbData; 
  private $initialized = false; 
  private $conn; 

  public static function getSingleton() 
  { 
    if (!self::$instance instanceof self) 
    { 
      self::$instance = new self; 
    } 
    return self::$instance; 
  } 

  private function __construct() {} 

  public function __clone() 
  { 
    throw new \Exception('No se puede clonar este objeto.'); 
  } 

  public function __sleep() 
  { 
    throw new \Exception('No se puede serializar el objeto.'); 
  } 

  public function __wakeup() 
  { 
    throw new \Exception('No se puede deserializar el objeto.'); 
  } 

  public function init($dbData) 
  { 
    if ( !$this->initialized ) 
    { 
      $this->dbData = $dbData; 
    } 
    session_start(); 
    $this->initialized = true; 
  } 

  public function isInitialized() 
  { 
    if ( !$this->initialized ) 
    { 
      echo "App is not initialized"; 
      exit(); 
    } 
  } 

  public function shutdown() 
  { 
    $this->isInitialized(); 

    if ($this->conn !== null) 
    { 
      $this->conn == null; 
    } 
  } 

  public function connect() 
  { 
    $this->isInitialized(); 

    if (!$this->conn) 
    { 
      $host = $this->dbData['host']; 
      $name = $this->dbData['name']; 
      $user = $this->dbData['user']; 
      $pass = $this->dbData['pass']; 

      $options = [ 
        \PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION, 
        \PDO::ATTR_DEFAULT_FETCH_MODE => \PDO::FETCH_ASSOC 
      ]; 
      try 
      { 
        $this->conn = new \PDO("mysql:{$host}=localhost;dbname={$name}", $user, $pass, $options); 
      } 
      catch (\PDOException $e)  
      { 
        die("PDO Connection Error: " . $e->getMessage()); 
      } 
    } 
    return $this->conn; 
  } 
} 
?>