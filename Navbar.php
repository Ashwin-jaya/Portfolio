<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
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
            z-index: 100;
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

        .profilePic {
            width: 2.5rem;
        }

        .dropdown {
            position: relative;
        }

        .dropdown-toggle {
            cursor: pointer;
            border-radius: 50%;
        }

        .dropdown-menu {
            display: none;
            position: absolute;
            top: 50px;
            right: 0;
            background-color: white;
            color: black;
            padding: 10px 15px;
            border-radius: 10px;
            box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.4);
            min-width: 160px;
            z-index: 999;
        }

        .dropdown-menu p {
            margin-bottom: 10px;
        }

        .dropdown-menu a {
            color: red;
            text-decoration: none;
            font-weight: bold;
        }

        .dropdown-menu.show {
            display: block;
        }
    </style>
</head>

<body>
    <div class="navbar">
        <a id="Logg" href="Home.php">Ashwin</a>
        <button class="hamburger" onclick="toggleMenu()">☰</button> <!--To show a dropdown like manu while using in mobile -->

        <div class="Options" id="nav-options">
            <a href="Home.php">Home</a>
            <a href="about.php">About</a>
            <a href="projects.php">MyProject</a>
            <a href="shop.php">Shop</a>
            <a href="contact.php">Contact</a>

            <?php if (isset($_SESSION['username'])): ?>
                <div class="dropdown">
                    <img class="profilePic dropdown-toggle" src="<?= htmlspecialchars($_SESSION['img']) ?>" alt="User Image" onclick="toggleDropdown()">
                    <div class="dropdown-menu" id="dropdownMenu">
                        <p>Hello, <?= htmlspecialchars($_SESSION['username']) ?> 👋</p>
                        <a href="logout.php" style="color: red;">Logout</a>
                    </div>
                </div>
            <?php else: ?>
                <a href="login.php">Login</a>
            <?php endif; ?>
        </div>
    </div>

    <script>
        function toggleMenu() {
            const menu = document.getElementById('nav-options');
            menu.classList.toggle('show');
        }

        function toggleDropdown() {
            const menu = document.getElementById('dropdownMenu');
            menu.classList.toggle('show');
        }

        // window.addEventListener('click', function(e) {
        //     if (!e.target.closest('.dropdown')) {
        //         const menu = document.getElementById('dropdownMenu');
        //         if (menu && menu.classList.contains('show')) {
        //             menu.classList.remove('show');
        //         }
        //     }
        // });
    </script>


</body>

</html>