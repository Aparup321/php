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
  <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;600&display=swap" rel="stylesheet">
</head>
<body>
  <header>
    <div class="brand">Aurum Exam Suite</div>
    <nav class="nav">
      <a href="/views/index.php">Home</a>
      <a href="/views/login.php">Login</a>
      <a href="/views/register.php">Register</a>
      <a href="/admin/admin_login.php">Admin</a>
    </nav>
  </header>

  <section class="hero">
    <div class="card">
      <h1>Elevate your assessments with clarity and speed.</h1>
      <p>Launch time-bound exams, auto-grade responses, and deliver instant feedback for every student.</p>
      <a class="btn" href="/views/login.php">Start an Exam</a>
    </div>
    <div class="card">
      <h2>What you can do</h2>
      <div class="grid two-col">
        <div>
          <span class="pill">Timed</span>
          <p>Automatic countdown with auto-submit at zero.</p>
        </div>
        <div>
          <span class="pill">Random</span>
          <p>Shuffle questions to keep every session fresh.</p>
        </div>
        <div>
          <span class="pill">Instant</span>
          <p>Results calculated the moment an exam ends.</p>
        </div>
        <div>
          <span class="pill">Secure</span>
          <p>Session-driven logins for students and admins.</p>
        </div>
      </div>
    </div>
  </section>

  <div class="footer">Built with PHP, MySQL, and a lightweight Docker stack.</div>
</body>
</html>
