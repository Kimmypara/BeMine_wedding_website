<?php

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json");
header("Access-Control-Allow-Methods: GET");

header("Access-Control-Allow-Headers: Access-Control-Allow-Origin, Content-Type, Access-Control-Allow-Methods, Authorization, X-Requested-With");

include_once("../../includes/initialize.php");

// creat a new instance of the Role class
// This allows us to use its structure and function
$role = new Role($db);

//call new function parameter
$role->role_id =  isset($_GET["role_id"]) ? $_GET["role_id"]: die();

$result = $role->readSingle();
$num = $result->rowCount();

if($num > 0){
   $role_info = array(
    'role_id'      =>$role->role_id,
    'role_name'       =>$role->role_name
   );
   print_r(json_encode($role_info));
}
else{
    echo json_encode(array("message"=>"No roles found."));
}

?>