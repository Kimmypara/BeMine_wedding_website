<?php

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json");
header("Access-Control-Allow-Methods: GET");

header("Access-Control-Allow-Headers: Access-Control-Allow-Origin, Content-Type, Access-Control-Allow-Methods, Authorization, X-Requested-With");

include_once("../../includes/initialize.php");

$wedding_plan_task = new WeddingPlanTask($db);

if(empty($_GET["wedding_plan_task_id"])){
    http_response_code(400);
    echo json_encode(array("message" => "Missing Wedding Plan Task Id."));
    exit();
}

$wedding_plan_task->wedding_plan_task_id = $_GET["wedding_plan_task_id"];

$result = $wedding_plan_task->readSingle();
$num = $result->rowCount();

if($num > 0){

    $wedding_plan_task_info = array(
        "wedding_plan_task_id" => $wedding_plan_task->wedding_plan_task_id,
        "wedding_plan_id" => $wedding_plan_task->wedding_plan_id,
        "task_id" => $wedding_plan_task->task_id,
        "is_selected" => $wedding_plan_task->is_selected,
        "is_completed" => $wedding_plan_task->is_completed,
        "category_id" => $wedding_plan_task->category_id
    );

    http_response_code(200);
    echo json_encode($wedding_plan_task_info);
}
else{
    http_response_code(404);
    echo json_encode(array("message" => "Wedding Plan Task not found."));
}

?>