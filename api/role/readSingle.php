<?php

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json");
header("Access-Control-Allow-Methods: GET");

header("Access-Control-Allow-Headers: Access-Control-Allow-Origin, Content-Type, Access-Control-Allow-Methods, Authorization, X-Requested-With");

include_once("../../includes/initialize.php");

// creat a new instance of the Role class
// This allows us to use its structure and function
$role = new Role($db);

// validate role_id from query string
if(empty($_GET["role_id"])){
    http_response_code(400);
    echo json_encode(array("message" => "Missing role_id."));
    exit();
}

//call new function parameter
$role->role_id =  isset($_GET["role_id"]) ? $_GET["role_id"]: die();

$result = $role->readSingle();


if($result){
    $num = $result->rowCount();

    if($num > 0){
        $role_info = array(
            "role_id" => $role->role_id,
            "role_name" => $role->role_name
        );

        http_response_code(200);
        echo json_encode($role_info);
    }
    else{
        http_response_code(404);
        echo json_encode(array("message" => "No roles found."));
    }
}
else{
    http_response_code(500);
    echo json_encode(array("message" => "Server error."));
}

?>