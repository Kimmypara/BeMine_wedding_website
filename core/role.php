<?php

class Role{
    // db related properties
private $conn;
private $table ="role";
private $alias = "r";

    // table fields
public $role_id;
public $role_name;

    //constructor with db connection
    // a function that is triggered automatically when an instance of the class is created
    public function __construct($db){
        $this->conn = $db;
    }

    public function read(){
        $query = "SELECT * 
            FROM {$this->table} AS {$this->alias}
            ORDER BY {$this->alias}.role_name ASC;";

            $stmt = $this->conn->prepare($query);

            $stmt->execute();

            return $stmt;
    }

    // read a single role record by Id
    public function readSingle(){
        $query = "SELECT *
        FROM {$this->table} AS {$this->alias}
        WHERE {$this->alias}.role_id = ?
        LIMIT 1;";

        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $this->role_id);
        $stmt->execute();

        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($row > 0){
           
            $this->role_name = $row["role_name"];
           
        }

        return $stmt;
    }

    // create a new role record
public function create(){
    $query = "INSERT INTO {$this->table}
    (role_name)
    VALUES (:role_name);";

    $stmt = $this->conn->prepare($query);

    // clean up data sent by user
  
     $this->role_name = htmlspecialchars(strip_tags($this->role_name));
    // bind parameters to sql statement

     $stmt->bindParam(":role_name", $this->role_name);

    if($stmt->execute()){
        return true;
    }
   
    printf("Error %s. \n", $stmt->error);
    
    return false;
}

//update role_name of a user record
public function update(){
    $query = "UPDATE {$this->table}
            SET role_name = :role_name
                WHERE role_id = :role_id;";

                $stmt = $this->conn->prepare($query);

    // clean up data sent by user
    $this->role_id = htmlspecialchars(strip_tags($this->role_id));
    $this->role_name = htmlspecialchars(strip_tags($this->role_name));

    // bind parameters to sql statement
    $stmt->bindParam(":role_id", $this->role_id);
    $stmt->bindParam(":role_name", $this->role_name);

    if($stmt->execute()){
        return true;
    }
   
    printf("Error %s. \n", $stmt->error);
    
    return false;
}

public function roleExists(){
    $query = "SELECT role_id
              FROM {$this->table}
              WHERE role_name = :role_name
              LIMIT 1;";

    $stmt = $this->conn->prepare($query);
    $stmt->bindParam(":role_name", $this->role_name);
    $stmt->execute();

    return $stmt->rowCount() > 0;
}

}

?>