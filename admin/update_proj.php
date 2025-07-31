<?php
$conn = mysqli_connect("localhost", "root", "", "product");

if ($conn->connect_error) {
    die("Couldn't connect to Database" . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $id = htmlspecialchars($_POST['id']);
    $name = htmlspecialchars($_POST['name']);
    $description = htmlspecialchars($_POST['description']);
    $link = htmlspecialchars($_POST['link']);

    $stmt = $conn->prepare("UPDATE project SET name = ?, description = ?, link = ? WHERE id = ?");
    $stmt->bind_param("ssss", $name, $description, $link, $id);

    if ($stmt->execute()) {
        // echo "Entered into the database";
        header("Location: manage_proj.php");
    } else {
        echo "Entering failed" . $stmt->error;
    }
    $stmt->close();
}
$conn->close();
?>