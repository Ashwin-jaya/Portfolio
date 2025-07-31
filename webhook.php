<?php
require 'database.php';

$input = file_get_contents("php://input");

$data = json_decode($input, true);

if (isset($data['name'], $data['email'], $data['message'])) {
    $name = $conn->real_escape_string($data['name']);
    $email = $conn->real_escape_string($data['email']);
    $message = $conn->real_escape_string($data['message']);

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
