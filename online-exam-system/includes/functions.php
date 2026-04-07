<?php
function is_post(): bool {
    return $_SERVER["REQUEST_METHOD"] === "POST";
}

function require_login(): void {
    if (!isset($_SESSION["student_id"])) {
        header("Location: /views/login.php");
        exit;
    }
}

function require_admin(): void {
    if (!isset($_SESSION["admin_id"])) {
        header("Location: /admin/admin_login.php");
        exit;
    }
}

function h(string $value): string {
    return htmlspecialchars($value, ENT_QUOTES, "UTF-8");
}
?>
