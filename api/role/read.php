<?php

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json");
header("Access-Control-Allow-Methods: GET");

header("Access-Control-Allow-Headers: Access-Control-Allow-Origin, Content-Type, Access-Control-Allow-Methods, Authorization, X-Requested-With");

include_once("../../includes/initialize.php");

// creat a new instance of the Role class
// This allows us to use its structure and function
$role = new Role($db);

$result = $role->read();
$num = $result->rowCount();

if($num > 0){
    $roles_list = array();
    $roles_list['data'] = array();


    while($row = $result->fetch(PDO::FETCH_ASSOC)){
        extract($row);
        $role_item = array(
            "role_id"    => $role_id,
            "role_name"  => $role_name
            
        );

        array_push($roles_list['data'], $role_item);
    }
     http_response_code(200);
    echo json_encode($roles_list);
}
else{
    http_response_code(404);
    echo json_encode(array("message" => "Roles not found."));
}


?>