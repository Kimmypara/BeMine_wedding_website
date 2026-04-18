<?php

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json");
header("Access-Control-Allow-Methods: PATCH");

header("Access-Control-Allow-Headers: Access-Control-Allow-Origin, Content-Type, Access-Control-Allow-Methods, Authorization, X-Requested-With");

include_once("../../includes/initialize.php");

// creat a new instance of the WeddingPlan class
// This allows us to use its structure and function
$wedding_plan = new WeddingPlan($db);
//read submitted json data from request body
$data = json_decode(file_get_contents("php://input"));

// fill in users instance properties with decoded values from request
$wedding_plan->wedding_plan_id = $data->wedding_plan_id;
$wedding_plan->user_id = $data->user_id;
$wedding_plan->user_nickname = $data->user_nickname;
$wedding_plan->partner_nickname = $data->partner_nickname;
$wedding_plan->wedding_date = $data->wedding_date;
$wedding_plan->guest_count = $data->guest_count;
$wedding_plan->budget = $data->budget;

// validate
if(!$wedding_plan->weddingPlanExists()){
    http_response_code(404);
    echo json_encode(array("message" => "Wedding Plan not found."));
    exit();
}

if($wedding_plan->update()){
    http_response_code(200);
    echo json_encode(array("message" => "Wedding Plan updated."));
}
else{
    http_response_code(500);
    echo json_encode(array("message" => "Server error."));
}


?>