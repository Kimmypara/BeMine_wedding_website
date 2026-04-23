<?php

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json");
header("Access-Control-Allow-Methods: PATCH");

header("Access-Control-Allow-Headers: Access-Control-Allow-Origin, Content-Type, Access-Control-Allow-Methods, Authorization, X-Requested-With");

include_once("../../includes/initialize.php");

// creat a new instance of the Guest class
// This allows us to use its structure and function
$guest = new Guest($db);
//read submitted json data from request body
$data = json_decode(file_get_contents("php://input"));

// fill in guest instance properties with decoded values from request
$guest->guest_id = $data->guest_id;
$guest->rsvp_status = $data->rsvp_status;

// validate
if (
    empty($guest->guest_id) ||
    empty($guest->rsvp_status) 
){
    http_response_code(400);
    echo json_encode(array("message" => "RSVP not updated. Missing or invalid input."));
}
elseif(!$guest->GuestIdExists()){
    http_response_code(400);
    echo json_encode(array("message" => "Invalid Guest Id. Guest does not exist."));
}
elseif($guest->rsvpStatusInvalid()){
    http_response_code(400);
    echo json_encode(["message" => "Invalid RSVP status. Use pending, accepted, or declined."]);
}
elseif($guest->rsvpStatusSame()){
    http_response_code(409);
    echo json_encode(array("message" => "RSVP not updated. This status is already set."));
    exit();
}
elseif($guest->updateRSVPStatus()){
    http_response_code(200);
    echo json_encode(array("message" => "RSVP updated."));
}

else{
    http_response_code(500);
    echo json_encode(array("message" => "Server error."));
}

?>