<?php

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json");
header("Access-Control-Allow-Methods: POST");

header("Access-Control-Allow-Headers: Access-Control-Allow-Origin, Content-Type, Access-Control-Allow-Methods, Authorization, X-Requested-With");

include_once("../../includes/initialize.php");

// creat a new instance of the WeddingPlanTask class
// This allows us to use its structure and function
$wedding_plan_task = new WeddingPlanTask($db);

$data = json_decode(file_get_contents("php://input"));

// fill in wedding plan task instance properties with decoded values from request

$wedding_plan_task->wedding_plan_id = $data->wedding_plan_id;
$wedding_plan_task->task_id = $data->task_id;
$wedding_plan_task->is_selected = $data->is_selected;
$wedding_plan_task->is_completed = $data->is_completed;
$wedding_plan_task->category_id = $data->category_id;

if (
    empty($wedding_plan_task->wedding_plan_id) ||
    empty($wedding_plan_task->task_id) ||
    empty($wedding_plan_task->category_id) ||
    !isset($data->is_selected) ||
    !isset($data->is_completed)
){
    http_response_code(400);
    echo json_encode(array("message" => "Missing or invalid input."));
}
elseif(!$wedding_plan_task->WeddingPlanIdExists()){
    http_response_code(404);
    echo json_encode(array("message" => "Wedding Plan Id not found."));
}
elseif(!$wedding_plan_task->categoryIdExists()){
    http_response_code(404);
    echo json_encode(array("message" => "Category Id not found."));
}
elseif(!$wedding_plan_task->taskIdExists()){
    http_response_code(404);
    echo json_encode(array("message" => "Task not found."));
}
elseif($wedding_plan_task->weddingPlanTaskExists()){
    http_response_code(409);
    echo json_encode(array(
        "message" => "This task already exists for this category in the wedding plan."
    ));
}
elseif($wedding_plan_task->create()){
    http_response_code(201);
    echo json_encode(array("message" => "Wedding Plan Task created."));
}
else{
    http_response_code(500);
    echo json_encode(array("message" => "Server error."));
}


?>