<?php

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json");
header("Access-Control-Allow-Methods: GET");

header("Access-Control-Allow-Headers: Access-Control-Allow-Origin, Content-Type, Access-Control-Allow-Methods, Authorization, X-Requested-With");

include_once("../../includes/initialize.php");

// creat a new instance of the task class
// This allows us to use its structure and function
$task = new Task($db);

$result = $task->read();
$num = $result->rowCount();

if($num > 0){
    $tasks_list = array();
    $tasks_list['data'] = array();


    while($row = $result->fetch(PDO::FETCH_ASSOC)){
        extract($row);
        $task_item = array(
            "task_id"    => $task_id,
            "category_id"  => $category_id,
            "task_name" => $task_name
            
        );

        array_push($tasks_list['data'], $task_item);
    }

     http_response_code(200);
    echo json_encode($tasks_list);
}
else{
    http_response_code(404);
    echo json_encode(array("message" => "Tasks not found."));
}

?>