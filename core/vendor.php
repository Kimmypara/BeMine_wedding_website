<?php

class Vendor{
    // db related properties
private $conn;
private $table ="vendor";
private $alias = "v";

    // table fields
public $vendor_id;
public $vendor_name;
public $category_id;
public $user_id;

    //constructor with db connection
    // a function that is triggered automatically when an instance of the class is created
    public function __construct($db){
        $this->conn = $db;
    }

    public function read(){
        $query = "SELECT * 
            FROM {$this->table} AS {$this->alias}
            ORDER BY {$this->alias}.vendor_name ASC;";

            $stmt = $this->conn->prepare($query);

            $stmt->execute();

            return $stmt;
    }

    // read a single user record by Id
    public function readSingle(){
        $query = "SELECT vendor_id, vendor_name, category_id, user_id
        FROM {$this->table} AS {$this->alias}
        WHERE {$this->alias}.vendor_id = ?
        LIMIT 1;";

        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $this->vendor_id);
        $stmt->execute();

        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($row){
            $this->vendor_id = $row["vendor_id"];
            $this->vendor_name = $row["vendor_name"];
            $this->category_id = $row["category_id"];
            $this->user_id = $row["user_id"];
        }

        return $stmt;
    }

        // Read all vendors records created by a category_id
    Public function readByCategoryId(){
$query = "SELECT *
        FROM {$this->table} AS {$this->alias}
        WHERE {$this->alias}.category_id = ?;";

        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $this->category_id);
        $stmt->execute();

        return $stmt;
    }


    // create a new user record
public function create(){
    $query = "INSERT INTO {$this->table}
    (vendor_id, vendor_name, category_id,user_id)
    VALUES (:vendor_id, :vendor_name, :category_id, :user_id);";

    $stmt = $this->conn->prepare($query);

    // clean up data sent by user
  
     $this->vendor_id = htmlspecialchars(strip_tags($this->vendor_id));
    $this->vendor_name = htmlspecialchars(strip_tags($this->vendor_name));
    $this->category_id = htmlspecialchars(strip_tags($this->category_id));
    $this->user_id = htmlspecialchars(strip_tags($this->user_id));
  
    // bind parameters to sql statement

     $stmt->bindParam(":vendor_id", $this->vendor_id);
    $stmt->bindParam(":vendor_name", $this->vendor_name);
    $stmt->bindParam(":category_id", $this->category_id);
    $stmt->bindParam(":user_id", $this->user_id);
    
    if($stmt->execute()){
        return true;
    }
   
    printf("Error %s. \n", $stmt->error);
    
    return false;
}

public function vendorNameExists(){
    $query = "SELECT vendor_name 
              FROM vendor 
              WHERE vendor_name = :vendor_name 
              LIMIT 1;";

    $stmt = $this->conn->prepare($query);
    $stmt->bindParam(":vendor_name", $this->vendor_name);
    $stmt->execute();

    return $stmt->rowCount() > 0;
}


//update a vendor record (PATCH)
public function update(){
    $query = "UPDATE {$this->table}
            SET vendor_name = :vendor_name,
                category_id = :category_id,
                user_id = :user_id
                WHERE vendor_id = :vendor_id;";

                $stmt = $this->conn->prepare($query);

    // clean up data sent by vendor
    $this->vendor_id = htmlspecialchars(strip_tags($this->vendor_id));
    $this->vendor_name = htmlspecialchars(strip_tags($this->vendor_name));
    $this->category_id = htmlspecialchars(strip_tags($this->category_id));
    $this->user_id = htmlspecialchars(strip_tags($this->user_id));


    // bind parameters to sql statement
    $stmt->bindParam(":vendor_id", $this->vendor_id);
    $stmt->bindParam(":vendor_name", $this->vendor_name);
    $stmt->bindParam(":category_id", $this->category_id);
    $stmt->bindParam(":user_id", $this->user_id);
 
     if($stmt->execute()){
        if($stmt->rowCount() > 0){
            return true;
        }
    }

    return false;
}


//Delete a vendor record
public function delete(){
    $query = "DELETE FROM {$this->table}
                WHERE vendor_id = :vendor_id;";

                $stmt = $this->conn->prepare($query);

    // clean up data sent by vendor
    $this->vendor_id = htmlspecialchars(strip_tags($this->vendor_id));

    // bind parameters to sql statement
    $stmt->bindParam(":vendor_id", $this->vendor_id);

    if($stmt->execute()){
        return true;
    }
   
    printf("Error %s. \n", $stmt->error);
    
    return false;
}
}

?>