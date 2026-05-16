<?php


header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json");
header("Access-Control-Allow-Methods: POST");

header("Access-Control-Allow-Headers: Access-Control-Allow-Origin, Content-Type, Access-Control-Allow-Methods, Authorization, X-Requested-With");

include_once("../../includes/initialize.php");


// creat a new instance of the Guest class
// This allows us to use its structure and function
$guest = new Guest($db);

$data = json_decode(file_get_contents("php://input"));

// fill in guest instance properties with decoded values from request

$guest->wedding_plan_id = $data->wedding_plan_id;
$guest->guest_email = $data->guest_email;
$guest->guest_name = $data->guest_name;
$guest->guest_surname = $data->guest_surname;
$guest->rsvp_status = $data->rsvp_status;
$guest->guest_category = $data->guest_category;



    // validate
if (
    
    empty($guest->wedding_plan_id) ||
    empty($guest->guest_email) ||
    empty($guest->guest_name) ||
    empty($guest->guest_surname) ||
    empty($guest->rsvp_status) ||
    empty($guest->guest_category) 
){
    http_response_code(400);
    echo json_encode(array("message" => "Guest not created. Missing or invalid input."));
}
elseif(!$guest->weddingPlanIdExists()){
    http_response_code(400);
    echo json_encode(array("message" => "Invalid Wedding Plan Id. Wedding Plan does not exist."));
}

elseif($guest->invalidGuestEmail($guest->guest_email)){
    http_response_code(400);
    echo json_encode(array("message" => "Invalid email format."));
}
elseif($guest->guestEmailExists()){
    http_response_code(409);
    echo json_encode(array("message" => "Guest not created. E-mail already exists."));
}
elseif($guest->guestNameInvalid()){
    http_response_code(400);
    echo json_encode(["message" => "Invalid guest name."]);
}

elseif($guest->guestSurnameInvalid()){
    http_response_code(400);
    echo json_encode(["message" => "Invalid guest surname."]);
}
elseif($guest->rsvpStatusInvalid()){
    http_response_code(400);
    echo json_encode(["message" => "Invalid RSVP status. Use pending, accepted, or declined."]);
}
elseif($guest->create()){
    http_response_code(201);
    echo json_encode(array("message" => "Guest created."));
}

else{
    http_response_code(500);
    echo json_encode(array("message" => "Server error."));
}

?>