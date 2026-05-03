<?php

class WeddingPlan{
    // db related properties
private $conn;
private $table ="wedding_plan";
private $alias = "wp";

    // table fields
public $wedding_plan_id;
public $user_id;
public $user_nickname;
public $partner_nickname;
public $wedding_date;
public $guest_count;
public $budget;
public $created_at;


    //constructor with db connection
    // a function that is triggered automatically when an instance of the class is created
    public function __construct($db){
        $this->conn = $db;
    }

    public function read(){
        $query = "SELECT * 
            FROM {$this->table} AS {$this->alias}
            ORDER BY {$this->alias}.wedding_date ASC;";

            $stmt = $this->conn->prepare($query);

            $stmt->execute();

            return $stmt;
    }


    

    // read a single user record by Id
    public function readSingle(){
        $query = "SELECT *
        FROM {$this->table} AS {$this->alias}
        WHERE {$this->alias}.wedding_plan_id = ?
        LIMIT 1;";

        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $this->wedding_plan_id);
        $stmt->execute();

        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($row > 0){
           
            $this->user_id = $row["user_id"];
            $this->user_nickname = $row["user_nickname"];
            $this->partner_nickname = $row["partner_nickname"];
            $this->wedding_date = $row["wedding_date"];
            $this->guest_count = $row["guest_count"];
            $this->budget = $row["budget"];
            $this->created_at = $row["created_at"];
        }

        return $stmt;
    }

    // create a new user record
public function create(){
    $query = "INSERT INTO {$this->table}
    (user_id, user_nickname, partner_nickname,wedding_date, guest_count,budget, created_at)
    VALUES (:user_id, :user_nickname, :partner_nickname, :wedding_date, :guest_count, :budget, :created_at);";

    $stmt = $this->conn->prepare($query);

    // clean up data sent by user
  
     $this->user_id = htmlspecialchars(strip_tags($this->user_id));
    $this->user_nickname = htmlspecialchars(strip_tags($this->user_nickname));
    $this->partner_nickname = htmlspecialchars(strip_tags($this->partner_nickname));
    $this->wedding_date = htmlspecialchars(strip_tags($this->wedding_date));
    $this->guest_count = htmlspecialchars(strip_tags($this->guest_count));
    $this->budget = htmlspecialchars(strip_tags($this->budget));
    $this->created_at = date('Y-m-d H:i:s');
   

    // bind parameters to sql statement

     $stmt->bindParam(":user_id", $this->user_id);
    $stmt->bindParam(":user_nickname", $this->user_nickname);
    $stmt->bindParam(":partner_nickname", $this->partner_nickname);
    $stmt->bindParam(":wedding_date", $this->wedding_date);
    $stmt->bindParam(":guest_count", $this->guest_count);
    $stmt->bindParam(":budget", $this->budget);
    $stmt->bindParam(":created_at", $this->created_at);


    
    if($stmt->execute()){
         $this->wedding_plan_id = $this->conn->lastInsertId();
        return true;
    }
   
    printf("Error %s. \n", $stmt->error);
    
    return false;
}

//update a wedding plan record (PATCH)
public function update(){
    $query = "UPDATE {$this->table}
            SET user_nickname = :user_nickname,
                partner_nickname = :partner_nickname,
                wedding_date = :wedding_date,
                guest_count = :guest_count,
                budget = :budget
                WHERE wedding_plan_id = :wedding_plan_id;";

                $stmt = $this->conn->prepare($query);

    // clean up data sent by user
    $this->wedding_plan_id = htmlspecialchars(strip_tags($this->wedding_plan_id));
    $this->wedding_plan_id = htmlspecialchars(strip_tags($this->wedding_plan_id));
    $this->user_nickname = htmlspecialchars(strip_tags($this->user_nickname));
    $this->partner_nickname = htmlspecialchars(strip_tags($this->partner_nickname));
    $this->wedding_date = htmlspecialchars(strip_tags($this->wedding_date));
    $this->guest_count = htmlspecialchars(strip_tags($this->guest_count));
    $this->budget = htmlspecialchars(strip_tags($this->budget));


    // bind parameters to sql statement
    $stmt->bindParam(":wedding_plan_id", $this->wedding_plan_id);
    $stmt->bindParam(":user_nickname", $this->user_nickname);
    $stmt->bindParam(":partner_nickname", $this->partner_nickname);
    $stmt->bindParam(":wedding_date", $this->wedding_date);
    $stmt->bindParam(":guest_count", $this->guest_count);
    $stmt->bindParam(":budget", $this->budget);


    if($stmt->execute()){
        return true;
    }
   
    printf("Error %s. \n", $stmt->error);
    
    return false;
}

//update user_nickname 
public function updateUserNickname(){
    $query = "UPDATE {$this->table}
            SET user_nickname = :user_nickname
                WHERE wedding_plan_id = :wedding_plan_id;";

                $stmt = $this->conn->prepare($query);

    // clean up data sent by user
    $this->wedding_plan_id = htmlspecialchars(strip_tags($this->wedding_plan_id));
    $this->user_nickname = htmlspecialchars(strip_tags($this->user_nickname));

    // bind parameters to sql statement
    $stmt->bindParam(":wedding_plan_id", $this->wedding_plan_id);
    $stmt->bindParam(":user_nickname", $this->user_nickname);

    if($stmt->execute()){
        return true;
    }
   
    printf("Error %s. \n", $stmt->error);
    
    return false;
}

