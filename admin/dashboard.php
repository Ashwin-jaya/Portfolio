<?php

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
    header("Location: admin_login.php");
    exit;
}

$product_conn = new mysqli("localhost", "root", "", "product");
$login_conn = new mysqli("localhost", "root", "", "login");

// To Get total products
$product_query = "SELECT COUNT(*) AS total_products FROM prod"; // table name
$product_result = $product_conn->query($product_query);
$product_count = $product_result->fetch_assoc()['total_products'];

// TO Get total users
$user_query = "SELECT COUNT(*) AS total_users FROM custdata"; // table name
$user_result = $login_conn->query($user_query);
$user_count = $user_result->fetch_assoc()['total_users'];


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Admin Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light">
    <?php
    include 'admin_navbar.php';
    ?>
    <div class="container mt-5">
        <h1 class="text-center mb-4">📊 Admin Dashboard</h1>
        <div class="row text-center">

            <div class="col-md-6 mb-3">
                <div class="card border-primary shadow">
                    <div class="card-body">
                        <h5 class="card-title">🛒 Total Products</h5>
                        <p class="display-5 text-primary"><?php echo $product_count; ?></p>
                    </div>
                </div>
            </div>

            <div class="col-md-6 mb-3">
                <div class="card border-success shadow">
                    <div class="card-body">
                        <h5 class="card-title">👤 Total Customers</h5>
                        <p class="display-5 text-success"><?php echo $user_count; ?></p>
                    </div>
                </div>
            </div>

        </div>
    </div>
</body>

</html>