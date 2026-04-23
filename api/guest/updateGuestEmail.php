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
$guest->guest_email = $data->guest_email;


// validate
if (
    

    empty($guest->guest_id) ||
    empty($guest->guest_email) 
){
    http_response_code(400);
    echo json_encode(array("message" => "Guest not created. Missing or invalid input."));
}
elseif(!$guest->GuestIdExists()){
    http_response_code(409);
    echo json_encode(array("message" => "Guest email not updated sine Guest Id does not exists."));
}

elseif($guest->invalidGuestEmail($guest->guest_email)){
    http_response_code(400);
    echo json_encode(array("message" => "Invalid email format."));
}
elseif($guest->guestEmailExists()){
    http_response_code(409);
    echo json_encode(array("message" => "Guest not updated. E-mail already exists."));
}

elseif($guest->updateGuestEmail()){
    http_response_code(200);
    echo json_encode(array("message" => "Guest updated."));
}

else{
    http_response_code(500);
    echo json_encode(array("message" => "Server error."));
}

?>