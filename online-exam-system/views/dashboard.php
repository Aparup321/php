<?php
session_start();
require_once __DIR__ . "/../includes/db.php";
require_once __DIR__ . "/../includes/functions.php";

require_login();

$exams = $pdo->query("SELECT * FROM exams ORDER BY exam_date DESC")->fetchAll();
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Student Dashboard</title>
  <link rel="stylesheet" href="/assets/css/style.css">
</head>
<body>
  <header>
    <div class="brand">Online Exam System</div>
    <nav class="nav">
      <span>Welcome <?= h($_SESSION["student_name"]) ?></span>
      <a href="/views/result.php">Results</a>
      <a href="/views/logout.php">Logout</a>
    </nav>
  </header>
  <section class="hero">
    <div class="card">
      <h2>Available Exams</h2>
      <?php if (!$exams): ?>
        <p>No exams available.</p>
      <?php else: ?>
        <table class="table">
          <thead>
            <tr>
              <th>Exam</th>
              <th>Date</th>
              <th></th>
            </tr>
          </thead>
          <tbody>
            <?php foreach ($exams as $exam): ?>
              <tr>
                <td><?= h($exam["exam_name"]) ?></td>
                <td><?= h($exam["exam_date"]) ?></td>
                <td><a class="btn" href="/views/exam.php?exam_id=<?= h($exam["exam_id"]) ?>">Start</a></td>
              </tr>
            <?php endforeach; ?>
          </tbody>
        </table>
      <?php endif; ?>
    </div>
  </section>
</body>
</html>
