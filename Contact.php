<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ContactMe</title>
     <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"> 


    <style>
        .container {
            height: 500px;
            width: 400px;
            padding-top: 100px;

            border: 10px pink;
        }
    </style>
</head>

<body>
    <?php
    include 'Navbar.php';
    ?>
    <!-- xups xwda hnkv zkgm -->
    <div class="container">
        <div class="row justify-content-center">
            <h2 class="text-center mb-4">Contact Me</h2>

            <form action="send_mail.php" method="POST">
                <div class="mb-3">
                    <label class="form-label">Name: </label>
                    <input type="text" class="form-control" name="name" placeholder="xyz">
                </div>
                <div class="mb-3">
                    <label class="form-label">Email: </label>
                    <input type="email" class="form-control" name="email" placeholder="name@example.com">
                </div>
                <div class="mb-3">
                    <label class="form-label"> Message: </label>
                    <textarea class="form-control" name="message" rows="3"></textarea>
                </div>
                <div class="d-grid">
                    <button type="submit" class="btn btn-success">Submit</button>
                </div>
            </form>



        </div>
    </div>


</body>

</html>