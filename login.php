<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <title>Login & Signup</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
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
      box-shadow: 0 0 15px rgba(0, 0, 0, 0.1);
    }

    .form-title {
      margin-bottom: 30px;
      text-align: center;
    }
  </style>
</head>

<body>
  <?php
  include 'Navbar.php';
  ?>
  <div class="form-container">
    <!-- Toggle button -->
    <ul class="nav nav-pills nav-justified mb-4" id="pills-tab" role="tablist">
      <li class="nav-item" role="presentation">
        <button class="nav-link active" id="login-tab" data-bs-toggle="pill" data-bs-target="#login" type="button" role="tab">Login</button>
      </li>
      <li class="nav-item" role="presentation">
        <button class="nav-link" id="signup-tab" data-bs-toggle="pill" data-bs-target="#signup" type="button" role="tab">Sign Up</button>
      </li>
    </ul>


    <div class="tab-content" id="pills-tabContent">

      <!-- Login Tab -->
      <div class="tab-pane fade show active" id="login" role="tabpanel">
        <h4 class="form-title">Login</h4>
        <form action="log.php" method="POST">
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
          <a style="margin-top:5px;" href="admin/admin_login.php">Login as admin?CLick here</a>
      </div>

    </div>
    </form>

    <!-- Sign Up Tab -->
    <div class="tab-pane fade" id="signup" role="tabpanel">
      <h4 class="form-title">Sign Up</h4>
      <form action="signup.php" method="POST" enctype="multipart/form-data">
        <div class="mb-3">
          <label class="form-label">Profile Photo</label>
          <input class="form-control" type="file" accept=".jpg, .png, .jpeg, .webp" name="profilePic"  value="basic-login-img.png" >
        </div>
        <div class="mb-3">
          <label for="signupEmail" class="form-label">Email address</label>
          <input type="email" class="form-control" id="signupEmail" name="email" required>
        </div>
        <div class="mb-3">
          <label for="signupUsername" class="form-label">Username</label>
          <input type="text" class="form-control" id="signupUsername" name="username" required>
        </div>
        <div class="mb-3">
          <label for="signupPassword" class="form-label">Password</label>
          <input type="password" class="form-control" id="signupPassword" name="password" required>
        </div>
        <div class="form-check mb-3">
          <input type="checkbox" class="form-check-input" id="termsCheck" name="terms" required>
          <label class="form-check-label" for="termsCheck">
            I agree to the terms and conditions
          </label>
        </div>
        
        <button type="submit" class="btn btn-success w-100">Register</button>
      </form>
    </div>
  </div>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>