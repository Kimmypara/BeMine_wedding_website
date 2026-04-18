<?php

class Task{
    // db related properties
private $conn;
private $table ="task";
private $alias = "t";

    // table fields
public $task_id;
public $category_id;
public $task_name;

    //constructor with db connection
    // a function that is triggered automatically when an instance of the class is created
    public function __construct($db){
        $this->conn = $db;
    }

    public function read(){
        $query = "SELECT * 
            FROM {$this->table} AS {$this->alias}
            ORDER BY {$this->alias}.task_name ASC;";

            $stmt = $this->conn->prepare($query);

            $stmt->execute();

            return $stmt;
    }

    // read a single task record by Id
    public function readSingle(){
        $query = "SELECT *
        FROM {$this->table} AS {$this->alias}
        WHERE {$this->alias}.task_id = ?
        LIMIT 1;";

        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $this->task_id);
        $stmt->execute();

        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($row > 0){
           
            $this->category_id = $row["category_id"];
            $this->task_name = $row["task_name"];
           
        }

        return $stmt;
    }

    // create a new task record
public function create(){
    $query = "INSERT INTO {$this->table}
    (category_id, task_name)
    VALUES (:category_id, :task_name);";

    $stmt = $this->conn->prepare($query);

    // clean up data sent by user
  
     $this->category_id = htmlspecialchars(strip_tags($this->category_id));
     $this->task_name = htmlspecialchars(strip_tags($this->task_name));
    // bind parameters to sql statement

     $stmt->bindParam(":category_id", $this->category_id);
     $stmt->bindParam(":task_name", $this->task_name);

    if($stmt->execute()){
        return true;
    }
   
    printf("Error %s. \n", $stmt->error);
    
    return false;
}

//update a task record
public function update(){
    $query = "UPDATE {$this->table}
            SET category_id = :category_id,
                task_name = :task_name
                WHERE task_id = :task_id;";

                $stmt = $this->conn->prepare($query);

    // clean up data sent by user
    $this->task_id = htmlspecialchars(strip_tags($this->task_id));
    $this->category_id = htmlspecialchars(strip_tags($this->category_id));
    $this->task_name = htmlspecialchars(strip_tags($this->task_name));

    // bind parameters to sql statement
    $stmt->bindParam(":task_id", $this->task_id);
    $stmt->bindParam(":category_id", $this->category_id);
    $stmt->bindParam(":task_name", $this->task_name);

    if($stmt->execute()){
        return true;
    }
   
    printf("Error %s. \n", $stmt->error);
    
    return false;
}


public function taskExists(){
    $query = "SELECT task_id
              FROM {$this->table}
              WHERE task_name = :task_name
              LIMIT 1;";

    $stmt = $this->conn->prepare($query);
    $stmt->bindParam(":task_name", $this->task_name);
    $stmt->execute();

    return $stmt->rowCount() > 0;
}

public function categoryIdExists(){
    $query = "SELECT category_id 
              FROM category 
              WHERE category_id = :category_id 
              LIMIT 1;";

    $stmt = $this->conn->prepare($query);
    $stmt->bindParam(":category_id", $this->category_id);
    $stmt->execute();

    return $stmt->rowCount() > 0;
}

}

?>