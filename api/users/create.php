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
$users->role_id = $data->role_id ?? 2;
$users->is_active = $data->is_active;

// validate
if (
    empty($users->email) ||
    empty($users->first_name) ||
    empty($users->last_name) ||
    empty($data->password) 
){
    http_response_code(400);
    echo json_encode(array("message" => "User not created. Missing or invalid input."));
}

elseif($users->invalidEmail($users->email)){
    http_response_code(400);
    echo json_encode(array("message" => "Invalid email format."));
}
elseif($users->emailExists()){
    http_response_code(409);
    echo json_encode(array("message" => "User not created. E-mail already exists."));
}
elseif($users->firstNameInvalid()){
    http_response_code(400);
    echo json_encode(["message" => "Invalid user name."]);
}

elseif($users->lastNameInvalid()){
    http_response_code(400);
    echo json_encode(["message" => "Invalid user surname."]);
}
elseif($users->isActiveInvalid()){
    http_response_code(400);
    echo json_encode(array("message" => "Invalid Is Active value. Use 0 or 1 only."));
}

elseif($users->create()){
    http_response_code(201);
    echo json_encode(array("message" => "User created."));
}
else{
    http_response_code(500);
    echo json_encode(array("message" => "Server error."));
}

?>

