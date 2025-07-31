<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
    header("Location: admin_login.php");
    exit;
}
?>

<!DOCTYPE html>

<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">
    <style>
        body {
            background-color: #f1f3f5;
        }

        .container {
            max-width: 900px;
            margin-top: 50px;
        }

        .card {
            padding: 20px;
            border-radius: 10px;
        }

        .product-card img {
            height: 150px;
            object-fit: cover;
            border-radius: 10px;
        }

        .product-card {
            width: 200px;
        }

        .product-card .card-body {
            padding: 10px;
        }

        .product-grid {
            display: flex;
            flex-wrap: wrap;
            gap: 15px;
        }
    </style>
</head>

<body>
    <?php include 'admin_navbar.php'; ?>

    <div class="container">
        <div class="card shadow-sm mb-4">
            <a href="../Home.php" class="text-decoration-none text-primary fw-bold">
                <i class="fa-solid fa-house"></i> Home
            </a>
            <h3 class="mb-4 text-center">Add New Product</h3>
            <form class="insert-form" action="insert.php" method="POST" enctype="multipart/form-data">
                <div class="mb-3">
                    <label class="form-label">Product Name</label>
                    <input type="text" class="form-control" placeholder="Name" name="name" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Price:</label>
                    <input type="text" class="form-control" placeholder="Price" name="price" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Product Link</label>
                    <input type="url" class="form-control" placeholder="Link" name="link" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Product Image:</label>
                    <input class="form-control" type="file" accept=".jpg, .png, .jpeg, .webp" name="image" required>
                </div>
                <button type="submit" class="btn btn-success w-100">Insert Product</button>
            </form>
        </div>
    </div>
    <?php
    $conn = new mysqli("localhost", "root", "", "product");
    $products = $conn->query("SELECT * FROM prod");
    ?>
    <div class="card shadow-sm">
        <h4 class="mb-3 text-center">All Products</h4>
        <div class="product-grid">
            <?php while ($row = $products->fetch_assoc()): ?>
                <div class="card product-card shadow-sm">
                    <?php if (!empty($row['image'])): ?>
                        <img src="<?= htmlspecialchars($row['image']) ?>" class="card-img-top" alt="<?= htmlspecialchars($row['pname']) ?>">
                    <?php else: ?>
                        <img src="https://via.placeholder.com/150x150?text=No+Image" class="card-img-top" alt="No Image">
                    <?php endif; ?>
                    <div class="card-body">
                        <h6 class="card-title mb-1"><?= htmlspecialchars($row['pname']) ?></h6>
                        <p class="mb-1 text-muted">₹<?= htmlspecialchars($row['price']) ?></p>
                        <a href="<?= htmlspecialchars($row['link']) ?>" target="_blank" class="btn btn-sm btn-primary w-100">View</a>
                    </div>
                </div>
            <?php endwhile; ?>
        </div>
    </div>
</body>

</html>