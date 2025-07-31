<?php
session_start();
header('Content-Type: application/json');

// Make sure you're logged in
if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
    echo json_encode(["status" => "error", "message" => "Unauthorized access"]);
    exit;
}

// Database connection
$conn = new mysqli("localhost", "root", "", "product");

if ($conn->connect_error) {
    echo json_encode(["status" => "error", "message" => "DB Connection Failed"]);
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $pname = $_POST['pname'] ?? '';

    if (empty($pname)) {
        echo json_encode(["status" => "error", "message" => "Product name is missing"]);
        exit;
    }

    $stmt = $conn->prepare("DELETE FROM prod WHERE pname = ?");
    $stmt->bind_param("s", $pname);

    if ($stmt->execute()) {
        echo json_encode(["status" => "success", "message" => "Product deleted successfully"]);
    } else {
        echo json_encode(["status" => "error", "message" => "Delete failed"]);
    }

    $stmt->close();
} else {
    echo json_encode(["status" => "error", "message" => "Invalid request method"]);
}

$conn->close();
