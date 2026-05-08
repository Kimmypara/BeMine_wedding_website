<?php

//Only for testing
session_start();

$_SESSION['user_id'] = 1;
$_SESSION['role_id'] = 1;
// Only for testing



header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json");
header("Access-Control-Allow-Methods: PATCH");

header("Access-Control-Allow-Headers: Access-Control-Allow-Origin, Content-Type, Access-Control-Allow-Methods, Authorization, X-Requested-With");

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

// create a new instance of the Vendor class
// This allows us to use its structure and function
$vendor = new Vendor($db);
//read submitted json data from request body
$data = json_decode(file_get_contents("php://input"));

if ($data === null) {
    http_response_code(400);
    echo json_encode(["message" => "Invalid or missing JSON body."]);
    exit();
}

// fill in user instance properties with decoded values from request
$vendor->vendor_id = $data->vendor_id;
$vendor->vendor_name = $data->vendor_name;
$vendor->category_id = $data->category_id;
$vendor->locations = $data->locations;
$vendor->basic_info = $data->basic_info;
$vendor->min_price = $data->min_price;

 // validate
if (empty($vendor->vendor_id) ||
      empty($vendor->vendor_name) ||
    empty($vendor->category_id) ||
    empty($vendor->locations) ||
    empty($vendor->basic_info) ||
    empty($vendor->min_price) 
){
    http_response_code(400);
    echo json_encode(array("message" => "Vendor not updated. Missing or invalid input."));
}

elseif($vendor->vendorNameExists()){
    http_response_code(409);
    echo json_encode(array("message" => "Vendor not updated. Vendor already exists."));
}

elseif($vendor->update()){

    $deleteQuery = "DELETE FROM vendor_image WHERE vendor_id = ?";
    $deleteStmt = $db->prepare($deleteQuery);
    $deleteStmt->bindParam(1, $vendor->vendor_id);
    $deleteStmt->execute();

    if (!empty($data->images)) {
        foreach ($data->images as $image_path) {
            $query = "INSERT INTO vendor_image (vendor_id, image_path)
                      VALUES (?, ?)";

            $stmt = $db->prepare($query);
            $stmt->bindParam(1, $vendor->vendor_id);
            $stmt->bindParam(2, $image_path);
            $stmt->execute();
        }
    }

    http_response_code(200);
    echo json_encode(["message" => "Vendor updated."]);
}
else{
    http_response_code(500);
    echo json_encode(array("message" => "Server error."));
}

?>
