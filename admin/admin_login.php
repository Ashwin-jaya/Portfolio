<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
   <style>
    body {
      background-color: #f8f9fa;
    }

    .form-container {
      max-width: 500px;
      margin: 50px auto;
      background-color: white;
      padding: 40px;
      border-radius: 10px;
      box-shadow: 0 0 15px rgba(0,0,0,0.1);
    }

    .form-title {
      margin-bottom: 30px;
      text-align: center;
    }
   </style>
</head>
<body>
    <div class="form-container">
        <div class="tab-pane fade show active" id="login" role="tabpanel">
        <h4 class="form-title">Login</h4>
        <form action="admin_log.php" method="POST">
          <div class="mb-3">
            <label for="loginEmail" class="form-label">Email address</label>
            <input type="email" class="form-control" id="loginEmail" name="email" required>
          </div>
          <div class="mb-3">
            <label for="loginPassword" class="form-label">Password</label>
            <input type="password" class="form-control" id="loginPassword" name="password" required>
          </div>
          <div class="d-flex justify-content-between align-items-center mb-3">
            <div class="form-check">
              <input type="checkbox" class="form-check-input" id="rememberMe">
              <label class="form-check-label" for="rememberMe">Remember me</label>
            </div>
            <a href="#">Forgot password?</a>
          </div>
          <button type="submit" class="btn btn-primary w-100">Login</button>
          </div >
            <a style="margin-top:5px;" href="../login.php">Login as User?CLick here</a>
          </div>
        </form>
      </div>
    </div>
     
</body>
</html>