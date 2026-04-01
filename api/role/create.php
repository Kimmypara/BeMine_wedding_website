<?php

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json");
header("Access-Control-Allow-Methods: POST");

header("Access-Control-Allow-Headers: Access-Control-Allow-Origin, Content-Type, Access-Control-Allow-Methods, Authorization, X-Requested-With");

include_once("../../includes/initialize.php");

// creat a new instance of the Role class
// This allows us to use its structure and function
$role = new Role($db);

$data = json_decode(file_get_contents("php://input"));

// fill in role instance properties with decoded values from request
$role->role_name = $data->role_name;


if($role->create()){
    echo json_encode(array("message" => "Role created."));
}
else{
echo json_encode(array("message" => "Role not created."));
    }

?>