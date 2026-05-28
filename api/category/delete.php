<?php

// Only for testing
session_start();

$_SESSION['user_id'] = 1;
$_SESSION['role_id'] = 1;
// Only for testing

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json");
header("Access-Control-Allow-Methods: DELETE");
header("Access-Control-Allow-Headers: Access-Control-Allow-Origin, Content-Type, Access-Control-Allow-Methods, Authorization, X-Requested-With");

if($_SERVER["REQUEST_METHOD"] != "DELETE"){
    http_response_code(405);
    echo json_encode(array("message" => "Incorrect Request Method used."));
    exit();
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

$category = new Category($db);

if(empty($_GET["category_id"])){
    http_response_code(400);
    echo json_encode(array("message" => "Category ID was not provided."));
    exit();
}

$category->category_id = $_GET["category_id"];

if(!$category->categoryIdExists()){
    http_response_code(404);
    echo json_encode(array("message" => "Category not deleted. Category does not exist."));
    exit();
}

try{

    if($category->delete()){
        http_response_code(200);
        echo json_encode(array("message" => "Category deleted."));
    }
    else{
        http_response_code(500);
        echo json_encode(array("message" => "Server error."));
    }

}
catch(PDOException $e){

    http_response_code(409);
    echo json_encode(array(
        "message" => "Category cannot be deleted because it is linked to existing wedding plans."
    ));
}

?>