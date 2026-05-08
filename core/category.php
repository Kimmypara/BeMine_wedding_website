<?php

class Category{
    // db related properties
private $conn;
private $table ="category";
private $alias = "c";

    // table fields
public $category_id;
public $category_name;
public $slug;

    //constructor with db connection
    // a function that is triggered automatically when an instance of the class is created
    public function __construct($db){
        $this->conn = $db;
    }

    public function read(){
        $query = "SELECT * 
            FROM {$this->table} AS {$this->alias}
            ORDER BY {$this->alias}.category_name ASC;";

            $stmt = $this->conn->prepare($query);

            $stmt->execute();

            return $stmt;
    }

    // read a single category record by Id
    public function readSingle(){
        $query = "SELECT *
        FROM {$this->table} AS {$this->alias}
        WHERE {$this->alias}.category_id = ?
        LIMIT 1;";

        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $this->category_id);
        $stmt->execute();

        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($row > 0){
           
            $this->category_name = $row["category_name"];
            $this->slug = $row["slug"];
           
        }

        return $stmt;
    }

    // create a new category record
public function create(){
    $query = "INSERT INTO {$this->table}
    (category_name, slug)
    VALUES (:category_name, :slug);";

    $stmt = $this->conn->prepare($query);

    // clean up data sent by user
  
     $this->category_name = htmlspecialchars(strip_tags($this->category_name));
     $this->slug = htmlspecialchars(strip_tags($this->slug));
    // bind parameters to sql statement

     $stmt->bindParam(":category_name", $this->category_name);
     $stmt->bindParam(":slug", $this->slug);

    if($stmt->execute()){
        return true;
    }
   
    printf("Error %s. \n", $stmt->error);
    
    return false;
}

//update category_name of a user record
public function update(){
    $query = "UPDATE {$this->table}
            SET category_name = :category_name,
            slug= :slug
                WHERE category_id = :category_id;";

                $stmt = $this->conn->prepare($query);

    // clean up data sent by user
    $this->category_id = htmlspecialchars(strip_tags($this->category_id));
    $this->category_name = htmlspecialchars(strip_tags($this->category_name));
    $this->slug = htmlspecialchars(strip_tags($this->slug));

    // bind parameters to sql statement
    $stmt->bindParam(":category_id", $this->category_id);
    $stmt->bindParam(":category_name", $this->category_name);
    $stmt->bindParam(":slug", $this->slug);

    if($stmt->execute()){
        return true;
    }
   
    printf("Error %s. \n", $stmt->error);
    
    return false;
}

public function categoryNameExists(){
    $query = "SELECT category_name 
              FROM category 
              WHERE category_name = :category_name 
              LIMIT 1;";

    $stmt = $this->conn->prepare($query);
    $stmt->bindParam(":category_name", $this->category_name);
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

//Delete a category record
public function delete(){
    $query = "DELETE FROM {$this->table}
                WHERE category_id = :category_id;";

                $stmt = $this->conn->prepare($query);

    // clean up data sent by category
    $this->category_id = htmlspecialchars(strip_tags($this->category_id));

    // bind parameters to sql statement
    $stmt->bindParam(":category_id", $this->category_id);

    if($stmt->execute()){
        return true;
    }
   
    printf("Error %s. \n", $stmt->error);
    
    return false;
}
}

?>