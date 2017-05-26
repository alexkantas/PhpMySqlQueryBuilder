<?php

namespace Kantas_net\Database;

class QueryBuilder{

    private $pdo;

    public function __construct(\PDO $pdo){
        $this->pdo = $pdo;
    }

    public function select($table){

    $statement = $this->pdo->prepare("SELECT * FROM {$table}");

    $statement->execute();

    return $statement->fetchAll(\PDO::FETCH_OBJ);

    }

    public function selectWhere($table,$attribute,$value){
    
    $query = "SELECT * FROM $table WHERE $attribute = $value";

    $statement = $this->pdo->prepare($query);

    $statement->execute();

    return $statement->fetchAll(\PDO::FETCH_OBJ);

    }

    public function selectSingleElementWhere($table,$attribute,$value){
    
    $query = sprintf("SELECT * FROM %s WHERE %s = %s LIMIT 1",$table,$attribute,$value);

    $statement = $this->pdo->prepare($query);

    $statement->execute();

    return $statement->fetch(\PDO::FETCH_OBJ);

    }

    public function updateWhere($table,$attribute,$value,$setData){
    
    $query = sprintf("UPDATE %s set %s WHERE %s=%s",$table,
    substr(
    implode(
    array_map(function ($e){
         return $e.'=:'.$e.','; },array_keys($setData))
    ),
    0,-1),
    $attribute,
    $value
    );

    $statement = $this->pdo->prepare($query);

    $statement->execute($setData);

    }

    public function insertInto($table,$data){ //let $table='user' , $data = ["employee_id" => '3','user_type' => 'ADMIN', 'username' => 'vivian', 'lastname' => 'vivian']

    $query = sprintf("INSERT INTO %s (%s) VALUES (%s)",
    $table,
    implode(',',array_keys($data)), 
    ":".implode(', :',array_keys($data))
    );

    //$query = "INSERT INTO user (employee_id,user_type,username,lastname) VALUES (:employee_id, :user_type, :username, :lastname)"

    $statement = $this->pdo->prepare($query); 

    $statement->execute($data); //name placeholeders replaced with real arguments

    }

    public function deleteWhere($table,$attribute,$value){
    
    $query = "DELETE FROM $table WHERE $attribute = $value";
    
    $statement = $this->pdo->prepare($query);
    
    $statement->execute();

    }
    
}