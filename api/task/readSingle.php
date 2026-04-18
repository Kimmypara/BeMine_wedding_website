<?php

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json");
header("Access-Control-Allow-Methods: GET");

header("Access-Control-Allow-Headers: Access-Control-Allow-Origin, Content-Type, Access-Control-Allow-Methods, Authorization, X-Requested-With");

include_once("../../includes/initialize.php");

// creat a new instance of the Tasks class
// This allows us to use its structure and function
$task = new Task($db);


// validate task_id from query string
if(empty($_GET["task_id"])){
    http_response_code(400);
    echo json_encode(array("message" => "Missing task_id."));
    exit();
}

//call new function parameter
//$task->task_id  =  isset($_GET["task_id"]) ? $_GET["task_id"]: die();

$task->task_id = $_GET["task_id"];

$result = $task->readSingle();
$num = $result->rowCount();

if($num > 0){
   $task_info = array(
    'task_id'      =>$task->task_id,
    'task_name'       =>$task->task_name,
    'category_id'   =>$task->category_id
   );

    http_response_code(200);
    echo json_encode($task_info);
}
else{
    http_response_code(404);
    echo json_encode(array("message" => "No tasks found."));
    }



?>
