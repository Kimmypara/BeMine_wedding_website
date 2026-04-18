<?php

//Only for testing
session_start();

$_SESSION['user_id'] = 1;
$_SESSION['role_id'] = 1;
// Only for testing

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json");
header("Access-Control-Allow-Methods: POST");

header("Access-Control-Allow-Headers: Access-Control-Allow-Origin, Content-Type, Access-Control-Allow-Methods, Authorization, X-Requested-With");

include_once("../../includes/initialize.php");

define('ROLE_ADMIN', 1);
define('ROLE_COUPLE', 2);
define('ROLE_VENDOR', 3);

function requireAdmin(){
    if(session_status() === PHP_SESSION_NONE){
        session_start();
    }

    if(!isset($_SESSION['user_id']) || !isset($_SESSION['role_id'])){
        http_response_code(401);
        echo json_encode(array("message" => "Unauthorized"));
        exit();
    }

    if((int)$_SESSION['role_id'] !== ROLE_ADMIN){
        http_response_code(403);
        echo json_encode(array("message" => "Access denied. Admin only."));
        exit();
    }
}

requireAdmin();

// creat a new instance of the Task class
// This allows us to use its structure and function
$task = new Task($db);

$data = json_decode(file_get_contents("php://input"));

// fill in task instance properties with decoded values from request
$task->category_id  = $data->category_id ;
$task->task_name = $data->task_name;



    // validate
if (
    empty($task->category_id) ||
    empty($task->task_name) 
){
    http_response_code(400);
    echo json_encode(array("message" => "Task not created. Missing or invalid input."));
}
elseif(!$task->categoryIdExists()){
    http_response_code(400);
    echo json_encode(array("message" => "Invalid category_id. Category does not exist."));
}
elseif($task->taskExists()){
    http_response_code(409);
    echo json_encode(array("message" => "Task not created. Task already exists."));
}
elseif($task->create()){
    http_response_code(201);
    echo json_encode(array("message" => "Task created."));
}

else{
    http_response_code(500);
    echo json_encode(array("message" => "Server error."));
}

?>