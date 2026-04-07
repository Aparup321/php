<?php
session_start();
require_once __DIR__ . "/../includes/db.php";
require_once __DIR__ . "/../includes/functions.php";
require_admin();

$message = "";
if (is_post()) {
    $examId = (int)($_POST["exam_id"] ?? 0);
    $question = trim($_POST["question"] ?? "");
    $options = [
        trim($_POST["option1"] ?? ""),
        trim($_POST["option2"] ?? ""),
        trim($_POST["option3"] ?? ""),
        trim($_POST["option4"] ?? "")
    ];
    $correct = (int)($_POST["correct_option"] ?? 0);
    if ($examId && $question && $correct) {
        $stmt = $pdo->prepare("INSERT INTO questions (exam_id, question, option1, option2, option3, option4, correct_option) VALUES (?, ?, ?, ?, ?, ?, ?)");
        $stmt->execute([$examId, $question, $options[0], $options[1], $options[2], $options[3], $correct]);
        $message = "Question added.";
    }
}

$exams = $pdo->query("SELECT * FROM exams ORDER BY exam_date DESC")->fetchAll();
$questions = $pdo->query("SELECT q.*, e.exam_name FROM questions q JOIN exams e ON q.exam_id = e.exam_id ORDER BY q.id DESC")->fetchAll();
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Manage Questions</title>
  <link rel="stylesheet" href="/assets/css/style.css">
</head>
<body>
  <header>
    <div class="brand">Online Exam System</div>
    <nav class="nav">
      <a href="/admin/admin_dashboard.php">Dashboard</a>
      <a href="/admin/manage_exam.php">Exams</a>
      <a href="/admin/view_results.php">Results</a>
    </nav>
  </header>
  <section class="hero">
    <div class="card">
      <h2>Add Question</h2>
      <?php if ($message): ?>
        <p class="pill"><?= h($message) ?></p>
      <?php endif; ?>
      <form method="post">
        <div class="form-group">
          <label>Exam</label>
          <select name="exam_id" required>
            <?php foreach ($exams as $exam): ?>
              <option value="<?= h($exam["exam_id"]) ?>"><?= h($exam["exam_name"]) ?></option>
            <?php endforeach; ?>
          </select>
        </div>
        <div class="form-group">
          <label>Question</label>
          <textarea name="question" rows="3" required></textarea>
        </div>
        <div class="grid two-col">
          <div class="form-group">
            <label>Option 1</label>
            <input type="text" name="option1" required>
          </div>
          <div class="form-group">
            <label>Option 2</label>
            <input type="text" name="option2" required>
          </div>
          <div class="form-group">
            <label>Option 3</label>
            <input type="text" name="option3" required>
          </div>
          <div class="form-group">
            <label>Option 4</label>
            <input type="text" name="option4" required>
          </div>
        </div>
        <div class="form-group">
          <label>Correct Option (1-4)</label>
          <input type="number" name="correct_option" min="1" max="4" required>
        </div>
        <button class="btn" type="submit">Add Question</button>
      </form>
    </div>
    <div class="card">
      <h2>Recent Questions</h2>
      <table class="table">
        <thead>
          <tr>
            <th>Exam</th>
            <th>Question</th>
            <th>Correct</th>
          </tr>
        </thead>
        <tbody>
          <?php foreach ($questions as $q): ?>
            <tr>
              <td><?= h($q["exam_name"]) ?></td>
              <td><?= h($q["question"]) ?></td>
              <td><?= h($q["correct_option"]) ?></td>
            </tr>
          <?php endforeach; ?>
        </tbody>
      </table>
    </div>
  </section>
</body>
</html>