//update partner_nickname 
public function updatePartnerNickname(){
    $query = "UPDATE {$this->table}
            SET partner_nickname = :partner_nickname
                WHERE wedding_plan_id = :wedding_plan_id;";

                $stmt = $this->conn->prepare($query);

    // clean up data sent by user
    $this->wedding_plan_id = htmlspecialchars(strip_tags($this->wedding_plan_id));
    $this->partner_nickname = htmlspecialchars(strip_tags($this->partner_nickname));

    // bind parameters to sql statement
    $stmt->bindParam(":wedding_plan_id", $this->wedding_plan_id);
    $stmt->bindParam(":partner_nickname", $this->partner_nickname);

    if($stmt->execute()){
        return true;
    }
   
    printf("Error %s. \n", $stmt->error);
    
    return false;
}

//update wedding_date
public function updateWeddingDate(){
    $query = "UPDATE {$this->table}
            SET wedding_date = :wedding_date
                WHERE wedding_plan_id = :wedding_plan_id;";

                $stmt = $this->conn->prepare($query);

    // clean up data sent by user
    $this->wedding_plan_id = htmlspecialchars(strip_tags($this->wedding_plan_id));
    $this->wedding_date = htmlspecialchars(strip_tags($this->wedding_date));

    // bind parameters to sql statement
    $stmt->bindParam(":wedding_plan_id", $this->wedding_plan_id);
    $stmt->bindParam(":wedding_date", $this->wedding_date);

    if($stmt->execute()){
        return true;
    }
   
    printf("Error %s. \n", $stmt->error);
    
    return false;
}



//update guest_count
public function updateGuestCount(){
    $query = "UPDATE {$this->table}
            SET guest_count = :guest_count
                WHERE wedding_plan_id = :wedding_plan_id;";

                $stmt = $this->conn->prepare($query);

    // clean up data sent by user
    $this->wedding_plan_id = htmlspecialchars(strip_tags($this->wedding_plan_id));
    $this->guest_count = htmlspecialchars(strip_tags($this->guest_count));

    // bind parameters to sql statement
    $stmt->bindParam(":wedding_plan_id", $this->wedding_plan_id);
    $stmt->bindParam(":guest_count", $this->guest_count);

    if($stmt->execute()){
        return true;
    }
   
    printf("Error %s. \n", $stmt->error);
    
    return false;
}

public function guestCountInvalid(){
    return !filter_var($this->guest_count, FILTER_VALIDATE_INT) || $this->guest_count <= 0;
}



//update budget
public function updateBudget(){
    $query = "UPDATE {$this->table}
            SET budget = :budget
                WHERE wedding_plan_id = :wedding_plan_id;";

                $stmt = $this->conn->prepare($query);

    // clean up data sent by user
    $this->wedding_plan_id = htmlspecialchars(strip_tags($this->wedding_plan_id));
    $this->budget = htmlspecialchars(strip_tags($this->budget));

    // bind parameters to sql statement
    $stmt->bindParam(":wedding_plan_id", $this->wedding_plan_id);
    $stmt->bindParam(":budget", $this->budget);

    if($stmt->execute()){
        return true;
    }
   
    printf("Error %s. \n", $stmt->error);
    
    return false;
}

public function budgetInvalid(){
     return !is_numeric($this->budget) || $this->budget <= 0;
}


//Delete a user record
public function delete(){
    $query = "DELETE FROM {$this->table}
                WHERE wedding_plan_id = :wedding_plan_id;";

                $stmt = $this->conn->prepare($query);

    // clean up data sent by user
    $this->wedding_plan_id = htmlspecialchars(strip_tags($this->wedding_plan_id));

    // bind parameters to sql statement
    $stmt->bindParam(":wedding_plan_id", $this->wedding_plan_id);

    if($stmt->execute()){
        return true;
    }
   
    printf("Error %s. \n", $stmt->error);
    
    return false;
}
public function userIdExists(){
    $query = "SELECT user_id  
              FROM wedding_plan 
              WHERE user_id  = :user_id  
              LIMIT 1;";

    $stmt = $this->conn->prepare($query);
    $stmt->bindParam(":user_id", $this->user_id );
    $stmt->execute();

    return $stmt->rowCount() > 0;
}


public function weddingPlanExists(){
    $query = "SELECT wedding_plan_id  
              FROM wedding_plan 
              WHERE wedding_plan_id  = :wedding_plan_id  
              LIMIT 1;";

    $stmt = $this->conn->prepare($query);
    $stmt->bindParam(":wedding_plan_id", $this->wedding_plan_id );
    $stmt->execute();

    return $stmt->rowCount() > 0;
}

public function weddingDateInvalid($wedding_date){
    $d = DateTime::createFromFormat('Y-m-d', $wedding_date);
    return !($d && $d->format('Y-m-d') === $wedding_date);
}
}

?>