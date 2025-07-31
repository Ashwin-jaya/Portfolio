<?php
$conn = new mysqli("localhost", "root", "", "login");
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $stmt = $conn->prepare("SELECT * FROM custdata WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 1) {
        $row = $result->fetch_assoc();
        $hashedPassword = $row['password'];

        if (password_verify($password, $hashedPassword)) {
            session_start();
            $_SESSION['username'] = $row['username'];
            $_SESSION['img'] = $row['profilePic'];

            header("Location: home.php");
            exit();
        } else {
            echo "Incorrect password";
        }
    } else {
        echo "Username not found";
    }
}
