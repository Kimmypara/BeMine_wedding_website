<?php

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json");
header("Access-Control-Allow-Methods: GET");

header("Access-Control-Allow-Headers: Access-Control-Allow-Origin, Content-Type, Access-Control-Allow-Methods, Authorization, X-Requested-With");

include_once("../../includes/initialize.php");

$vendor = new Vendor($db);

$result = $vendor->read();
$num = $result->rowCount();

if($num > 0){

    $vendors = [];

    while($row = $result->fetch(PDO::FETCH_ASSOC)){

        $vendor_id = $row["vendor_id"];

        if(!isset($vendors[$vendor_id])){

            $vendors[$vendor_id] = [
                "vendor_id"   => $row["vendor_id"],
                "vendor_name" => $row["vendor_name"],
                "category_id" => $row["category_id"],
                "user_id"     => $row["user_id"],
                "locations"     => $row["locations"],
                "basic_info"     => $row["basic_info"],
                "min_price"     => $row["min_price"],
                "images"      => []
            ];
        }

        if(!empty($row["image_path"])){
            $vendors[$vendor_id]["images"][] = $row["image_path"];
        }
    }

    http_response_code(200);
    echo json_encode([
        "data" => array_values($vendors)
    ]);
}
else{
    http_response_code(404);
    echo json_encode([
        "message" => "Vendors not found."
    ]);
}
?>