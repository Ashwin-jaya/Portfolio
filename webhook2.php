<?php
require 'database.php';

$input = file_get_contents("php://input");

$data = json_decode($input, true);

if () {
    $name = htmlspecialchars($_POST['name']);
    $email = htmlspecialchars($_POST['email']);
    $message = htmlspecialchars($_POST['message']);

    $sql = "INSERT INTO usermail (name, email, msg) VALUES ('$name', '$email', '$message')";

    if ($conn->query($sql)) {
        echo json_encode(["status" => "success"]);
    } else {
        echo json_encode(["status" => "db_error", "message" => $conn->error]);
    }
} else {
    http_response_code(400);
    echo json_encode(["status" => "invalid_data"]);
}
