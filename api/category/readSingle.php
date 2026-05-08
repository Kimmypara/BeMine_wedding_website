<?php

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json");
header("Access-Control-Allow-Methods: GET");

header("Access-Control-Allow-Headers: Access-Control-Allow-Origin, Content-Type, Access-Control-Allow-Methods, Authorization, X-Requested-With");

include_once("../../includes/initialize.php");

// creat a new instance of the Category class
// This allows us to use its structure and function
$category = new Category($db);

// validate role_id from query string
if(empty($_GET["category_id"])){
    http_response_code(400);
    echo json_encode(array("message" => "Missing category_id."));
    exit();
}

//call new function parameter
$category->category_id =  isset($_GET["category_id"]) ? $_GET["category_id"]: die();

$result = $category->readSingle();


if($result){
    $num = $result->rowCount();

    if($num > 0){
        $category_info = array(
            "category_id" => $category->category_id,
            "category_name" => $category->category_name,
            "slug" => $category->slug
        );

        http_response_code(200);
        echo json_encode($category_info);
    }
    else{
        http_response_code(404);
        echo json_encode(array("message" => "No categories found."));
    }
}
else{
    http_response_code(500);
    echo json_encode(array("message" => "Server error."));
}

?>