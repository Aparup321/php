<?php
require_once __DIR__ . "/db.php";

function login_student(string $email, string $password): bool {
    global $pdo;
    $stmt = $pdo->prepare("SELECT * FROM students WHERE email = ? LIMIT 1");
    $stmt->execute([$email]);
    $student = $stmt->fetch();
    if ($student && password_verify($password, $student["password"])) {
        $_SESSION["student_id"] = $student["id"];
        $_SESSION["student_name"] = $student["name"];
        return true;
    }
    error_log("Student login failed for email: " . $email);
    return false;
}

function login_admin(string $username, string $password): bool {
    global $pdo;
    $stmt = $pdo->prepare("SELECT * FROM admin WHERE username = ? LIMIT 1");
    $stmt->execute([$username]);
    $admin = $stmt->fetch();
    if ($admin && password_verify($password, $admin["password"])) {
        $_SESSION["admin_id"] = $admin["id"];
        $_SESSION["admin_user"] = $admin["username"];
        error_log("Admin login successful for user: " . $username);
        return true;
    }
    error_log("Admin login failed for user: " . $username);
    return false;
}

function register_student(string $name, string $email, string $password): bool {
    global $pdo;
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
    $stmt = $pdo->prepare("INSERT INTO students (name, email, password) VALUES (?, ?, ?)");
    return $stmt->execute([$name, $email, $hashedPassword]);
}
?>
