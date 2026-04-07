<?php
session_start();
require_once __DIR__ . "/../includes/functions.php";
require_admin();
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Admin Dashboard</title>
  <link rel="stylesheet" href="/assets/css/style.css">
  <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;600&display=swap" rel="stylesheet">
</head>
<body>
  <header>
    <div class="brand">Aurum Exam Suite</div>
    <nav class="nav">
      <span>Admin <?= h($_SESSION["admin_user"]) ?></span>
      <a href="/admin/manage_exam.php">Manage Exams</a>
      <a href="/admin/manage_questions.php">Manage Questions</a>
      <a href="/admin/view_results.php">Results</a>
      <a href="/views/logout.php">Logout</a>
    </nav>
  </header>
  <section class="hero">
    <div class="card">
      <h2>Welcome back.</h2>
      <p>Use the panels to create exams, curate questions, and review scores.</p>
    </div>
  </section>
</body>
</html>
