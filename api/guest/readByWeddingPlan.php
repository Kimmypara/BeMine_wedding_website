<?php

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json");
header("Access-Control-Allow-Methods: GET");

include_once("../../includes/initialize.php");

$guest = new Guest($db);

// validate input
if(empty($_GET["wedding_plan_id"])){
    http_response_code(400);
    echo json_encode(array("message" => "Missing wedding_plan_id."));
    exit();
}

$guest->wedding_plan_id = $_GET["wedding_plan_id"];

$result = $guest->readByWeddingPlan();
$num = $result->rowCount();

if($num > 0){

    $guests_arr = array();

    while($row = $result->fetch(PDO::FETCH_ASSOC)){
        extract($row);

        $guest_item = array(
            "guest_id" => $guest_id,
            "guest_name" => $guest_name,
            "guest_surname" => $guest_surname,
            "guest_email" => $guest_email,
            "rsvp_status" => $rsvp_status.
            "guest_category" => $guest_category
        );

        array_push($guests_arr, $guest_item);
    }

    http_response_code(200);
    echo json_encode($guests_arr);
}
else{
    http_response_code(404);
    echo json_encode(array("message" => "No guests found."));
}

?>