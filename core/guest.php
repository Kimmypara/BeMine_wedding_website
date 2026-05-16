<?php

class Guest{
    // db related properties
private $conn;
private $table ="guest";
private $alias = "g";

    // table fields
public $guest_id ;
public $wedding_plan_id ;
public $guest_email;
public $guest_name;
public $guest_surname;
public $rsvp_status;
public $guest_category;



    //constructor with db connection
    // a function that is triggered automatically when an instance of the class is created
    public function __construct($db){
        $this->conn = $db;
    }


    public function read(){
        $query = "SELECT * 
            FROM {$this->table} AS {$this->alias}
            ORDER BY {$this->alias}.guest_name ASC;";

            $stmt = $this->conn->prepare($query);

            $stmt->execute();

            return $stmt;
    }

    // read a single guest record by Id
    public function readSingle(){
        $query = "SELECT guest_id, wedding_plan_id, guest_email, guest_name, guest_surname, rsvp_status, guest_category
        FROM {$this->table} AS {$this->alias}
        WHERE {$this->alias}.guest_id = ?
        LIMIT 1;";

        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $this->guest_id);
        $stmt->execute();

        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($row){
            $this->guest_id = $row["guest_id"];
            $this->wedding_plan_id = $row["wedding_plan_id"];
            $this->guest_email = $row["guest_email"];
            $this->guest_name = $row["guest_name"];
            $this->guest_surname = $row["guest_surname"];
            $this->rsvp_status = $row["rsvp_status"];
            $this->guest_category = $row["guest_category"];
            
        }

        return $stmt;
    }

public function readByWeddingPlan(){
    $query = "SELECT *
              FROM {$this->table}
              WHERE wedding_plan_id = :wedding_plan_id
              ORDER BY guest_name ASC;";

    $stmt = $this->conn->prepare($query);

    $stmt->bindParam(":wedding_plan_id", $this->wedding_plan_id);

    $stmt->execute();

    return $stmt;
}

    // create a new guest record
public function create(){
    $query = "INSERT INTO {$this->table}
    (wedding_plan_id, guest_email, guest_name,guest_surname, rsvp_status, guest_category)
    VALUES (:wedding_plan_id, :guest_email, :guest_name, :guest_surname, :rsvp_status, :guest_category);";

    $stmt = $this->conn->prepare($query);

     $this->wedding_plan_id = htmlspecialchars(strip_tags($this->wedding_plan_id));
    $this->guest_email = htmlspecialchars(strip_tags($this->guest_email));
    $this->guest_name = htmlspecialchars(strip_tags($this->guest_name));
    $this->guest_surname = htmlspecialchars(strip_tags($this->guest_surname));
    $this->rsvp_status = htmlspecialchars(strip_tags($this->rsvp_status));
    $this->guest_category = htmlspecialchars(strip_tags($this->guest_category));
   

    // bind parameters to sql statement

     $stmt->bindParam(":wedding_plan_id", $this->wedding_plan_id);
    $stmt->bindParam(":guest_email", $this->guest_email);
    $stmt->bindParam(":guest_name", $this->guest_name);
    $stmt->bindParam(":guest_surname", $this->guest_surname);
    $stmt->bindParam(":rsvp_status", $this->rsvp_status);
    $stmt->bindParam(":guest_category", $this->guest_category);
  
    if($stmt->execute()){
        return true;
    }
   
    printf("Error %s. \n", $stmt->error);
    
    return false;
}

public function WeddingPlanIdExists(){
    $query = "SELECT wedding_plan_id
              FROM wedding_plan
              WHERE wedding_plan_id = :wedding_plan_id
              LIMIT 1;";

    $stmt = $this->conn->prepare($query);
    $stmt->bindParam(":wedding_plan_id", $this->wedding_plan_id);
    $stmt->execute();

    return $stmt->rowCount() > 0;
}

public function GuestIdExists(){
    $query = "SELECT guest_id
              FROM guest
              WHERE guest_id = :guest_id
              LIMIT 1;";

    $stmt = $this->conn->prepare($query);
    $stmt->bindParam(":guest_id", $this->guest_id);
    $stmt->execute();

    return $stmt->rowCount() > 0;
}

public function guestNameInvalid(){
    return empty(trim($this->guest_name)) ||
           !preg_match("/^[a-zA-Z\s'-]+$/", $this->guest_name);
}

public function guestSurnameInvalid(){
    return empty(trim($this->guest_surname)) ||
           !preg_match("/^[a-zA-Z\s'-]+$/", $this->guest_surname);
}

public function rsvpStatusInvalid(){
    return !in_array($this->rsvp_status, ['pending', 'accepted', 'declined'], true);
}

