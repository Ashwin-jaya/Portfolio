<?php
session_start();
header('Content-Type: application/json');

// Prevent redirect — respond in JSON
if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
    echo json_encode(["status" => "error", "message" => "Unauthorized access"]);
    exit;
}

$conn = new mysqli("localhost", "root", "", "product");
if ($conn->connect_error) {
    echo json_encode(["status" => "error", "message" => "DB connection failed"]);
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $original_name = $_POST['original_name'] ?? '';
    $name = $_POST['name'] ?? '';
    $price = $_POST['price'] ?? '';
    $link = $_POST['link'] ?? '';
    $imageUpdated = false;
    $imagePath = "";

    if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
        $imgName = $_FILES['image']['name'];
        $tmpName = $_FILES['image']['tmp_name'];
        $ext = strtolower(pathinfo($imgName, PATHINFO_EXTENSION));
        $allowed = ['jpg', 'jpeg', 'png', 'webp'];

        if (in_array($ext, $allowed)) {
            $newName = uniqid("img_") . '.' . $ext;
            $uploadDir = "../uploads/";
            if (!is_dir($uploadDir)) mkdir($uploadDir, 0755, true);
            $fullPath = $uploadDir . $newName;

            if (move_uploaded_file($tmpName, $fullPath)) {
                $imagePath = $fullPath;
                $imageUpdated = true;
            } else {
                echo json_encode(["status" => "error", "message" => "Failed to upload image"]);
                exit;
            }
        } else {
            echo json_encode(["status" => "error", "message" => "Invalid image format"]);
            exit;
        }
    }

    if ($imageUpdated) {
        $stmt = $conn->prepare("UPDATE prod SET pname = ?, price = ?, link = ?, image = ? WHERE pname = ?");
        $stmt->bind_param("sssss", $name, $price, $link, $imagePath, $original_name);
    } else {
        $stmt = $conn->prepare("UPDATE prod SET pname = ?, price = ?, link = ? WHERE pname = ?");
        $stmt->bind_param("ssss", $name, $price, $link, $original_name);
    }

    if ($stmt->execute()) {
        echo json_encode([
            "status" => "success",
            "message" => "Product updated successfully",
            "name" => $name,
            "price" => $price,
            "link" => $link,
            "image" => $imageUpdated ? $imagePath : null
        ]);
    } else {
        echo json_encode(["status" => "error", "message" => "Update failed"]);
    }

    $stmt->close();
    $conn->close();
} else {
    echo json_encode(["status" => "error", "message" => "Invalid request"]);
}
