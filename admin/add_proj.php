<?php
$conn = mysqli_connect("localhost", "root", "", "product");

if ($conn->connect_error) {
    die("Couldn't connect to Database" . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $name = htmlspecialchars($_POST['name']);
    $description = htmlspecialchars($_POST['description']);
    $link = htmlspecialchars($_POST['link']);

    $stmt = $conn->prepare("INSERT INTO PROJECT(name, description, link) VALUES(?,?,?);");
    $stmt->bind_param("sss", $name, $description, $link);

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