<?php
session_start();

if (empty($_SESSION['user'])) {
    header("Location: login.php?error=" . urlencode("Vui lòng đăng nhập lại."));
    exit;
}

$user_id = $_SESSION['user']['id'];

$username = $_SESSION['user']['username'];

$msg = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $msg = $_POST['message'] ?? '';
}
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

      <p>Xin chào <strong><?php echo $username ?></strong></p>

      <form method="POST" style="margin-bottom: 20px; margin-top: 20px;">
        <label for="message">Gửi nội dung:</label>
        <textarea name="message" id="message" rows="4" cols="35"></textarea>
        <button style="margin-top: 20px;" type="submit">Gửi</button>
      </form>

      <?php if ($msg): ?>
        <h4>Nội dung bạn vừa gửi:</h4>
        <div style="background: #eee; padding: 10px; border-radius: 5px; margin-top: 10px;">
          <?php echo $msg; ?>
        </div>
      <?php endif; ?>

      <div style="margin-top: 20px;">
        <a href="dashboard.php"><button>Quay về Dashboard</button></a>
      </div>
    </div>
  </div>
</body>
</html>
