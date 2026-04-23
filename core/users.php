<?php

class Users{
    // db related properties
private $conn;
private $table ="users";
private $alias = "u";

    // table fields
public $user_id;
public $email;
public $first_name;
public $last_name;
public $password_hash;
public $created_at;
public $role_id;
public $is_active;


    //constructor with db connection
    // a function that is triggered automatically when an instance of the class is created
    public function __construct($db){
        $this->conn = $db;
    }


    public function read(){
        $query = "SELECT * 
            FROM {$this->table} AS {$this->alias}
            ORDER BY {$this->alias}.first_name ASC;";

            $stmt = $this->conn->prepare($query);

            $stmt->execute();

            return $stmt;
    }

    // read a single user record by Id
    public function readSingle(){
        $query = "SELECT user_id, first_name, last_name, email, created_at, role_id, is_active
        FROM {$this->table} AS {$this->alias}
        WHERE {$this->alias}.user_id = ?
        LIMIT 1;";

        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $this->user_id);
        $stmt->execute();

        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($row){
            $this->user_id = $row["user_id"];
            $this->first_name = $row["first_name"];
            $this->last_name = $row["last_name"];
            $this->email = $row["email"];
            $this->created_at = $row["created_at"];
            $this->role_id = $row["role_id"];
            $this->is_active = $row["is_active"];
        }

        return $stmt;
    }

public function emailExists(){
    $query = "SELECT user_id
              FROM {$this->table}
              WHERE email = :email
              LIMIT 1;";

    $stmt = $this->conn->prepare($query);
    $stmt->bindParam(":email", $this->email);
    $stmt->execute();

    return $stmt->rowCount() > 0;
}

function invalidEmail($email){
    return !filter_var($email, FILTER_VALIDATE_EMAIL);
}

    // create a new user record
public function create(){
    $query = "INSERT INTO {$this->table}
    (first_name, last_name, email,password_hash, created_at,role_id, is_active)
    VALUES (:first_name, :last_name, :email, :password_hash, :created_at, :role_id, :is_active);";

    $stmt = $this->conn->prepare($query);

    // clean up data sent by user
  
     $this->first_name = htmlspecialchars(strip_tags($this->first_name));
    $this->last_name = htmlspecialchars(strip_tags($this->last_name));
    $this->email = htmlspecialchars(strip_tags($this->email));
    $this->password_hash = htmlspecialchars(strip_tags($this->password_hash));
    $this->role_id = htmlspecialchars(strip_tags($this->role_id));
    $this->is_active = htmlspecialchars(strip_tags($this->is_active));
    $this->created_at = date('Y-m-d H:i:s');

    // bind parameters to sql statement

     $stmt->bindParam(":first_name", $this->first_name);
    $stmt->bindParam(":last_name", $this->last_name);
    $stmt->bindParam(":email", $this->email);
    $stmt->bindParam(":password_hash", $this->password_hash);
    $stmt->bindParam(":created_at", $this->created_at);
    $stmt->bindParam(":role_id", $this->role_id);
    $stmt->bindParam(":is_active", $this->is_active);


    
    if($stmt->execute()){
        return true;
    }
   
    printf("Error %s. \n", $stmt->error);
    
    return false;
}

public function firstNameInvalid(){
    return empty(trim($this->first_name)) ||
           !preg_match("/^[a-zA-Z\s'-]+$/", $this->first_name);
}

public function lastNameInvalid(){
    return empty(trim($this->last_name)) ||
           !preg_match("/^[a-zA-Z\s'-]+$/", $this->last_name);
}

public function isActiveInvalid(){
    return !in_array((string)$this->is_active, ['0', '1'], true);
}



//update a user record (PATCH because role_is and created_at cannot be updated)
public function update(){
    $query = "UPDATE {$this->table}
            SET first_name = :first_name,
                last_name = :last_name,
                email = :email,
                password_hash = :password_hash,
                is_active = :is_active
                WHERE user_id = :user_id;";

                $stmt = $this->conn->prepare($query);

    // clean up data sent by user
    $this->user_id = htmlspecialchars(strip_tags($this->user_id));
    $this->first_name = htmlspecialchars(strip_tags($this->first_name));
    $this->last_name = htmlspecialchars(strip_tags($this->last_name));
    $this->email = htmlspecialchars(strip_tags($this->email));
    $this->password_hash = htmlspecialchars(strip_tags($this->password_hash));
    $this->is_active = htmlspecialchars(strip_tags($this->is_active));


    // bind parameters to sql statement
    $stmt->bindParam(":user_id", $this->user_id);
    $stmt->bindParam(":first_name", $this->first_name);
    $stmt->bindParam(":last_name", $this->last_name);
    $stmt->bindParam(":email", $this->email);
    $stmt->bindParam(":password_hash", $this->password_hash);
    $stmt->bindParam(":is_active", $this->is_active);


     if($stmt->execute()){
        if($stmt->rowCount() > 0){
            return true;
        }
    }

    return false;
}

//update password of a user record
public function updatePassword(){
    $query = "UPDATE {$this->table}
            SET password_hash = :password_hash
                WHERE user_id = :user_id;";

                $stmt = $this->conn->prepare($query);

    // clean up data sent by user
    $this->user_id = htmlspecialchars(strip_tags($this->user_id));
    $this->password_hash = htmlspecialchars(strip_tags($this->password_hash));

    // bind parameters to sql statement
    $stmt->bindParam(":user_id", $this->user_id);
    $stmt->bindParam(":password_hash", $this->password_hash);

    if($stmt->execute()){
        if($stmt->rowCount() > 0){
            return true;
        }
    }

    return false;
}

//Delete a user record
public function delete(){
    $query = "DELETE FROM {$this->table}
                WHERE user_id = :user_id;";

                $stmt = $this->conn->prepare($query);

    // clean up data sent by user
    $this->user_id = htmlspecialchars(strip_tags($this->user_id));

    // bind parameters to sql statement
    $stmt->bindParam(":user_id", $this->user_id);

    if($stmt->execute()){
        return true;
    }
   
    printf("Error %s. \n", $stmt->error);
    
    return false;
}
}

?>