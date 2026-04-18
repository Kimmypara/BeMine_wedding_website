<?php

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json");
header("Access-Control-Allow-Methods: GET");

header("Access-Control-Allow-Headers: Access-Control-Allow-Origin, Content-Type, Access-Control-Allow-Methods, Authorization, X-Requested-With");

include_once("../../includes/initialize.php");

// creat a new instance of the WeddingPlan class
// This allows us to use its structure and function
$wedding_plan = new WeddingPlan($db);



$result = $wedding_plan->read();
$num = $result->rowCount();

if($num > 0){
    $weddings_list = array();
    $weddings_list['data'] = array();


    while($row = $result->fetch(PDO::FETCH_ASSOC)){
        extract($row);
        $wedding_item = array(
            "wedding_plan_id"    => $wedding_plan_id,
            "user_id"       => $user_id,
            "user_nickname" => $user_nickname,
            "partner_nickname"  => $partner_nickname,
            "wedding_date"  => $wedding_date,
            "guest_count"     => $guest_count,
            "budget"   => $budget
            
        );

        array_push($weddings_list['data'], $wedding_item);
    }

     http_response_code(200);
    echo json_encode($weddings_list);
}
else{
    http_response_code(404);
    echo json_encode(array("message" => "Wedding Plans not found."));
}


?>