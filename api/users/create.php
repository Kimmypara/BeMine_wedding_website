<?php

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json");
header("Access-Control-Allow-Methods: POST");

header("Access-Control-Allow-Headers: Access-Control-Allow-Origin, Content-Type, Access-Control-Allow-Methods, Authorization, X-Requested-With");

include_once("../../includes/initialize.php");

// creat a new instance of the User class
// This allows us to use its structure and function
$users = new Users($db);

$data = json_decode(file_get_contents("php://input"));

// fill in user instance properties with decoded values from request
$users->email = $data->email;
$users->first_name = $data->first_name;
$users->last_name = $data->last_name;
$users->password_hash = password_hash($data->password, PASSWORD_DEFAULT);
$users->role_id = $data->role_id;
$users->is_active = $data->is_active;

if($users->create()){
    echo json_encode(array("message" => "User created."));
}
else{
echo json_encode(array("message" => "User not created."));
    }

?>