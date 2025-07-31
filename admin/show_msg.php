<?php

// Start session and DB connection
$conn = new mysqli("localhost", "root", "", "contactme");

// Check DB connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch messages from 'usermail' table
$result = $conn->query("SELECT * FROM usermail ORDER BY sent_at DESC");
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Messages</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Bootstrap CSS CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light">
    <?php include 'admin_navbar.php'; ?>

    <div class="container my-5">
        <h2 class="mb-4 text-center">Inbox</h2>

        <?php if ($result && $result->num_rows > 0): ?>
            <div class="row">
                <?php while ($row = $result->fetch_assoc()): ?>
                    <div class="col-md-6 mb-4">
                        <div class="card shadow-sm h-100">
                            <div class="card-body">
                                <h5 class="card-title"><?= htmlspecialchars($row['name']) ?></h5>
                                <h6 class="card-subtitle mb-2 text-muted">
                                    <?= htmlspecialchars($row['email']) ?>
                                </h6>
                                <p class="card-text"><?= nl2br(htmlspecialchars($row['msg'])) ?></p>
                            </div>
                            <div class="card-footer d-flex justify-content-between align-items-center flex-wrap">
                                <small class="text-muted">
                                    <?= date("d M Y, h:i A", strtotime($row['sent_at'])) ?>
                                </small>
                                <div class="mt-2 mt-sm-0">
                                    <!-- Reply Button Form -->
                                    <form action="reply.php" method="POST" class="d-inline">
                                        <input type="hidden" name="email" value="<?= htmlspecialchars($row['email']) ?>">
                                        <input type="hidden" name="name" value="<?= htmlspecialchars($row['name']) ?>">
                                        <input type="hidden" name="subject" value="Reply mail from Ashwin">
                                        <button type="button" class="btn btn-success btn-sm" data-bs-toggle="modal" data-bs-target="#replyModal<?= $row['userID'] ?>">
                                            Reply
                                        </button>
                                    </form>

                                    <!-- Mark as readed -->
                                    <form action="read.php" method="GET" class="d-inline ms-2">
                                        <?php if (htmlspecialchars($row['is_read']) == 0): ?>
                                            <a href="read.php?id=<?= $row['userID'] ?>&current=0" class="btn btn-primary btn-sm">Mark as Read</a>
                                        <?php else: ?>
                                            <a href="read.php?id=<?= $row['userID'] ?>&current=1" class="btn btn-outline-primary btn-sm">Mark as Unread</a>
                                        <?php endif; ?>
                                    </form>



                                    <!-- Delete Button Form -->
                                    <form action="delete_mail.php" method="POST" class="d-inline ms-2" onsubmit="return confirm('Are you sure you want to delete this message?');">
                                        <input type="hidden" name="id" value="<?= htmlspecialchars($row['userID']) ?>">
                                        <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                                    </form>
                                </div>
                            </div>
                            <!-- Modal card for reply -->
                            <div class="modal fade" id="replyModal<?= $row['userID'] ?>" tabindex="-1" aria-labelledby="replyModalLabel<?= $row['userID'] ?>" aria-hidden="true">
                                <div class="modal-dialog">
                                    <form action="reply.php" method="POST" class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="replyModalLabel<?= $row['userID'] ?>">Reply to <?= htmlspecialchars($row['name']) ?></h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <input type="hidden" name="email" value="<?= htmlspecialchars($row['email']) ?>">
                                            <input type="hidden" name="name" value="<?= htmlspecialchars($row['name']) ?>">
                                            <input type="hidden" name="subject" value="Reply mail from Ashwin">

                                            <div class="mb-3">
                                                <label for="replyMessage<?= $row['userID'] ?>" class="form-label">Your Message</label>
                                                <textarea name="message" class="form-control" id="replyMessage<?= $row['userID'] ?>" rows="5" required></textarea>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="submit" class="btn btn-success">Send Reply</button>
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endwhile; ?>
            </div>
        <?php else: ?>
            <div class="alert alert-info text-center">
                No messages found.
            </div>
        <?php endif; ?>
    </div>

    <!-- Bootstrap JS Bundle -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>