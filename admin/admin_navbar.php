<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
$conn = new mysqli("localhost", "root", "", "contactme");

$msgquery = "SELECT COUNT(*) AS total_msg FROM usermail";
$msgresult = $conn->query($msgquery);
$msgcount = $msgresult->fetch_assoc()['total_msg'];

$unread_result = $conn->query("SELECT COUNT(*) AS unread_count FROM usermail WHERE is_read = 0");
$unread = $unread_result->fetch_assoc()['unread_count'];
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Responsive Navbar</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">
    <style>
        * {
            margin: 0;
            padding: 0;
            font-family: 'Roboto', sans-serif;
            box-sizing: border-box;
        }

        .navbar {
            width: 100%;
            background-color: rgb(0, 110, 255);
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 0 20px;
            height: 60px;
            position: relative;
            z-index: 1000;
        }

        #Logg {
            color: white;
            font-size: 2rem;
            font-weight: bold;
            text-decoration: none;
        }

        .Options {
            display: flex;
            gap: 25px;
            align-items: center;
        }

        .Options a {
            text-decoration: none;
            color: aliceblue;
            font-size: 1rem;
        }

        .Options a i {
            font-size: 1.5rem;
        }

        .user-greet {
            color: white;
            font-size: 1rem;
        }

        .hamburger {
            display: none;
            font-size: 1.8rem;
            color: white;
            background: none;
            border: none;
            cursor: pointer;
        }

        @media (max-width: 768px) {
            .Options {
                flex-direction: column;
                background-color: rgb(0, 110, 255);
                position: absolute;
                top: 60px;
                left: 0;
                width: 100%;
                display: none;
                padding: 15px 0;
            }

            .Options.show {
                display: flex;
            }

            .hamburger {
                display: block;
            }
        }
    </style>
</head>

<body>
    <div class="navbar">
        <a id="Logg" href="dashboard.php">Admin Page</a>
        <button class="hamburger" onclick="toggleMenu()">☰</button>

        <div class="Options" id="nav-options">
            <a href="dashboard.php">Dashboard</a>
            <!-- <a href="manage_prduct.php">Manage Products</a> -->
            <a href="insert_prod.php">Insert Products</a>
            <a href="manage_prduct.php">Update Products</a>
            <a href="show_msg.php" class="position-relative">Messages
                <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                    <?= $unread ?>
                    <span class="visually-hidden">Unread messages</span>
                </span></a>
            <a href="manage_proj.php">Manage Projects</a>
            <!-- To toggle between login and logout as per situation -->
            <?php if (isset($_SESSION['admin_logged_in']) && $_SESSION['admin_logged_in'] === true): ?>
                <span class="nav-link text-danger"><a href="admin_logout.php" class="text-danger text-decoration-none">Logout</a></span>
            <?php else: ?>
                <span class="nav-link text-success"><a href="admin_login.php" class="text-success text-decoration-none">Login</a></span>
            <?php endif; ?>
        </div>
    </div>
    <script>
        function toggleMenu() {
            const menu = document.getElementById('nav-options');
            menu.classList.toggle('show');
        }
    </script>
</body>

</html>