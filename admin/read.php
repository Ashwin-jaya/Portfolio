<?php
$conn = new mysqli("localhost", "root", "", "contactme");



if (isset($_GET['id']) && isset($_GET['current'])) {
    $id = intval($_GET['id']);
    $current = intval($_GET['current']);
    $new_value = $current === 1 ? 0 : 1;

    echo "Received ID: $id\n";
    echo "Current: $current\n";
    echo "New Value: $new_value\n";

    $stmt = $conn->prepare("UPDATE usermail SET is_read = ? WHERE userID = ?");
    $stmt->bind_param("ii", $new_value, $id);
    $stmt->execute();
}

header("Location: show_msg.php");
exit;
?>
