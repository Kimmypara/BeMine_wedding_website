<?php

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json");
header("Access-Control-Allow-Methods: GET");
header("Access-Control-Allow-Headers: Content-Type");

include_once("../../includes/initialize.php");

$wedding_plan_id = isset($_GET['wedding_plan_id']) ? (int)$_GET['wedding_plan_id'] : 0;

if ($wedding_plan_id <= 0) {
    http_response_code(400);
    echo json_encode(["message" => "Missing wedding_plan_id."]);
    exit;
}

$query = "SELECT 
            wpt.wedding_plan_task_id,
            wpt.wedding_plan_id,
            wpt.category_id,
            wpt.is_selected,
            wpt.is_completed,
            wpt.completed_at,
            c.category_name
          FROM wedding_plan_task wpt
          LEFT JOIN category c 
          ON wpt.category_id = c.category_id
          WHERE wpt.wedding_plan_id = :wedding_plan_id
          AND wpt.is_selected = 1
          ORDER BY c.category_name ASC";

$stmt = $db->prepare($query);
$stmt->bindParam(":wedding_plan_id", $wedding_plan_id);
$stmt->execute();

if ($stmt->rowCount() > 0) {

    $tasks = [];
    $tasks["data"] = [];

    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        $tasks["data"][] = $row;
    }

    echo json_encode($tasks);

} else {
    echo json_encode([
        "message" => "No tasks found.",
        "data" => []
    ]);
}

?>