<?php

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Allow-Headers: Content-Type, Authorization, X-Requested-With");

include_once("../../includes/initialize.php");

$data = json_decode(file_get_contents("php://input"));

$email = $data->email ?? "";
$password = $data->password ?? "";

if (empty($email) || empty($password)) {
    http_response_code(400);
    echo json_encode(["message" => "Email and password are required."]);
    exit;
}

$query = "SELECT user_id, first_name, last_name, email, password_hash, role_id, is_active
          FROM users
          WHERE email = ?
          LIMIT 1";

$stmt = $db->prepare($query);
$stmt->bindParam(1, $email);
$stmt->execute();

if ($stmt->rowCount() === 0) {
    http_response_code(401);
    echo json_encode(["message" => "Invalid email or password."]);
    exit;
}

$user = $stmt->fetch(PDO::FETCH_ASSOC);

if ((int)$user["is_active"] !== 1) {
    http_response_code(403);
    echo json_encode(["message" => "Your account is inactive."]);
    exit;
}

if (!password_verify($password, $user["password_hash"])) {
    http_response_code(401);
    echo json_encode(["message" => "Invalid email or password."]);
    exit;
}

http_response_code(200);
echo json_encode([
    "message" => "Login successful.",
    "data" => [
        "user_id" => $user["user_id"],
        "first_name" => $user["first_name"],
        "last_name" => $user["last_name"],
        "email" => $user["email"],
        "role_id" => $user["role_id"]
    ]
]);