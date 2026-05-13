<?php

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Allow-Headers: Content-Type");

include_once("../../includes/initialize.php");

$data = json_decode(file_get_contents("php://input"), true);

$wedding_plan_id = $data['wedding_plan_id'] ?? null;
$categories = $data['categories'] ?? [];

if (!$wedding_plan_id) {
    http_response_code(400);
    echo json_encode(["message" => "Missing wedding_plan_id."]);
    exit;
}

/*
REMOVE ONLY UNTICKED CATEGORIES
*/

if (empty($categories)) {
    echo json_encode(["message" => "No categories sent. Nothing deleted."]);
    exit;
}

$query = "DELETE FROM wedding_plan_task
          WHERE wedding_plan_id = :wedding_plan_id
          AND category_id NOT IN (" . implode(',', $categories) . ")";

          
$stmt = $db->prepare($query);
$stmt->bindParam(":wedding_plan_id", $wedding_plan_id);
$stmt->execute();

/*
ADD ONLY NEW CATEGORIES
*/

foreach ($categories as $category_id) {

    // check if already exists
    $checkQuery = "SELECT wedding_plan_task_id
                   FROM wedding_plan_task
                   WHERE wedding_plan_id = :wedding_plan_id
                   AND category_id = :category_id";

    $checkStmt = $db->prepare($checkQuery);

    $checkStmt->bindParam(":wedding_plan_id", $wedding_plan_id);
    $checkStmt->bindParam(":category_id", $category_id);

    $checkStmt->execute();

    // insert only if not exists
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

echo json_encode(["message" => "Selected categories saved."]);
?>