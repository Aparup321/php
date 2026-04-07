<?php
session_start();
require_once __DIR__ . "/../includes/db.php";
require_once __DIR__ . "/../includes/functions.php";

require_login();

$examId = (int)($_GET["exam_id"] ?? 0);
if (!$examId) {
    header("Location: /views/dashboard.php");
    exit;
}

$examStmt = $pdo->prepare("SELECT * FROM exams WHERE exam_id = ?");
$examStmt->execute([$examId]);
$exam = $examStmt->fetch();
if (!$exam) {
    header("Location: /views/dashboard.php");
    exit;
}

$questionsStmt = $pdo->prepare("SELECT * FROM questions WHERE exam_id = ? ORDER BY RAND() LIMIT 5");
$questionsStmt->execute([$examId]);
$questions = $questionsStmt->fetchAll();

if (is_post()) {
    $answers = $_POST["answers"] ?? [];
    $score = 0;
    foreach ($questions as $question) {
        $qid = $question["id"];
        $selected = (int)($answers[$qid] ?? 0);
        if ($selected === (int)$question["correct_option"]) {
            $score++;
        }
    }
    $insert = $pdo->prepare("INSERT INTO results (student_id, exam_id, score) VALUES (?, ?, ?)");
    $insert->execute([$_SESSION["student_id"], $examId, $score]);
    header("Location: /views/result.php?exam_id=" . $examId);
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Exam</title>
  <link rel="stylesheet" href="/assets/css/style.css">
  <script src="/assets/js/script.js" defer></script>
</head>
<body>
  <header>
    <div class="brand">Online Exam System</div>
    <nav class="nav">
      <span class="timer" data-timer="600">10:00</span>
      <a href="/views/dashboard.php">Dashboard</a>
    </nav>
  </header>
  <section class="hero">
    <div class="card">
      <h2><?= h($exam["exam_name"]) ?></h2>
      <form method="post" data-exam>
        <?php foreach ($questions as $index => $question): ?>
          <div class="form-group">
            <strong><?= ($index + 1) ?>. <?= h($question["question"]) ?></strong>
            <?php for ($i = 1; $i <= 4; $i++): ?>
              <label>
                <input type="radio" name="answers[<?= h($question["id"]) ?>]" value="<?= $i ?>" required>
                <?= h($question["option" . $i]) ?>
              </label>
            <?php endfor; ?>
          </div>
        <?php endforeach; ?>
        <button class="btn" type="submit">Submit Exam</button>
      </form>
    </div>
  </section>
</body>
</html>
