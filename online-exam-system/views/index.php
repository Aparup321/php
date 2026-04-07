<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Online Exam System</title>
  <link rel="stylesheet" href="/assets/css/style.css">
</head>
<body>
  <header>
    <div class="brand">Online Exam System</div>
    <nav class="nav">
      <a href="/views/index.php">Home</a>
      <a href="/views/login.php">Login</a>
      <a href="/views/register.php">Register</a>
      <a href="/admin/admin_login.php">Admin</a>
    </nav>
  </header>

  <section class="hero">
    <div class="card">
      <h1>Online Examination System</h1>
      <p>Login or register to start an exam.</p>
      <a class="btn" href="/views/login.php">Student Login</a>
    </div>
  </section>

  <div class="footer">PHP + MySQL</div>
</body>
</html>
