<?php

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json");
header("Access-Control-Allow-Methods: GET");

header("Access-Control-Allow-Headers: Access-Control-Allow-Origin, Content-Type, Access-Control-Allow-Methods, Authorization, X-Requested-With");

include_once("../../includes/initialize.php");

// creat a new instance of the WeddingPlanTask class
// This allows us to use its structure and function
$wedding_plan_task = new WeddingPlanTask($db);



$result = $wedding_plan_task->read();
$num = $result->rowCount();

if($num > 0){
    $wedding_plan_tasks_list = array();
    $wedding_plan_tasks_list['data'] = array();


    while($row = $result->fetch(PDO::FETCH_ASSOC)){
        extract($row);
        $wedding_plan_task_item = array(
            "wedding_plan_task_id"    => $wedding_plan_task_id,
            "wedding_plan_id"       => $wedding_plan_id,
            "task_id" => $task_id,
            "is_selected"  => $is_selected,
            "is_completed"  => $is_completed,
            "category_id"     => $category_id
            
        );

        array_push($wedding_plan_tasks_list['data'], $wedding_plan_task_item);
    }

     http_response_code(200);
    echo json_encode($wedding_plan_tasks_list);
}
else{
    http_response_code(404);
    echo json_encode(array("message" => "Wedding plan task not found."));
}


?>