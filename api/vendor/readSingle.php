<?php

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json");
header("Access-Control-Allow-Methods: GET");

header("Access-Control-Allow-Headers: Access-Control-Allow-Origin, Content-Type, Access-Control-Allow-Methods, Authorization, X-Requested-With");

include_once("../../includes/initialize.php");


// creat a new instance of the Vendors class
// This allows us to use its structure and function
$vendor = new Vendor($db);

// validate vendor_id from query string
if(empty($_GET["vendor_id"])){
    http_response_code(400);
    echo json_encode(array("message" => "Missing vendor Id."));
    exit();
}

//call new function parameter
$vendor->vendor_id =  isset($_GET["vendor_id"]) ? $_GET["vendor_id"]: die();

$result = $vendor->readSingle();
$num = $result->rowCount();

if($num > 0){
 $imageQuery = "SELECT image_path 
                   FROM vendor_image 
                   WHERE vendor_id = ?";

    $imageStmt = $db->prepare($imageQuery);
    $imageStmt->bindParam(1, $vendor->vendor_id);
    $imageStmt->execute();

    $images = [];

    while($row = $imageStmt->fetch(PDO::FETCH_ASSOC)){
        $images[] = $row["image_path"];
    }

   $vendor_info = array(
    'vendor_id'      =>$vendor->vendor_id,
    'vendor_name'        =>$vendor->vendor_name,
    'category_id'   =>$vendor->category_id,
    'user_id'    =>$vendor->user_id,
    'locations'    =>$vendor->locations,
    'basic_info'    =>$vendor->basic_info,
    'min_price'    =>$vendor->min_price,
    "images"      => $images
   );

    http_response_code(200);
    echo json_encode($vendor_info);
}
else{
    http_response_code(404);
    echo json_encode(array("message" => "User not found."));
}


?>