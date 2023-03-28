<?php 
namespace es\ucm\fdi\aw; 
class DAO { 
  private String $table; 
  private \PDO $db; 
 
  public function __construct(String $table) 
  { 
    $this->table = $table; 
    $this->db = Application::getSingleton()->connect();
  } 

  public function getAll () 
  { 
    $statement = $this->db->prepare("SELECT * FROM {$this->table}"); 
    $statement->execute(); 

    return $statement->fetchAll(); 
  } 

  public function get (String $key, $value) 
  { 
    $statement = $this->db->prepare("SELECT * FROM {$this->table} WHERE {$key} = :{$key} LIMIT 1"); 
    $statement->bindParam(":{$key}", $value); 

    $statement->execute(); 

    return $statement->fetch(); 
  } 

  public function insert ($data) 
  { 
    $query = "INSERT INTO {$this->table} ("; 
    
    foreach ($data as $field => $value) 
    { 
      $query .= "{$field},"; 
    } 
    $query = trim($query, ','); 
    $query .= ") VALUES ("; 
    
    foreach ($data as $field => $value) 
    { 
      $query .= ":$field,"; 
    } 
    $query = trim($query, ','); 
    $query .= ");"; 
    $statement = $this->db->prepare($query); 
    
    foreach ($data as $field => $value) 
    { 
      $statement->bindParam(":$field", $data[$field]); 
    } 
    
    //var_dump($statement); 
    $statement->execute(); 
  } 

  public function update (String $key, $value, $data) 
  { 
    $query = "UPDATE {$this->table} SET "; 
    foreach ($data as $field) 
    { 
      $query .= "{$field} = :{$field},"; 
    } 
    $query = trim($query, ','); 
    $query .= " WHERE {$key} = :{$key}"; 
    $statement = $this->db->prepare($query); 

    foreach ($data as $field) 
    { 
      $statement->bindParam(":{$field}", $value); 
    } 
    $statement->bindParam(":$field", $data[$field]); 
    $statement->execute(); 
  }

  public function updateOnce(String $key, $value, $column, $column_value) 
{ 
    $query = "UPDATE {$this->table} SET {$column} = :{$column} WHERE {$key} = :{$key}"; 
    $statement = $this->db->prepare($query); 

    $statement->bindParam(":{$column}", $column_value); 
    $statement->bindParam(":{$key}", $value); 

    $statement->execute(); 
} 
  public function delete (String $key, $value) 
  { 
    $statement = $this->db->prepare("DELETE FROM {$this->table} WHERE {$key} = :{$key}"); 
    $statement->bindParam(":{$key}", $value); 
    $statement->execute(); 
  } 
} 
?>