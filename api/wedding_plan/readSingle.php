<?php

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json");
header("Access-Control-Allow-Methods: GET");

header("Access-Control-Allow-Headers: Access-Control-Allow-Origin, Content-Type, Access-Control-Allow-Methods, Authorization, X-Requested-With");

include_once("../../includes/initialize.php");


// creat a new instance of the WeddingPlan class
// This allows us to use its structure and function
$wedding_plan = new WeddingPlan($db);

// validate wedding_plan_id from query string
if(empty($_GET["wedding_plan_id"])){
    http_response_code(400);
    echo json_encode(array("message" => "Missing wedding_plan_id."));
    exit();
}

//call new function parameter
$wedding_plan->wedding_plan_id =  isset($_GET["wedding_plan_id"]) ? $_GET["wedding_plan_id"]: die();

$result = $wedding_plan->readSingle();
$num = $result->rowCount();

if($num > 0){
   $wedding_plan_info = array(
    'wedding_plan_id'      =>$wedding_plan->wedding_plan_id,
    'user_id'        =>$wedding_plan->user_id,
    'user_nickname'   =>$wedding_plan->user_nickname,
    'partner_nickname'    =>$wedding_plan->partner_nickname,
    'wedding_date'    =>$wedding_plan->wedding_date,
    'guest_count'       =>$wedding_plan->guest_count,
    'budget'     =>$wedding_plan->budget
   );
    http_response_code(200);
    echo json_encode($wedding_plan_info);
}
else{
    http_response_code(404);
    echo json_encode(array("message" => "User not found."));
}


?>