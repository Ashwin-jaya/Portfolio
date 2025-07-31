<?php
$conn = new mysqli("localhost", "root", "", "contactme");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
