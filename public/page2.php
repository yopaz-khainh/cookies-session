<?php
session_start();

if (empty($_SESSION['user'])) {
    header("Location: login.php?error=" . urlencode("Vui lòng đăng nhập lại."));
    exit;
}

$user = $_SESSION['user'];
?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <title>Trang 1</title>
  <link rel="stylesheet" href="assets/style.css">
</head>
<body>
  <div class="container">
    <div class="login-form">
      <h2>Trang 1</h2>
      <p>Xin chào <strong><?php echo htmlspecialchars($user['username']); ?></strong>, đây là nội dung Trang 1.</p>
      <div style="margin-top: 20px;">
        <a href="dashboard.php"><button>Quay về Dashboard</button></a>
      </div>
    </div>
  </div>
</body>
</html>