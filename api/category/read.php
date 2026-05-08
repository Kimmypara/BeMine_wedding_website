<?php

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json");
header("Access-Control-Allow-Methods: GET");

header("Access-Control-Allow-Headers: Access-Control-Allow-Origin, Content-Type, Access-Control-Allow-Methods, Authorization, X-Requested-With");

include_once("../../includes/initialize.php");

// creat a new instance of the Category class
// This allows us to use its structure and function
$category = new Category($db);

$result = $category->read();
$num = $result->rowCount();

if($num > 0){
    $categories_list = array();
    $categories_list['data'] = array();


    while($row = $result->fetch(PDO::FETCH_ASSOC)){
        extract($row);
        $category_item = array(
            "category_id"    => $category_id,
            "category_name"  => $category_name,
            "slug"  => $slug
            
        );

        array_push($categories_list['data'], $category_item);
    }
     http_response_code(200);
    echo json_encode($categories_list);
}
else{
    http_response_code(404);
    echo json_encode(array("message" => "Category not found."));
}


?>