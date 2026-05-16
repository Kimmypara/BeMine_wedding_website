<?php

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json");
header("Access-Control-Allow-Methods: GET");

header("Access-Control-Allow-Headers: Access-Control-Allow-Origin, Content-Type, Access-Control-Allow-Methods, Authorization, X-Requested-With");

include_once("../../includes/initialize.php");


// creat a new instance of the Guest class
// This allows us to use its structure and function
$guest = new Guest($db);

// validate guest_id from query string
if(empty($_GET["guest_id"])){
    http_response_code(400);
    echo json_encode(array("message" => "Missing Guest Id."));
    exit();
}

//call new function parameter
$guest->guest_id =  isset($_GET["guest_id"]) ? $_GET["guest_id"]: die();

$result = $guest->readSingle();
$num = $result->rowCount();

if($num > 0){
   $guest_info = array(
    'guest_id'      =>$guest->guest_id,
    'wedding_plan_id'        =>$guest->wedding_plan_id,
    'guest_email'   =>$guest->guest_email,
    'guest_name'    =>$guest->guest_name,
    'guest_surname'    =>$guest->guest_surname,
    'rsvp_status'       =>$guest->rsvp_status,
    'guest_category'       =>$guest->guest_category
   );
    http_response_code(200);
    echo json_encode($guest_info);
}
else{
    http_response_code(404);
    echo json_encode(array("message" => "Guest not found."));
}


?>