<?php

class WeddingPlanTask{
    // db related properties
private $conn;
private $table ="wedding_plan_task";
private $alias = "wpt";

    // table fields
public $wedding_plan_task_id;
public $wedding_plan_id;
public $task_id;
public $is_selected;
public $completed_at;
public $is_completed;
public $category_id;


    //constructor with db connection
    // a function that is triggered automatically when an instance of the class is created
    public function __construct($db){
        $this->conn = $db;
    }
// Show incomplete tasks first
    public function read(){
        $query = "SELECT * 
            FROM {$this->table} AS {$this->alias}
            ORDER BY {$this->alias}.is_completed ASC, {$this->alias}.wedding_plan_task_id DESC;";
            $stmt = $this->conn->prepare($query);

            $stmt->execute();

            return $stmt;
    }

    // read a single wedding_plan_task record by Id
    public function readSingle(){
        $query = "SELECT *
        FROM {$this->table} AS {$this->alias}
        WHERE {$this->alias}.wedding_plan_task_id = ?
        LIMIT 1;";

        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $this->wedding_plan_task_id);
        $stmt->execute();

        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($row){
           
            $this->wedding_plan_id = $row["wedding_plan_id"];
            $this->task_id = $row["task_id"];
            $this->is_selected = $row["is_selected"];
            $this->completed_at = $row["completed_at"];
            $this->is_completed = $row["is_completed"];
            $this->category_id = $row["category_id"];
        }

        return $stmt;
    }

    // create a new user record
public function create(){
    $query = "INSERT INTO {$this->table}
    (wedding_plan_id, task_id, is_selected,completed_at, is_completed, category_id)
    VALUES (:wedding_plan_id, :task_id, :is_selected, :completed_at, :is_completed, :category_id);";

    $stmt = $this->conn->prepare($query);

    // clean up data sent by user
  
     $this->wedding_plan_id = htmlspecialchars(strip_tags($this->wedding_plan_id));
    $this->task_id = htmlspecialchars(strip_tags($this->task_id));
    $this->is_selected = htmlspecialchars(strip_tags($this->is_selected));
    $this->completed_at = date('Y-m-d H:i:s');
    $this->is_completed = htmlspecialchars(strip_tags($this->is_completed));
    $this->category_id = htmlspecialchars(strip_tags($this->category_id));

    // bind parameters to sql statement

     $stmt->bindParam(":wedding_plan_id", $this->wedding_plan_id);
    $stmt->bindParam(":task_id", $this->task_id);
    $stmt->bindParam(":is_selected", $this->is_selected);
    $stmt->bindParam(":completed_at", $this->completed_at);
    $stmt->bindParam(":is_completed", $this->is_completed);
    $stmt->bindParam(":category_id", $this->category_id);

    
    if($stmt->execute()){
        return true;
    }
   
    printf("Error %s. \n", $stmt->error);
    
    return false;
}

//update a user record (PATCH)
public function update(){
    $query = "UPDATE {$this->table}
            SET wedding_plan_id = :wedding_plan_id,
                task_id = :task_id,
                is_selected = :is_selected,
                is_completed = :is_completed,
                category_id = :category_id
                WHERE wedding_plan_task_id = :wedding_plan_task_id;";

                $stmt = $this->conn->prepare($query);

    // clean up data sent by user
    $this->wedding_plan_task_id = htmlspecialchars(strip_tags($this->wedding_plan_task_id));
    $this->wedding_plan_id = htmlspecialchars(strip_tags($this->wedding_plan_id));
    $this->task_id = htmlspecialchars(strip_tags($this->task_id));
    $this->is_selected = htmlspecialchars(strip_tags($this->is_selected));
    $this->is_completed = htmlspecialchars(strip_tags($this->is_completed));
    $this->category_id = htmlspecialchars(strip_tags($this->category_id));


    // bind parameters to sql statement
    $stmt->bindParam(":wedding_plan_task_id", $this->wedding_plan_task_id);
    $stmt->bindParam(":wedding_plan_id", $this->wedding_plan_id);
    $stmt->bindParam(":task_id", $this->task_id);
    $stmt->bindParam(":is_selected", $this->is_selected);
    $stmt->bindParam(":is_completed", $this->is_completed);
    $stmt->bindParam(":category_id", $this->category_id);



    if($stmt->execute()){
        return true;
    }
   
    printf("Error %s. \n", $stmt->error);
    
    return false;
}

