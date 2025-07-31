 <?php
session_start();

if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
    header("Location: admin_login.php");
    exit;
} 

$conn = new mysqli("localhost", "root", "", "product");

if ($_SERVER["REQUEST_METHOD"] === "POST" ) {
    $id = intval($_POST['id']);

    $stmt = $conn->prepare("DELETE FROM project WHERE id = ?");
    $stmt->bind_param("i", $id);

    if ($stmt->execute()) {
        header("Location: manage_proj.php");
        exit;
    } else {
        echo "Error deleting project: " . $stmt->error;
    }

    $stmt->close();
} else {
    echo "Invalid request.";
}

$conn->close();
