<?php
session_start();
require_once __DIR__ . "/../includes/db.php";
require_once __DIR__ . "/../includes/functions.php";
require_admin();

$results = $pdo->query("SELECT r.score, r.created_at, s.name, s.email, e.exam_name FROM results r JOIN students s ON r.student_id = s.id JOIN exams e ON r.exam_id = e.exam_id ORDER BY r.created_at DESC")->fetchAll();
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>View Results</title>
  <link rel="stylesheet" href="/assets/css/style.css">
</head>
<body>
  <header>
    <div class="brand">Online Exam System</div>
    <nav class="nav">
      <a href="/admin/admin_dashboard.php">Dashboard</a>
      <a href="/admin/manage_exam.php">Exams</a>
      <a href="/admin/manage_questions.php">Questions</a>
    </nav>
  </header>
  <section class="hero">
    <div class="card">
      <h2>Student Results</h2>
      <?php if (!$results): ?>
        <p>No results yet.</p>
      <?php else: ?>
        <table class="table">
          <thead>
            <tr>
              <th>Student</th>
              <th>Email</th>
              <th>Exam</th>
              <th>Score</th>
              <th>Date</th>
            </tr>
          </thead>
          <tbody>
            <?php foreach ($results as $row): ?>
              <tr>
                <td><?= h($row["name"]) ?></td>
                <td><?= h($row["email"]) ?></td>
                <td><?= h($row["exam_name"]) ?></td>
                <td><?= h($row["score"]) ?></td>
                <td><?= h($row["created_at"]) ?></td>
              </tr>
            <?php endforeach; ?>
          </tbody>
        </table>
      <?php endif; ?>
    </div>
  </section>
</body>
</html>
