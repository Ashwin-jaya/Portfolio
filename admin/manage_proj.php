<?php
session_start();
$conn = mysqli_connect("localhost", "root", "", "product");

$result = $conn->query("Select * from project");

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
    <title>Manage Projects</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light">
    <?php include 'admin_navbar.php'; ?>
    <div class="container py-5">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2>Project Manager</h2>
            <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addProjectModal">Add Project</button>
        </div>

        <!-- Projects Table -->

        <div class="table-responsive">
            <table class="table table-striped align-middle">
                <thead class="table-dark">
                    <tr>
                        <th>ID</th>
                        <th>Project Title</th>
                        <th>Description</th>
                        <th>Link</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($row = $result->fetch_assoc()): ?>
                        <tr>
                            <td><?= htmlspecialchars($row['id']) ?></td>
                            <td><?= htmlspecialchars($row['name']) ?></td>
                            <td><?= strlen($row['description']) > 100 ? htmlspecialchars(substr($row['description'], 0, 50)) . '...' : htmlspecialchars($row['description']); ?>
                            </td>
                            <td><a href="<?= htmlspecialchars($row['link']) ?>">View</a></td>
                            <td>
                                <button class="btn btn-sm btn-warning me-1 edit-btn">Edit</button>
                                <form action="delete_proj.php" method="POST" class="d-inline">
                                    <input type="hidden" name="id" value="<?= $row['id'] ?>">
                                    <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                                </form>
                            </td>
                        </tr>
                        <tr class="edit-row d-none">
                            <td colspan="6">
                                <form class="update-form" action="update_proj.php" method="POST" enctype="multipart/form-data">
                                    <input type="hidden" type="text" name="id" value="<?= htmlspecialchars($row['id']) ?>">
                                    <div class="row g-3">
                                        <div class="col-md-3">
                                            <input type="text" name="name" class="form-control" placeholder="Name" value="<?= htmlspecialchars($row['name']) ?>">
                                        </div>
                                        <div class="col-md-3">
                                            <input type="link" name="link" class="form-control" placeholder="Link" value="<?= htmlspecialchars($row['link']) ?>">
                                        </div>
                                        <div class="col-md-2">
                                            <textarea type="text" name="description" class="form-control" placeholder="Write your decription about the project" rows="5" style="width: 500px;"> <?= htmlspecialchars($row['description']) ?> </textarea>
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

    <!-- Insert Project Modal -->
    <div class="modal fade" id="addProjectModal" tabindex="-1" aria-labelledby="addProjectModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <form action="add_proj.php" method="POST" class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addProjectModalLabel">Add New Project</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">

                    <div class="mb-3">
                        <label for="projectTitle" class="form-label">Project Title</label>
                        <input type="text" class="form-control" id="projectTitle" name="name" required>
                    </div>

                    <div class="mb-3">
                        <label for="projectDesc" class="form-label">Description</label>
                        <textarea class="form-control" id="projectDesc" name="description" rows="3" required></textarea>
                    </div>

                    <div class="mb-3">
                        <label for="projectLink" class="form-label">Project Link</label>
                        <input type="url" class="form-control" id="projectLink" name="link" required>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Add Project</button>
                </div>
            </form>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Button to toggle edit
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
    </script>
</body>

</html>