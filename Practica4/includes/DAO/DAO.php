<?php

namespace es\ucm\fdi\aw\DAO;

require_once dirname(__DIR__).'/config.php';

use es\ucm\fdi\aw\Application;
use es\ucm\fdi\aw\DTO\DTO;

//  Note: possible SQL injection when using parameters. Investigate
abstract class DAO
{
    //  Constants
    private const ID_KEY = 'id';

    //  Fields
    protected $m_TableName;
    protected $m_DatabaseProxy;

    //  Constructors
    public function __construct($tableName)
    {
        $this->m_TableName = $tableName;
        $this->m_DatabaseProxy = Application::getInstance()->getDatabaseProxy();
    }

    //  Methods
    public function create($dto): bool
    {
        $dtoArray = $this->createArrayFromDTO($dto);
        $dtoArrayKeys = array_keys($dtoArray);

        $columns = $dtoArrayKeys[0];
        $values = ":{$dtoArrayKeys[0]}";

        for ($i = 1; $i < count($dtoArrayKeys); ++$i) {
            $column = $dtoArrayKeys[$i];

            if ($dtoArray[$column] == null)
                continue;

            $columns .= ", $column";
            $values .= ", :$column";
        }

        $query = "INSERT INTO {$this->m_TableName} ($columns) VALUES ($values);";
        $statement = $this->m_DatabaseProxy->prepare($query);

        foreach ($dtoArrayKeys as $key)
            $statement->bindParam(":$key", $dtoArray[$key]);

        return $statement->execute();
    }

    public function read($id = null, $filters = array()): array
    {
        if ($id != null)
            $filters[self::ID_KEY] = $id;

        $filterConstraint = " WHERE ";

        $filterKeys = array_keys($filters);
        $numFilters = count($filters);

        for ($i = 0; $i < $numFilters; ++$i) {
            $filterConstraint .= "{$filterKeys[$i]} = :{$filterKeys[$i]}";

            if ($i < $numFilters - 1)
                $filterConstraint .= ' AND ';
        }

        $query = "SELECT * FROM {$this->m_TableName}" . ($numFilters > 0 ? $filterConstraint : '');
        $statement = $this->m_DatabaseProxy->prepare($query);

        foreach ($filters as $filterKey => $filterValue)
            $statement->bindValue(":$filterKey", $filterValue);


        $statement->execute();
        $results = array();

        foreach ($statement as $result)
            array_push($results, $this->createDTOFromArray($result));

        return $results;
    }

    public function update($dto) : bool
    {
        $dtoArray = $this->createArrayFromDTO($dto);
        $dtoArrayKeys = array_keys($dtoArray);
        
        $updateVariables = "{$dtoArrayKeys[0]} = :{$dtoArrayKeys[0]}";

        for ($i = 1; $i < count($dtoArrayKeys); ++$i) {
            $column = $dtoArrayKeys[$i];
            $updateVariables .= ", {$column} = :{$column}";
        }

        $idKey = self::ID_KEY;
        $query = "UPDATE {$this->m_TableName} SET $updateVariables WHERE $idKey = {$dto->getID()};";
        // $query = "UPDATE products SET id = 15, name = 'holi', description = 'nuevaDesc', imgName = 'nuevafoto.png', price = '123', offer = '0' WHERE id = 15;";

        $statement = $this->m_DatabaseProxy->prepare($query);

        foreach ($dtoArrayKeys as $key) 
            $statement->bindParam(":$key", $dtoArray[$key]);
        
        return $statement->execute();
    }

    

    public function delete($id): bool
    {
        $idKey = self::ID_KEY;
        $query = "DELETE FROM {$this->m_TableName} WHERE $idKey = :$idKey";

        $statement = $this->m_DatabaseProxy->prepare($query);
        $statement->bindParam($idKey, $id);

        return $statement->execute();
    }

    public abstract function createDTOFromArray($array): DTO;
    public abstract function createArrayFromDTO($DTO): array;
}
