<?php

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json");
header("Access-Control-Allow-Methods: GET");

header("Access-Control-Allow-Headers: Access-Control-Allow-Origin, Content-Type, Access-Control-Allow-Methods, Authorization, X-Requested-With");

include_once("../../includes/initialize.php");

// creat a new instance of the Users class
// This allows us to use its structure and function
$users = new Users($db);



$result = $users->read();
$num = $result->rowCount();

if($num > 0){
    $users_list = array();
    $users_list['data'] = array();


    while($row = $result->fetch(PDO::FETCH_ASSOC)){
        extract($row);
        $user_item = array(
            "user_id"    => $user_id,
            "email"       => $email,
            "first_name" => $first_name,
            "last_name"  => $last_name,
            "created_at"  => $created_at,
            "role_id"     => $role_id,
            "is_active"   => $is_active
            
        );

        array_push($users_list['data'], $user_item);
    }

     http_response_code(200);
    echo json_encode($users_list);
}
else{
    http_response_code(404);
    echo json_encode(array("message" => "Users not found."));
}


?>