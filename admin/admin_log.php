<?php
$conn = new mysqli("localhost", "root", "", "login");
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $password = $_POST['password'];
    $stmt = $conn->prepare("SELECT * FROM adminData WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();
    if ($result->num_rows === 1) {
        $row = $result->fetch_assoc();

        if ($password === $row['password']) {
            session_start();
            $_SESSION['admin_logged_in'] = true;
            header("Location: dashboard.php"); 
            exit();
        } else {
            echo "Incorrect password";
        }
    } else {
        echo "Username not found";
    }
}
