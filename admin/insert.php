<?php
header('Content-Type: application/json');
$conn = new mysqli("localhost", "root", "", "product");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];
    $link = $_POST['link'];
    $image = $_FILES['image']['name'];
    $tmp = $_FILES['image']['tmp_name'];
    $target = "../uploads/" . ($image);

    if (move_uploaded_file($tmp, $target)) {
        $sql = "INSERT INTO prod (pname, price, image, link) VALUES ('$name', '$price', '$target', '$link')";
        if ($conn->query($sql)) {
            echo "Entered";
            header("Location: insert_prod.php");

        } else {
             echo  "DB insert failed";
        }
    } else {
        echo "Image upload failed.";
    }
}
