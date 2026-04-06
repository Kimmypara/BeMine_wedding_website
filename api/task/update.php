<?php

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json");
header("Access-Control-Allow-Methods: PUT");

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
//read submitted json data from request body
$data = json_decode(file_get_contents("php://input"));

// fill in user instance properties with decoded values from request
$task->task_id  = $data->task_id ;
$task->category_id = $data->category_id;
$task->task_name = $data->task_name;

if($task->update()){
    echo json_encode(array("message" => "Task updated."));
}
else{
echo json_encode(array("message" => "Task not updated."));
    }

?>