//update is_selected
public function updateIsSelected(){
    $query = "UPDATE {$this->table}
            SET is_selected = :is_selected
                WHERE wedding_plan_task_id = :wedding_plan_task_id;";

                $stmt = $this->conn->prepare($query);

    // clean up data sent by user
    $this->wedding_plan_task_id = htmlspecialchars(strip_tags($this->wedding_plan_task_id));
    $this->is_selected = htmlspecialchars(strip_tags($this->is_selected));

    // bind parameters to sql statement
    $stmt->bindParam(":wedding_plan_task_id", $this->wedding_plan_task_id);
    $stmt->bindParam(":is_selected", $this->is_selected);

    if($stmt->execute()){
        return true;
    }
   
    printf("Error %s. \n", $stmt->error);
    
    return false;
}

public function isSelectedInvalid(){
    return !in_array((string)$this->is_selected, ['0', '1'], true);
}

//update is_completed
// update is_completed
public function updateIsCompleted(){

    if($this->is_completed == 1){

        $query = "UPDATE {$this->table}
                SET is_completed = :is_completed,
                    completed_at = NOW()
                WHERE wedding_plan_task_id = :wedding_plan_task_id";

    } else {

        $query = "UPDATE {$this->table}
                SET is_completed = :is_completed,
                    completed_at = NULL
                WHERE wedding_plan_task_id = :wedding_plan_task_id";

    }

    $stmt = $this->conn->prepare($query);

    // clean up data sent by user
    $this->wedding_plan_task_id = htmlspecialchars(strip_tags($this->wedding_plan_task_id));
    $this->is_completed = htmlspecialchars(strip_tags($this->is_completed));

    // bind parameters
    $stmt->bindParam(":wedding_plan_task_id", $this->wedding_plan_task_id);
    $stmt->bindParam(":is_completed", $this->is_completed);

    if($stmt->execute()){
        return true;
    }

    printf("Error %s. \n", $stmt->error);

    return false;
}


public function isCompletedInvalid(){
    return !in_array((string)$this->is_completed, ['0', '1'], true);
}

//Delete a wedding_plan_task record
public function delete(){
    $query = "DELETE FROM {$this->table}
                WHERE wedding_plan_task_id = :wedding_plan_task_id;";

                $stmt = $this->conn->prepare($query);

    // clean up data sent by user
    $this->wedding_plan_task_id = htmlspecialchars(strip_tags($this->wedding_plan_task_id));

    // bind parameters to sql statement
    $stmt->bindParam(":wedding_plan_task_id", $this->wedding_plan_task_id);

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

public function taskIdExists(){
    $query = "SELECT task_id
              FROM task
              WHERE task_id = :task_id
              LIMIT 1;";

    $stmt = $this->conn->prepare($query);
    $stmt->bindParam(":task_id", $this->task_id);
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

public function weddingPlanTaskExists(){
    $query = "SELECT wedding_plan_task_id
              FROM {$this->table}
              WHERE wedding_plan_id = :wedding_plan_id
              AND category_id = :category_id
              AND task_id = :task_id
              LIMIT 1;";

    $stmt = $this->conn->prepare($query);
    $stmt->bindParam(":wedding_plan_id", $this->wedding_plan_id);
    $stmt->bindParam(":category_id", $this->category_id);
    $stmt->bindParam(":task_id", $this->task_id);
    $stmt->execute();

    return $stmt->rowCount() > 0;
}

public function weddingPlanTaskIdExists(){
    $query = "SELECT wedding_plan_task_id
              FROM {$this->table}
              WHERE wedding_plan_task_id = :wedding_plan_task_id
              LIMIT 1;";

    $stmt = $this->conn->prepare($query);
    $stmt->bindParam(":wedding_plan_task_id", $this->wedding_plan_task_id);
    $stmt->execute();

    return $stmt->rowCount() > 0;
}

}

?>