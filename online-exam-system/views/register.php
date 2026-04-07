<?php
session_start();
require_once __DIR__ . "/../includes/auth.php";
require_once __DIR__ . "/../includes/functions.php";

$message = "";
if (is_post()) {
    $name = trim($_POST["name"] ?? "");
    $email = trim($_POST["email"] ?? "");
    $password = $_POST["password"] ?? "";
    if ($name && $email && $password) {
        if (register_student($name, $email, $password)) {
            $message = "Registration successful. Please login.";
        } else {
            $message = "Registration failed. Try another email.";
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Student Register</title>
  <link rel="stylesheet" href="/assets/css/style.css">
  <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;600&display=swap" rel="stylesheet">
</head>
<body>
  <header>
    <div class="brand">Aurum Exam Suite</div>
    <nav class="nav">
      <a href="/views/index.php">Home</a>
      <a href="/views/login.php">Login</a>
      <a href="/admin/admin_login.php">Admin</a>
    </nav>
  </header>
  <section class="hero">
    <div class="card">
      <h2>Create Student Account</h2>
      <?php if ($message): ?>
        <p class="pill"><?= h($message) ?></p>
      <?php endif; ?>
      <form method="post">
        <div class="form-group">
          <label>Name</label>
          <input type="text" name="name" required>
        </div>
        <div class="form-group">
          <label>Email</label>
          <input type="email" name="email" required>
        </div>
        <div class="form-group">
          <label>Password</label>
          <input type="password" name="password" required>
        </div>
        <button class="btn" type="submit">Register</button>
      </form>
    </div>
  </section>
</body>
</html>
