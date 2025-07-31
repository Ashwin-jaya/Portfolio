<?php
$conn = new mysqli("localhost", "root", "", "contactme");

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id'])) {
    $id = intval($_POST['id']);
    $sql = ("DELETE FROM usermail WHERE userID = $id");
    if ($conn->query($sql)) {
        header("Location: show_msg.php");
        // echo "Something is happinging $id";

    } else {
        echo  "Could not delete";
    }
}
