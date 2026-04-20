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
$wedding_plan_task->wedding_plan_id = $data->wedding_plan_id;
$wedding_plan_task->task_id = $data->task_id;
$wedding_plan_task->is_selected = $data->is_selected;
$wedding_plan_task->is_completed = $data->is_completed;
$wedding_plan_task->category_id = $data->category_id;

// validate
if (
    empty($wedding_plan_task->wedding_plan_task_id) ||
    empty($wedding_plan_task->wedding_plan_id) ||
    empty($wedding_plan_task->task_id) ||
    !isset($data->is_selected) ||
    !isset($data->is_completed) ||
    empty($wedding_plan_task->category_id)
){
    http_response_code(400);
    echo json_encode(array("message" => "Wedding Plan Task not updated. Missing or invalid input."));
}
elseif(!$wedding_plan_task->weddingPlanTaskIdExists()){
    http_response_code(404);
    echo json_encode(array("message" => "Wedding Plan Task not found."));
    exit();
}
elseif(!$wedding_plan_task->WeddingPlanIdExists()){
    http_response_code(404);
    echo json_encode(array("message" => "Wedding Plan Id not found."));
    exit();
}
elseif(!$wedding_plan_task->taskIdExists()){
    http_response_code(404);
    echo json_encode(array("message" => "Task Id not found."));
    exit();
}
elseif(!$wedding_plan_task->categoryIdExists()){
    http_response_code(404);
    echo json_encode(array("message" => "Category Id not found."));
    exit();
}
elseif($wedding_plan_task->update()){
    http_response_code(200);
    echo json_encode(array("message" => "Wedding Plan Task updated."));
}
else{
    http_response_code(500);
    echo json_encode(array("message" => "Server error."));
}

?>