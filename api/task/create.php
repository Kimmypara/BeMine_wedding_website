<?php

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json");
header("Access-Control-Allow-Methods: POST");

header("Access-Control-Allow-Headers: Access-Control-Allow-Origin, Content-Type, Access-Control-Allow-Methods, Authorization, X-Requested-With");

include_once("../../includes/initialize.php");

// creat a new instance of the Role class
// This allows us to use its structure and function
$task = new Task($db);

$data = json_decode(file_get_contents("php://input"));

// fill in role instance properties with decoded values from request
$task->category_id  = $data->category_id ;
$task->task_name = $data->task_name;


if($task->create()){
    echo json_encode(array("message" => "Task created."));
}
else{
echo json_encode(array("message" => "Task not created."));
    }

?>