//update a guest record 
public function update(){
    $query = "UPDATE {$this->table}
            SET guest_email = :guest_email,
                guest_name = :guest_name,
                guest_surname = :guest_surname,
                rsvp_status = :rsvp_status,
                guest_category = :guest_category
                WHERE guest_id = :guest_id;";

                $stmt = $this->conn->prepare($query);

    // clean up data sent by user
    $this->guest_id = htmlspecialchars(strip_tags($this->guest_id));
    $this->guest_email = htmlspecialchars(strip_tags($this->guest_email));
    $this->guest_name = htmlspecialchars(strip_tags($this->guest_name));
    $this->guest_surname = htmlspecialchars(strip_tags($this->guest_surname));
    $this->rsvp_status = htmlspecialchars(strip_tags($this->rsvp_status));
    $this->guest_category = htmlspecialchars(strip_tags($this->guest_category));


    // bind parameters to sql statement
    $stmt->bindParam(":guest_id", $this->guest_id);
    $stmt->bindParam(":guest_email", $this->guest_email);
    $stmt->bindParam(":guest_name", $this->guest_name);
    $stmt->bindParam(":guest_surname", $this->guest_surname);
    $stmt->bindParam(":rsvp_status", $this->rsvp_status);
    $stmt->bindParam(":guest_category", $this->guest_category);

     if($stmt->execute()){
        if($stmt->rowCount() > 0){
            return true;
        }
    }

    return false;
}

//update a guest record 
public function updateGuestEmail(){
    $query = "UPDATE {$this->table}
            SET guest_email = :guest_email
                WHERE guest_id = :guest_id;";

                $stmt = $this->conn->prepare($query);

    // clean up data sent by user
    $this->guest_id = htmlspecialchars(strip_tags($this->guest_id));
    $this->guest_email = htmlspecialchars(strip_tags($this->guest_email));
   
    // bind parameters to sql statement
    $stmt->bindParam(":guest_id", $this->guest_id);
    $stmt->bindParam(":guest_email", $this->guest_email);
 
     if($stmt->execute()){
        if($stmt->rowCount() > 0){
            return true;
        }
    }

    return false;
}

public function guestEmailExists(){
    $query = "SELECT guest_id
              FROM {$this->table}
              WHERE guest_email = :guest_email
              LIMIT 1;";

    $stmt = $this->conn->prepare($query);
    $stmt->bindParam(":guest_email", $this->guest_email);
    $stmt->execute();

    return $stmt->rowCount() > 0;
}

public function rsvpStatusSame(){
    $query = "SELECT guest_id
              FROM {$this->table}
               WHERE guest_id = :guest_id
              AND rsvp_status = :rsvp_status
              LIMIT 1;";

    $stmt = $this->conn->prepare($query);
    $stmt->bindParam(":guest_id", $this->guest_id);
    $stmt->bindParam(":rsvp_status", $this->rsvp_status);
    $stmt->execute();

    return $stmt->rowCount() > 0;
}

function invalidGuestEmail($guest_email){
    return !filter_var($guest_email, FILTER_VALIDATE_EMAIL);
}


//update a guest record 
public function updateGuestNameSurname(){
    $query = "UPDATE {$this->table}
            SET guest_name = :guest_name,
                guest_surname = :guest_surname
                WHERE guest_id = :guest_id;";

                $stmt = $this->conn->prepare($query);

    // clean up data sent by user
    $this->guest_id = htmlspecialchars(strip_tags($this->guest_id));
    $this->guest_name = htmlspecialchars(strip_tags($this->guest_name));
    $this->guest_surname = htmlspecialchars(strip_tags($this->guest_surname));
   


    // bind parameters to sql statement
    $stmt->bindParam(":guest_id", $this->guest_id);
    $stmt->bindParam(":guest_name", $this->guest_name);
    $stmt->bindParam(":guest_surname", $this->guest_surname);
 


     if($stmt->execute()){
        if($stmt->rowCount() > 0){
            return true;
        }
    }

    return false;
}

//update a guest record 
public function updateRSVPStatus(){
    $query = "UPDATE {$this->table}
            SET rsvp_status = :rsvp_status
                WHERE guest_id = :guest_id;";

                $stmt = $this->conn->prepare($query);

    // clean up data sent by user
    $this->guest_id = htmlspecialchars(strip_tags($this->guest_id));
    $this->rsvp_status = htmlspecialchars(strip_tags($this->rsvp_status));
  
    // bind parameters to sql statement
    $stmt->bindParam(":guest_id", $this->guest_id);
    $stmt->bindParam(":rsvp_status", $this->rsvp_status);

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
                WHERE guest_id = :guest_id;";

                $stmt = $this->conn->prepare($query);

    // clean up data sent by user
    $this->guest_id = htmlspecialchars(strip_tags($this->guest_id));

    // bind parameters to sql statement
    $stmt->bindParam(":guest_id", $this->guest_id);

    if($stmt->execute()){
        return true;
    }
   
    printf("Error %s. \n", $stmt->error);
    
    return false;
}
}

?>