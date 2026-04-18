<?php

//Only for testing
session_start();

$_SESSION['user_id'] = 1;
$_SESSION['role_id'] = 1;
// Only for testing


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

// create a new instance of the Role class
// This allows us to use its structure and function
$role = new Role($db);
//read submitted json data from request body
$data = json_decode(file_get_contents("php://input"));

// fill in user instance properties with decoded values from request
$role->role_id  = $data->role_id;
$role->role_name  = $data->role_name;


 // validate
if (
    empty($role->role_name) 
){
    http_response_code(400);
    echo json_encode(array("message" => "Role not updated. Missing or invalid input."));
}
elseif($role->roleExists()){
    http_response_code(409);
    echo json_encode(array("message" => "Role not updated. Role already exists."));
}
elseif($role->update()){
    http_response_code(200);
    echo json_encode(array("message" => "Role updated."));
}

else{
    http_response_code(500);
    echo json_encode(array("message" => "Server error."));
}

?>
