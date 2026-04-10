<?php

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json");
header("Access-Control-Allow-Methods: PATCH");

header("Access-Control-Allow-Headers: Access-Control-Allow-Origin, Content-Type, Access-Control-Allow-Methods, Authorization, X-Requested-With");

include_once("../../includes/initialize.php");

// creat a new instance of the users class
// This allows us to use its structure and function
$users = new Users($db);
//read submitted json data from request body
$data = json_decode(file_get_contents("php://input"));

// fill in users instance properties with decoded values from request
$users->user_id = $data->user_id;
$users->password_hash = password_hash($data->password, PASSWORD_DEFAULT);


if($users->updatePassword()){
    echo json_encode(array("message" => "Password updated."));
}
else{
echo json_encode(array("message" => "Password not updated."));
    }

?>