<?php

//Only for testing
session_start();

$_SESSION['user_id'] = 1;
$_SESSION['role_id'] = 1;
// Only for testing

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json");
header("Access-Control-Allow-Methods: DELETE");

header("Access-Control-Allow-Headers: Access-Control-Allow-Origin, Content-Type, Access-Control-Allow-Methods, Authorization, X-Requested-With");

if($_SERVER["REQUEST_METHOD"] !="DELETE"){
    http_response_code(405);
    echo json_encode(array("message" => "Incorrect Request Method used."));
    die();
}


include_once("../../includes/initialize.php");

define('ROLE_ADMIN', 1);
define('ROLE_COUPLE', 2);
define('ROLE_VENDOR', 3);

function requireAdmin(){
    if(session_status() === PHP_SESSION_NONE){
        session_start();
    }

    if(!isset($_SESSION['user_id']) || !isset($_SESSION['role_id'])){
        http_response_code(401);
        echo json_encode(array("message" => "Unauthorized"));
        exit();
    }

    if((int)$_SESSION['role_id'] !== ROLE_ADMIN){
        http_response_code(403);
        echo json_encode(array("message" => "Access denied. Admin only."));
        exit();
    }
}

requireAdmin();

// creat a new instance of the Vendor class
// This allows us to use its structure and function
$vendor = new Vendor($db);
//read submitted json data from request body
$data = json_decode(file_get_contents("php://input"));


// check if ID is provided in query string
if(empty($_GET["vendor_id"])){
    http_response_code(400);
    echo json_encode(array("message" => "Vendor ID was not provided."));
    exit();
}

$vendor->vendor_id = $_GET["vendor_id"];

if(!$vendor->vendorIdExists()){
    http_response_code(404);
    echo json_encode(array("message" => "Vendor not deleted. Vendor does not exist."));
    exit();
}

if($vendor->delete()){
    http_response_code(200);
    echo json_encode(array("message" => "Vendor deleted."));
}
else{
    http_response_code(500);
    echo json_encode(array("message" => "Server error."));
}

?>