<?php

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json");
header("Access-Control-Allow-Methods: PATCH");
header("Access-Control-Allow-Headers: Access-Control-Allow-Origin, Content-Type, Access-Control-Allow-Methods, Authorization, X-Requested-With");

include_once("../../includes/initialize.php");

$users = new Users($db);
$data = json_decode(file_get_contents("php://input"));

$users->user_id = $data->user_id ?? null;
$users->email = $data->email ?? "";
$users->first_name = $data->first_name ?? "";
$users->last_name = $data->last_name ?? "";
$users->password_hash = !empty($data->password) ? password_hash($data->password, PASSWORD_DEFAULT) : "";
$users->is_active = $data->is_active ?? "";

/* Missing input */
if (
    empty($users->user_id) ||
    empty($users->email) ||
    empty($users->first_name) ||
    empty($users->last_name) ||
    empty($data->password)
){
    http_response_code(400);
    echo json_encode(["message" => "User not updated. Missing or invalid input."]);
    exit;
}

/* Check user exists */
$currentUser = new Users($db);
$currentUser->user_id = $users->user_id;
$result = $currentUser->readSingle();

if($result->rowCount() === 0){
    http_response_code(404);
    echo json_encode(["message" => "User ID does not exist."]);
    exit;
}

/* Validations */
if($users->invalidEmail($users->email)){
    http_response_code(400);
    echo json_encode(["message" => "Invalid email format."]);
    exit;
}

if($users->firstNameInvalid()){
    http_response_code(400);
    echo json_encode(["message" => "Invalid user name."]);
    exit;
}

if($users->lastNameInvalid()){
    http_response_code(400);
    echo json_encode(["message" => "Invalid user surname."]);
    exit;
}

if($users->isActiveInvalid()){
    http_response_code(400);
    echo json_encode(["message" => "Invalid Is Active value. Use 0 or 1 only."]);
    exit;
}

/* Check email only if changed */
if($users->email !== $currentUser->email && $users->emailExistsForOtherUser()){
    http_response_code(409);
    echo json_encode(["message" => "User not updated. E-mail already exists."]);
    exit;
}

/* Update */
if($users->update()){
    http_response_code(200);
    echo json_encode(["message" => "User updated."]);
}
else{
    http_response_code(500);
    echo json_encode(["message" => "Server error."]);
}

?>