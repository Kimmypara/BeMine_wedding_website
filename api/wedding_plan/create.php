<?php

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json");
header("Access-Control-Allow-Methods: POST");

header("Access-Control-Allow-Headers: Access-Control-Allow-Origin, Content-Type, Access-Control-Allow-Methods, Authorization, X-Requested-With");

include_once("../../includes/initialize.php");

// creat a new instance of the WeddingPlan class
// This allows us to use its structure and function
$wedding_plan = new WeddingPlan($db);

$data = json_decode(file_get_contents("php://input"));

// fill in wedding plan instance properties with decoded values from request
$wedding_plan->user_id = $data->user_id;
$wedding_plan->user_nickname = $data->user_nickname;
$wedding_plan->partner_nickname = $data->partner_nickname;
$wedding_plan->wedding_date = $data->wedding_date;
$wedding_plan->guest_count = $data->guest_count;
$wedding_plan->budget = $data->budget;

if($wedding_plan->create()){
    echo json_encode(array("message" => "Wedding Plan created."));
}
else{
echo json_encode(array("message" => "Wedding Plan not created."));
    }

?>