<?php

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json");
header("Access-Control-Allow-Methods: GET");

header("Access-Control-Allow-Headers: Access-Control-Allow-Origin, Content-Type, Access-Control-Allow-Methods, Authorization, X-Requested-With");

include_once("../../includes/initialize.php");

// creat a new instance of the Tasks class
// This allows us to use its structure and function
$task = new Task($db);

//call new function parameter
$task->task_id  =  isset($_GET["task_id"]) ? $_GET["task_id"]: die();

$result = $task->readSingle();
$num = $result->rowCount();

if($num > 0){
   $task_info = array(
    'task_id'      =>$task->task_id,
    'task_name'       =>$task->task_name,
    'category_id'   =>$task->category_id
   );
   print_r(json_encode($task_info));
}
else{
    echo json_encode(array("message"=>"No tasks found."));
}

?>