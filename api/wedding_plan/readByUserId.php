<?php

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json");
header("Access-Control-Allow-Methods: GET");

header("Access-Control-Allow-Headers: Access-Control-Allow-Origin, Content-Type, Access-Control-Allow-Methods, Authorization, X-Requested-With");

include_once("../../includes/initialize.php");

// instance of the Wedding Plan class

$wedding_plan = new WeddingPlan($db);


if (empty($_GET["user_id"])) {
    http_response_code(400);
    echo json_encode([
        "exists" => false,
        "message" => "Missing user_id."
    ]);
    exit();
}

$user_id = $_GET["user_id"];

$query = "SELECT wedding_plan_id, user_id, user_nickname, partner_nickname, wedding_date, guest_count, budget
          FROM wedding_plan
          WHERE user_id = ?
          LIMIT 1";

$stmt = $db->prepare($query);
$stmt->bindParam(1, $user_id);
$stmt->execute();

if ($stmt->rowCount() > 0) {

    $plan = $stmt->fetch(PDO::FETCH_ASSOC);

    $catQuery = "SELECT category_id 
                 FROM wedding_plan_category 
                 WHERE wedding_plan_id = ?";

    $catStmt = $db->prepare($catQuery);
    $catStmt->bindParam(1, $plan["wedding_plan_id"]);
    $catStmt->execute();

    $categories = [];

    while ($row = $catStmt->fetch(PDO::FETCH_ASSOC)) {
        $categories[] = (int)$row["category_id"];
    }

    $plan["categories"] = $categories;

    http_response_code(200);
    echo json_encode([
        "exists" => true,
        "data" => $plan
    ]);

} else {
    http_response_code(200);
    echo json_encode([
        "exists" => false,
        "data" => null
    ]);
}


?>














