<?php
session_start();
require_once __DIR__ . "/../includes/db.php";
require_once __DIR__ . "/../includes/functions.php";
require_admin();

$message = "";
if (is_post()) {
    $name = trim($_POST["exam_name"] ?? "");
    $date = $_POST["exam_date"] ?? "";
    if ($name && $date) {
        $stmt = $pdo->prepare("INSERT INTO exams (exam_name, exam_date) VALUES (?, ?)");
        $stmt->execute([$name, $date]);
        $message = "Exam created.";
    }
}

$exams = $pdo->query("SELECT * FROM exams ORDER BY exam_date DESC")->fetchAll();
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Manage Exams</title>
  <link rel="stylesheet" href="/assets/css/style.css">
  <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;600&display=swap" rel="stylesheet">
</head>
<body>
  <header>
    <div class="brand">Aurum Exam Suite</div>
    <nav class="nav">
      <a href="/admin/admin_dashboard.php">Dashboard</a>
      <a href="/admin/manage_questions.php">Questions</a>
      <a href="/admin/view_results.php">Results</a>
    </nav>
  </header>
  <section class="hero">
    <div class="card">
      <h2>Create Exam</h2>
      <?php if ($message): ?>
        <p class="pill"><?= h($message) ?></p>
      <?php endif; ?>
      <form method="post">
        <div class="form-group">
          <label>Exam Name</label>
          <input type="text" name="exam_name" required>
        </div>
        <div class="form-group">
          <label>Exam Date</label>
          <input type="datetime-local" name="exam_date" required>
        </div>
        <button class="btn" type="submit">Create</button>
      </form>
    </div>
    <div class="card">
      <h2>Existing Exams</h2>
      <table class="table">
        <thead>
          <tr>
            <th>Name</th>
            <th>Date</th>
          </tr>
        </thead>
        <tbody>
          <?php foreach ($exams as $exam): ?>
            <tr>
              <td><?= h($exam["exam_name"]) ?></td>
              <td><?= h($exam["exam_date"]) ?></td>
            </tr>
          <?php endforeach; ?>
        </tbody>
      </table>
    </div>
  </section>
</body>
</html>
