<?php
$dbHost = "db";
$dbName = "online_exam";
$dbUser = "exam_user";
$dbPass = "exam_pass";

try {
    $pdo = new PDO(
        "mysql:host=" . $dbHost . ";dbname=" . $dbName . ";charset=utf8mb4",
        $dbUser,
        $dbPass,
        [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
        ]
    );
} catch (PDOException $e) {
    die("Database connection failed.");
}
?>
