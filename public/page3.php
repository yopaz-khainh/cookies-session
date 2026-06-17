<?php
session_start();

if (!isset($_SESSION['user'])) {
    $username = null;
} else {
    $username = $_SESSION['user']['username'];
}
?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <title>Trang 3</title>
  <link rel="stylesheet" href="assets/style.css">
</head>
<body>
  <div class="container">
    <div class="login-form">
      <h2>Trang 3</h2>

      <?php if ($username): ?>
        <p>Chào <strong><?php echo htmlspecialchars($username); ?></strong>, bạn đang được ghi nhớ nhờ session (không cần cookie `user_id`).</p>
      <?php else: ?>
        <p style="color: red;"><strong>Không thể nhận biết người dùng!</strong></p>
        <p>Bạn đã truy cập mà không có thông tin đăng nhập trong session.</p>
        <a href="login.php"><button>Đăng nhập lại</button></a>
      <?php endif; ?>

      <div style="margin-top: 20px;">
        <a href="dashboard.php"><button>Quay về Dashboard</button></a>
      </div>
    </div>
  </div>
</body>
</html>
