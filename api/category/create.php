<?php

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json");
header("Access-Control-Allow-Methods: POST");

header("Access-Control-Allow-Headers: Access-Control-Allow-Origin, Content-Type, Access-Control-Allow-Methods, Authorization, X-Requested-With");

include_once("../../includes/initialize.php");

// creat a new instance of the Category class
// This allows us to use its structure and function
$category = new Category($db);

$data = json_decode(file_get_contents("php://input"));

// fill in Category instance properties with decoded values from request
$category->category_name = $data->category_name;

// validate
if (
    empty($category->category_name) 
){
    http_response_code(400);
    echo json_encode(array("message" => "Category not created. Missing or invalid input."));
}
elseif($category->categoryNameExists()){
    http_response_code(409);
    echo json_encode(array("message" => "Category not created. Category already exists."));
}
elseif($category->create()){
    http_response_code(201);
    echo json_encode(array("message" => "Category created."));
}

else{
    http_response_code(500);
    echo json_encode(array("message" => "Server error."));
}



?>