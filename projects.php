<?php
$conn = new mysqli("localhost", "root", "", "product");
$result = $conn->query("SELECT * FROM project");
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Projects</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Roboto', sans-serif;
            background-color: #f5f7fa;

        }

        .container {
            padding-top: 60px;
        }

        .project-card {
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            border: none;
            border-radius: 15px;
            overflow: hidden;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
        }

        .project-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
        }

        .visit-btn {
            background-color: #007bff;
            border: none;
            border-radius: 25px;
            padding: 10px 25px;
            color: white;
            transition: background-color 0.3s ease;
        }

        .visit-btn:hover {
            background-color: #0056b3;
        }

        .card-text {
            font-style: italic;
            font-size: 0.95rem;
            padding: 20px;

        }

        h2 {
            font-weight: 600;
        }
    </style>
</head>

<body>
    <?php
    include 'Navbar.php';
    ?>
    <div class="container">
        <h2 class="text-center mb-5">My Projects</h2>
        <div class="row g-4">
            <?php while ($row = $result->fetch_assoc()): ?>
                <div class="col-md-6 col-lg-4">
                    <div class="card project-card h-100 p-4">
                        <h5 class="card-title text-center"><?php echo htmlspecialchars($row['name']); ?></h5>
                        <p class="card-text"><?php echo htmlspecialchars($row['description']); ?></p>
                        <div class="mt-auto text-center">
                            <a href="<?php echo htmlspecialchars($row['link']); ?>" target="_blank" class="btn visit-btn">Visit Site</a>
                        </div>
                    </div>
                </div>
            <?php endwhile; ?>
        </div>
    </div>
</body>

</html>