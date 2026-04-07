<?php
session_start();
require_once __DIR__ . "/../includes/auth.php";
require_once __DIR__ . "/../includes/functions.php";

$error = "";
if (is_post()) {
    $username = trim($_POST["username"] ?? "");
    $password = $_POST["password"] ?? "";
    if (login_admin($username, $password)) {
        header("Location: /admin/admin_dashboard.php");
        exit;
    }
    $error = "Invalid credentials.";
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Admin Login</title>
  <link rel="stylesheet" href="/assets/css/style.css">
  <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;600&display=swap" rel="stylesheet">
</head>
<body>
  <header>
    <div class="brand">Aurum Exam Suite</div>
    <nav class="nav">
      <a href="/views/index.php">Home</a>
      <a href="/views/login.php">Student Login</a>
    </nav>
  </header>
  <section class="hero">
    <div class="card">
      <h2>Admin Login</h2>
      <?php if ($error): ?>
        <p class="pill"><?= h($error) ?></p>
      <?php endif; ?>
      <form method="post">
        <div class="form-group">
          <label>Username</label>
          <input type="text" name="username" required>
        </div>
        <div class="form-group">
          <label>Password</label>
          <input type="password" name="password" required>
        </div>
        <button class="btn" type="submit">Login</button>
      </form>
    </div>
  </section>
</body>
</html>
