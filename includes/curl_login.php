<?php

$loginResult = null;

if (isset($_POST['login'])) {

    $data = [
        "email"    => $_POST['email'] ?? "",
        "password" => $_POST['password'] ?? ""
    ];

    $curl = curl_init();

    curl_setopt_array($curl, [
        CURLOPT_URL => "http://localhost/BeMine_wedding_website/api/users/login.php",
        CURLOPT_POST => true,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_HTTPHEADER => [
            "Accept: application/json",
            "Content-Type: application/json"
        ],
        CURLOPT_POSTFIELDS => json_encode($data)
    ]);

    $response = curl_exec($curl);

    if ($response === false) {
        $loginResult = ["message" => curl_error($curl)];
    } else {
        $loginResult = json_decode($response, true);
    }

    curl_close($curl);

    if (isset($loginResult["message"]) && $loginResult["message"] === "Login successful.") {

        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        $_SESSION["user_id"] = $loginResult["data"]["user_id"];
        $_SESSION["first_name"] = $loginResult["data"]["first_name"];
        $_SESSION["last_name"] = $loginResult["data"]["last_name"];
        $_SESSION["email"] = $loginResult["data"]["email"];
        $_SESSION["role_id"] = $loginResult["data"]["role_id"];

        $role_id = (int)$_SESSION["role_id"];

        if ($role_id === 1) {
            header("Location: admin_index.php");
            exit;
        } elseif ($role_id === 2) {
            header("Location: couple_index.php");
            exit;
        } elseif ($role_id === 3) {
            header("Location: vendor_index.php");
            exit;
        } elseif ($role_id === 4) {
            header("Location: weddingPlanner_index.php");
            exit;
        } else {
            header("Location: index.php");
            exit;
        }
    }
}