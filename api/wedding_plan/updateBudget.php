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
$wedding_plan->budget = $data->budget;

if (  empty($wedding_plan->wedding_plan_id) ||
     empty($wedding_plan->budget) 
){
    http_response_code(400);
    echo json_encode(array("message" => "Wedding Plan not updated. Missing or invalid input."));
}
elseif(!$wedding_plan->weddingPlanExists()){
    http_response_code(404);
    echo json_encode(array("message" => "Wedding plan Id does not exist."));
}
elseif($wedding_plan->budgetInvalid()){
    http_response_code(400);
    echo json_encode(array("message" => "Invalid Budget format."));
}

elseif($wedding_plan->updateBudget()){
    http_response_code(200);
    echo json_encode(array("message" => "Budget from Wedding Plan updated."));
}
else{
    http_response_code(500);
    echo json_encode(array("message" => "Server error."));
}


?>