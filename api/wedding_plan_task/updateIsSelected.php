<?php

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json");
header("Access-Control-Allow-Methods: PATCH");

header("Access-Control-Allow-Headers: Access-Control-Allow-Origin, Content-Type, Access-Control-Allow-Methods, Authorization, X-Requested-With");

include_once("../../includes/initialize.php");

// creat a new instance of the WeddingPlanTask class
// This allows us to use its structure and function
$wedding_plan_task = new WeddingPlanTask($db);

//read submitted json data from request body
$data = json_decode(file_get_contents("php://input"));


// fill in wedding_plan_task instance properties with decoded values from request
$wedding_plan_task->wedding_plan_task_id = $data->wedding_plan_task_id;
$wedding_plan_task->is_selected = $data->is_selected;


// validate
if (
    empty($wedding_plan_task->wedding_plan_task_id) ||
    !isset($wedding_plan_task->is_selected) 
){
    http_response_code(400);
    echo json_encode(array("message" => "Wedding Plan Task not updated. Missing or invalid input."));
}

elseif(!$wedding_plan_task->weddingPlanTaskIdExists()){
    http_response_code(404);
    echo json_encode(array("message" => "Wedding Plan Task Id not found."));
    exit();
}
elseif($wedding_plan_task->isSelectedInvalid()){
    http_response_code(400);
    echo json_encode(array("message" => "Invalid Is Selected value. Use 0 or 1 only."));
}

elseif($wedding_plan_task->updateIsSelected()){
    http_response_code(200);
    echo json_encode(array("message" => "Wedding Plan Task updated."));
}
else{
    http_response_code(500);
    echo json_encode(array("message" => "Server error."));
}

?>