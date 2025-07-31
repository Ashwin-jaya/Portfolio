<?php
session_start();
$conn = new mysqli("localhost", "root", "", "product");
$products = $conn->query("SELECT * FROM prod");


if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
    header("Location: admin_login.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Admin Panel</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">
    <style>
        body {
            background-color: #f1f3f5;
        }

        .container {
            max-width: 1000px;
            margin-top: 50px;
        }

        table img {
            width: 60px;
            height: auto;
            border-radius: 5px;
        }
    </style>
</head>

<body>
    <?php include 'admin_navbar.php'; ?>

    <div class="container">
        <div class="card p-4 shadow-sm">
            <h4 class="mb-4 text-center">Current Products</h4>
            <div class="table-responsive">
                <table class="table table-bordered table-hover bg-white">
                    <thead class="table-dark">
                        <tr>
                            <th>Product ID</th>
                            <th>Name</th>
                            <th>Price (₹)</th>
                            <th>Image</th>
                            <th>Link</th>
                            <th>Edit</th>
                            <th>Delete</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while ($row = $products->fetch_assoc()): ?>
                            <tr>
                                <td><?= htmlspecialchars($row['Pid']) ?></td>
                                <td><?= htmlspecialchars($row['pname']) ?></td>
                                <td><?= htmlspecialchars($row['price']) ?></td>
                                <td>
                                    <?php if (!empty($row['image'])): ?>
                                        <img src="<?= htmlspecialchars($row['image']) ?>" alt="Image">
                                    <?php else: ?>
                                        <span class="text-muted">No image</span>
                                    <?php endif; ?>
                                </td>
                                <td><a href="<?= htmlspecialchars($row['link']) ?>" target="_blank">View</a></td>
                                <td><button class="btn btn-warning btn-sm edit-btn">Edit</button></td>
                                <td>
                                    <form class="delete-form" method="POST">
                                        <input type="hidden" name="pname" value="<?= htmlspecialchars($row['pname']) ?>">
                                        <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                                    </form>
                                </td>
                            </tr>
                            <!-- Edit Row -->
                            <tr class="edit-row d-none">
                                <td colspan="6">
                                    <form class="update-form" method="POST" enctype="multipart/form-data">
                                        <input type="hidden" name="original_name" value="<?= htmlspecialchars($row['pname']) ?>">
                                        <div class="row g-3">
                                            <div class="col-md-3">
                                                <input type="text" name="name" class="form-control" placeholder="Name" value="<?= htmlspecialchars($row['pname']) ?>">
                                            </div>
                                            <div class="col-md-2">
                                                <input type="text" name="price" class="form-control" placeholder="Price" value="<?= htmlspecialchars($row['price']) ?>">
                                            </div>
                                            <div class="col-md-3">
                                                <input type="url" name="link" class="form-control" placeholder="Product Link" value="<?= htmlspecialchars($row['link']) ?>">
                                            </div>
                                            <div class="col-md-4">
                                                <input type="file" name="image" class="form-control" accept=".jpg,.jpeg,.png,.webp">
                                            </div>
                                        </div>
                                        <div class="mt-3 text-end">
                                            <button type="submit" class="btn btn-success btn-sm">Update</button>
                                            <button type="button" class="btn btn-secondary btn-sm cancel-edit">Cancel</button>
                                        </div>
                                    </form>
                                </td>
                            </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>
            </div>

        </div>
    </div>

    <script>
        // To toggle edit 
        document.addEventListener("DOMContentLoaded", function() {
            document.querySelectorAll(".edit-btn").forEach((btn, index) => {
                btn.addEventListener("click", function() {
                    const row = btn.closest("tr");
                    const editRow = row.nextElementSibling;
                    editRow.classList.remove("d-none");
                });
            });

            document.querySelectorAll(".cancel-edit").forEach((btn) => {
                btn.addEventListener("click", function() {
                    const editRow = btn.closest("tr");
                    editRow.classList.add("d-none");
                });
            });
        });

        //AJAX Delete Form
        document.addEventListener("DOMContentLoaded", function() {
            document.querySelectorAll(".delete-form").forEach((form) => {
                form.addEventListener("submit", function(e) {
                    e.preventDefault();

                    const formData = new FormData(form);

                    fetch("delete_prod.php", {
                            method: "POST",
                            body: formData
                        })
                        .then(res => res.json())
                        .then(data => {
                            if (data.status === "success") {
                                const row = form.closest("tr");
                                const editRow = row.nextElementSibling;
                                row.remove();
                                if (editRow && editRow.classList.contains("edit-row")) {
                                    editRow.remove();
                                }
                            } else {
                                alert("Error: " + data.message);
                            }
                        })
                        .catch(err => {
                            console.error("Delete error:", err);
                            alert("Failed to delete.");
                        });
                });
            });
        });
        // Upadate AJAX form
        document.addEventListener("DOMContentLoaded", function() {
            document.querySelectorAll(".update-form").forEach((form) => {
                form.addEventListener("submit", function(e) {
                    e.preventDefault();
                    const formData = new FormData(form);

                    fetch("update_prod.php", {
                            method: "POST",
                            body: formData
                        })
                        .then(res => res.json())
                        .then(data => {
                            if (data.status === "success") {


                                // Get table row above the edit row
                                const editRow = form.closest("tr");
                                const tableRow = editRow.previousElementSibling;

                                // Update cells in that row
                                const cells = tableRow.querySelectorAll("td");
                                cells[1].innerText = data.name;
                                cells[2].innerText = data.price;
                                if (data.image) {
                                    cells[3].innerHTML = `<img src="${data.image}" alt="Image">`;
                                }
                                cells[4].innerHTML = `<a href="${data.link}" target="_blank">View</a>`;

                                // Hide the edit row
                                editRow.classList.add("d-none");
                            } else {
                                alert("Error: " + data.message);
                            }
                        })
                        .catch(err => {
                            console.error("Update error:", err);
                            alert("Failed to update.");
                        });
                });
            });
        });
    </script>
</body>

</html>