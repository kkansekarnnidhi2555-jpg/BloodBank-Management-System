<?php
require_once __DIR__ . "/../db/connection.php";
$error = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $u = $_POST['username'] ?? '';
    $p = $_POST['password'] ?? '';
    if ($u === 'admin' && $p === '12345') {
        $_SESSION['admin_logged'] = true;
        header('Location: dashboard.php');
        exit;
    } else {
        $error = 'Invalid username or password';
    }
}
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Admin Login - Blood Bank</title>
<link rel="stylesheet" href="../assets/style.css">
</head>
<body class="page-center">
  <div class="card login-card">
    <h2>Admin Login</h2>
    <?php if ($error): ?><div class="error"><?=htmlspecialchars($error)?></div><?php endif; ?>
    <form method="post">
      <label>Username</label>
      <input name="username" required>
      <label>Password</label>
      <input type="password" name="password" required>
      <button class="btn">Login</button>
    </form>
    <p class="muted">Username: <b>admin</b> | Password: <b>12345</b></p>
  </div>
</body>
</html>
