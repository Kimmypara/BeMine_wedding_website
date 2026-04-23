<?php

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json");
header("Access-Control-Allow-Methods: GET");

header("Access-Control-Allow-Headers: Access-Control-Allow-Origin, Content-Type, Access-Control-Allow-Methods, Authorization, X-Requested-With");

include_once("../../includes/initialize.php");

// creat a new instance of the Guest class
// This allows us to use its structure and function
$guest = new Guest($db);



$result = $guest->read();
$num = $result->rowCount();

if($num > 0){
    $guests_list = array();
    $guests_list['data'] = array();


    while($row = $result->fetch(PDO::FETCH_ASSOC)){
        extract($row);
        $guest_item = array(
            "guest_id"    => $guest_id,
            "wedding_plan_id"  => $wedding_plan_id,
            "guest_email" => $guest_email,
            "guest_name"  => $guest_name,
            "guest_surname"  => $guest_surname,
            "rsvp_status"     => $rsvp_status
            
        );

        array_push($guests_list['data'], $guest_item);
    }

     http_response_code(200);
    echo json_encode($guests_list);
}
else{
    http_response_code(404);
    echo json_encode(array("message" => "Guests not found."));
}


?>