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
$wedding_plan_task->wedding_plan_task_id = $data->wedding_plan_task_id;
$wedding_plan_task->wedding_plan_id = $data->wedding_plan_id;
$wedding_plan_task->task_id = $data->task_id;
$wedding_plan_task->is_selected = $data->is_selected;
$wedding_plan_task->is_completed = $data->is_completed;

if($wedding_plan_task->create()){
    echo json_encode(array("message" => "Wedding Plan Task created."));
}
else{
echo json_encode(array("message" => "Wedding Plan Task not created."));
    }

?>