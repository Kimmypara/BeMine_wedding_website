<?php

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json");
header("Access-Control-Allow-Methods: PATCH");

header("Access-Control-Allow-Headers: Access-Control-Allow-Origin, Content-Type, Access-Control-Allow-Methods, Authorization, X-Requested-With");

include_once("../../includes/initialize.php");

// creat a new instance of the WeddingPlan class
// This allows us to use its structure and function
$wedding_plan = new WeddingPlan($db);
//read submitted json data from request body
$data = json_decode(file_get_contents("php://input"));

// fill in users instance properties with decoded values from request
$wedding_plan->wedding_plan_id = $data->wedding_plan_id;
$wedding_plan->user_id = $data->user_id;
$wedding_plan->user_nickname = $data->user_nickname;
$wedding_plan->partner_nickname = $data->partner_nickname;
$wedding_plan->wedding_date = $data->wedding_date;
$wedding_plan->guest_count = $data->guest_count;
$wedding_plan->budget = $data->budget;

// validate
if (  empty($wedding_plan->wedding_plan_id) ||
 empty($wedding_plan->user_id) ||
 empty($wedding_plan->user_nickname) ||
  empty($wedding_plan->partner_nickname) ||
  empty($wedding_plan->wedding_date) ||
  empty($wedding_plan->guest_count) ||
     empty($wedding_plan->budget) 
){
    http_response_code(400);
    echo json_encode(array("message" => "Wedding Plan not updated. Missing or invalid input."));
}
elseif(!$wedding_plan->weddingPlanExists()){
    http_response_code(404);
    echo json_encode(array("message" => "Wedding Plan not found."));
    exit();
}

elseif($wedding_plan->weddingDateInvalid($wedding_plan->wedding_date)){
    http_response_code(400);
    echo json_encode(array("message" => "Invalid wedding date format. Use YYYY-MM-DD."));
}
elseif($wedding_plan->budgetInvalid()){
    http_response_code(400);
    echo json_encode(array("message" => "Invalid Budget format."));
}
elseif($wedding_plan->guestCountInvalid()){
    http_response_code(400);
    echo json_encode(array("message" => "Invalid guest count."));
}

elseif($wedding_plan->update()){

    // delete old selected categories
    $deleteQuery = "DELETE FROM wedding_plan_category WHERE wedding_plan_id = ?";
    $deleteStmt = $db->prepare($deleteQuery);
    $deleteStmt->bindParam(1, $wedding_plan->wedding_plan_id);
    $deleteStmt->execute();

    // insert new selected categories
    if (!empty($data->categories)) {

        foreach ($data->categories as $category_id) {

            $query = "INSERT INTO wedding_plan_category 
                      (wedding_plan_id, category_id)
                      VALUES (?, ?)";

            $stmt = $db->prepare($query);
            $stmt->bindParam(1, $wedding_plan->wedding_plan_id);
            $stmt->bindParam(2, $category_id);
            $stmt->execute();
        }
    }

    http_response_code(200);
    echo json_encode(array("message" => "Wedding Plan updated."));
}
else{
    http_response_code(500);
    echo json_encode(array("message" => "Server error."));
}


?>