<?php

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Allow-Headers: Content-Type");

include_once("../../includes/initialize.php");

$data = json_decode(file_get_contents("php://input"), true);

$wedding_plan_id = $data['wedding_plan_id'] ?? null;
$categories = $data['categories'] ?? [];

/*
VALIDATION
*/

if (!$wedding_plan_id) {
    http_response_code(400);
    echo json_encode([
        "message" => "Missing wedding_plan_id."
    ]);

    exit;
}

if (!is_array($categories)) {

    http_response_code(400);
    echo json_encode([
        "message" => "Categories must be an array."
    ]);

    exit;
}

/*
CHECK IF WEDDING PLAN EXISTS
*/

$checkWeddingPlan = "SELECT wedding_plan_id
                     FROM wedding_plan
                     WHERE wedding_plan_id = :wedding_plan_id";

$checkStmt = $db->prepare($checkWeddingPlan);

$checkStmt->bindParam(":wedding_plan_id", $wedding_plan_id);

$checkStmt->execute();

if ($checkStmt->rowCount() == 0) {
    http_response_code(404);
    echo json_encode([
        "message" => "Wedding Plan ID not found."
    ]);
    exit;
}
try {

    /*
    REMOVE ONLY UNTICKED CATEGORIES
    */

    if (!empty($categories)) {

        $query = "DELETE FROM wedding_plan_task
                  WHERE wedding_plan_id = :wedding_plan_id
                  AND category_id NOT IN (" . implode(',', $categories) . ")";

        $stmt = $db->prepare($query);

        $stmt->bindParam(":wedding_plan_id", $wedding_plan_id);

        $stmt->execute();
    }

    /*
    ADD ONLY NEW CATEGORIES
    */

    foreach ($categories as $category_id) {

        $checkQuery = "SELECT wedding_plan_task_id
                       FROM wedding_plan_task
                       WHERE wedding_plan_id = :wedding_plan_id
                       AND category_id = :category_id";

        $checkStmt = $db->prepare($checkQuery);

        $checkStmt->bindParam(":wedding_plan_id", $wedding_plan_id);
        $checkStmt->bindParam(":category_id", $category_id);

        $checkStmt->execute();

        if ($checkStmt->rowCount() == 0) {

            $insertQuery = "INSERT INTO wedding_plan_task
                            (wedding_plan_id, category_id, is_selected, is_completed)
                            VALUES (:wedding_plan_id, :category_id, 1, 0)";

            $insertStmt = $db->prepare($insertQuery);

            $insertStmt->bindParam(":wedding_plan_id", $wedding_plan_id);
            $insertStmt->bindParam(":category_id", $category_id);

            $insertStmt->execute();
        }
    }

    http_response_code(200);

    echo json_encode([
        "message" => "Selected categories saved."
    ]);

}
catch(PDOException $e){

    http_response_code(500);

    echo json_encode([
        "message" => "Server error."
    ]);
}

?>