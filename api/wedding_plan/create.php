<?php

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json");
header("Access-Control-Allow-Methods: POST");

header("Access-Control-Allow-Headers: Access-Control-Allow-Origin, Content-Type, Access-Control-Allow-Methods, Authorization, X-Requested-With");

include_once("../../includes/initialize.php");

// creat a new instance of the WeddingPlan class
// This allows us to use its structure and function
$wedding_plan = new WeddingPlan($db);

$data = json_decode(file_get_contents("php://input"));

// fill in wedding plan instance properties with decoded values from request
$wedding_plan->user_id = $data->user_id;
$wedding_plan->user_nickname = $data->user_nickname;
$wedding_plan->partner_nickname = $data->partner_nickname;
$wedding_plan->wedding_date = $data->wedding_date;
$wedding_plan->guest_count = $data->guest_count;
$wedding_plan->budget = $data->budget;

// validate
if (
    empty($wedding_plan->user_id) ||
    empty($wedding_plan->user_nickname) ||
    empty($wedding_plan->partner_nickname) ||
    empty($wedding_plan->wedding_date) ||
    empty($wedding_plan->guest_count) ||
    empty($wedding_plan->budget)
){
    http_response_code(400);
    echo json_encode(array("message" => "Wedding Plan not created. Missing or invalid input."));
}
elseif($wedding_plan->userIdExists()){
    http_response_code(409);
    echo json_encode(array("message" => "Wedding Plan not created. Wedding Plan already exists."));
}
elseif($wedding_plan->create()){

    if (!empty($data->categories)) {
        foreach ($data->categories as $category_id) {
            $query = "INSERT INTO wedding_plan_category (wedding_plan_id, category_id)
                      VALUES (?, ?)";

            $stmt = $db->prepare($query);
            $stmt->bindParam(1, $wedding_plan->wedding_plan_id);
            $stmt->bindParam(2, $category_id);
            $stmt->execute();
        }
    }
    http_response_code(201);
    echo json_encode(["message" => "Wedding Plan created."]);
}

else{
    http_response_code(500);
    echo json_encode(array("message" => "Server error."));
}



?>