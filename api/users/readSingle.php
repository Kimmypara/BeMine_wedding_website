<?php

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json");
header("Access-Control-Allow-Methods: GET");

header("Access-Control-Allow-Headers: Access-Control-Allow-Origin, Content-Type, Access-Control-Allow-Methods, Authorization, X-Requested-With");

include_once("../../includes/initialize.php");


// creat a new instance of the Users class
// This allows us to use its structure and function
$users = new Users($db);

// validate user_id from query string
if(empty($_GET["user_id"])){
    http_response_code(400);
    echo json_encode(array("message" => "Missing user_id."));
    exit();
}

//call new function parameter
$users->user_id =  isset($_GET["user_id"]) ? $_GET["user_id"]: die();

$result = $users->readSingle();
$num = $result->rowCount();

if($num > 0){
   $user_info = array(
    'user_id'      =>$users->user_id,
    'email'        =>$users->email,
    'first_name'   =>$users->first_name,
    'last_name'    =>$users->last_name,
    'created_at'    =>$users->created_at,
    'role_id'       =>$users->role_id,
    'is_active'     =>$users->is_active
   );
    http_response_code(200);
    echo json_encode($user_info);
}
else{
    http_response_code(404);
    echo json_encode(array("message" => "User not found."));
}


?>