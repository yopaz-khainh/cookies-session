<?php
session_start();

$users = require __DIR__ . '/../data/users.php';
$valid_users = $users['users'];

$username = $_POST['username'] ?? '';
$password = $_POST['password'] ?? '';

if (isset($valid_users[$username]) && $valid_users[$username]['password'] === $password) {
    $user_id = $valid_users[$username]['id'];

    $_SESSION['user'] = [
        'id' => $user_id,
        'username' => $username,
    ];

    header("Location: dashboard.php");
    exit;
} else {
    header("Location: login.php?error=" . urlencode("Sai tên đăng nhập hoặc mật khẩu"));
    exit;
}