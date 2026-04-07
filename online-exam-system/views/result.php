<?php
session_start();
require_once __DIR__ . "/../includes/db.php";
require_once __DIR__ . "/../includes/functions.php";

require_login();

$studentId = (int)$_SESSION["student_id"];
$examId = (int)($_GET["exam_id"] ?? 0);

if ($examId) {
    $stmt = $pdo->prepare("SELECT r.score, e.exam_name, r.created_at FROM results r JOIN exams e ON r.exam_id = e.exam_id WHERE r.student_id = ? AND r.exam_id = ? ORDER BY r.created_at DESC LIMIT 1");
    $stmt->execute([$studentId, $examId]);
    $latest = $stmt->fetch();
}

$historyStmt = $pdo->prepare("SELECT r.score, e.exam_name, r.created_at FROM results r JOIN exams e ON r.exam_id = e.exam_id WHERE r.student_id = ? ORDER BY r.created_at DESC");
$historyStmt->execute([$studentId]);
$history = $historyStmt->fetchAll();
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Results</title>
  <link rel="stylesheet" href="/assets/css/style.css">
  <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;600&display=swap" rel="stylesheet">
</head>
<body>
  <header>
    <div class="brand">Aurum Exam Suite</div>
    <nav class="nav">
      <a href="/views/dashboard.php">Dashboard</a>
      <a href="/views/logout.php">Logout</a>
    </nav>
  </header>
  <section class="hero">
    <div class="card">
      <h2>Latest Result</h2>
      <?php if (!empty($latest)): ?>
        <p><strong><?= h($latest["exam_name"]) ?></strong> — Score: <?= h($latest["score"]) ?></p>
        <p class="pill">Submitted at <?= h($latest["created_at"]) ?></p>
      <?php else: ?>
        <p>No results yet.</p>
      <?php endif; ?>
    </div>
    <div class="card">
      <h2>History</h2>
      <?php if (!$history): ?>
        <p>No attempts available.</p>
      <?php else: ?>
        <table class="table">
          <thead>
            <tr>
              <th>Exam</th>
              <th>Score</th>
              <th>Date</th>
            </tr>
          </thead>
          <tbody>
            <?php foreach ($history as $row): ?>
              <tr>
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
