<?php
$conn = new mysqli("localhost", "root", "", "login");
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $email = $_POST['email'];
    $username = $_POST['username'];
    $password = $_POST['password'];
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
    $image = $_FILES['profilePic']['name'];
    $tmp = $_FILES['profilePic']['tmp_name'];
    $target = "uploads/" . basename($image);
    $defaultImg = "uploads/basic-login-img.png";

    if (move_uploaded_file($tmp, $target)) {
        $sql = "INSERT INTO custdata (email, username, password, profilePic) VALUES ('$email', '$username', '$hashedPassword' ,'$target')";
        if ($conn->query($sql)) {
            echo "Signed-Up  successfully!";
            header("Location: home.php");
            exit();
        } else {
            echo "Insert failed: " . $conn->error;
        }
    }else{
        $sql = "INSERT INTO custdata (email, username, password, profilePic) VALUES ('$email', '$username', '$hashedPassword' ,'$defaultImg')";
        if ($conn->query($sql)) {
            echo "Signed-Up  successfully!";
            header("Location: home.php");
            exit();
        } else {
            echo "Insert failed: " . $conn->error;
        }
    }
}
