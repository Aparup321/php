<?php
require_once __DIR__ . "/db.php";

function login_student(string $email, string $password): bool {
    global $pdo;
    $stmt = $pdo->prepare("SELECT * FROM students WHERE email = ? LIMIT 1");
    $stmt->execute([$email]);
    $student = $stmt->fetch();
    if ($student && $password === $student["password"]) {
        $_SESSION["student_id"] = $student["id"];
        $_SESSION["student_name"] = $student["name"];
        return true;
    }
    return false;
}

function login_admin(string $username, string $password): bool {
    global $pdo;
    $stmt = $pdo->prepare("SELECT * FROM admin WHERE username = ? LIMIT 1");
    $stmt->execute([$username]);
    $admin = $stmt->fetch();
    if ($admin && $password === $admin["password"]) {
        $_SESSION["admin_id"] = $admin["id"];
        $_SESSION["admin_user"] = $admin["username"];
        return true;
    }
    return false;
}

function register_student(string $name, string $email, string $password): bool {
    global $pdo;
    $stmt = $pdo->prepare("INSERT INTO students (name, email, password) VALUES (?, ?, ?)");
    return $stmt->execute([$name, $email, $password]);
}
?>
