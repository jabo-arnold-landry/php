<?php
session_start();
require_once 'database.php';

$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username'] ?? '');
    $password = $_POST['password'] ?? '';

    if ($username === '' || $password === '') {
        $error = 'Please enter username and password.';
    } else {
        $sql = "SELECT id, username, password FROM users WHERE username = ? LIMIT 1";
        $stmt = mysqli_prepare($conn, $sql);
        if ($stmt) {
            mysqli_stmt_bind_param($stmt, "s", $username);
            mysqli_stmt_execute($stmt);
            $result = mysqli_stmt_get_result($stmt);
            if ($row = mysqli_fetch_assoc($result)) {
                // plain-text comparison as requested (no hashing)
                if ($password === $row['password']) {
                    $_SESSION['user_id'] = $row['id'];
                    $_SESSION['username'] = $row['username'];
                    header('Location: index.php');
                    exit;
                } else {
                    $error = 'Invalid username or password.';
                }
            } else {
                $error = 'Invalid username or password.';
            }
            mysqli_stmt_close($stmt);
        } else {
            $error = 'Database error.';
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width,initial-scale=1" />
  <title>Login</title>
  <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
</head>
<body class="bg-linear-to-r from-indigo-900 to-indigo-400 min-h-screen flex items-center justify-center">
  <form action="login.php" method="post" class="w-full max-w-sm bg-neutral-900 text-white p-6 rounded-md">
    <h2 class="text-xl mb-4">Sign in</h2>

    <?php if ($error): ?>
      <div class="bg-red-600 text-white px-3 py-2 rounded mb-3"><?php echo htmlspecialchars($error); ?></div>
    <?php endif; ?>

    <label class="block mb-3">
      <span class="text-sm">Username</span>
      <input type="text" name="username" required class="w-full mt-1 p-2 rounded bg-neutral-800 border border-neutral-700" />
    </label>

    <label class="block mb-4">
      <span class="text-sm">Password</span>
      <input type="password" name="password" required class="w-full mt-1 p-2 rounded bg-neutral-800 border border-neutral-700" />
    </label>

    <div class="flex items-center justify-between">
      <button type="submit" class="bg-indigo-700 px-4 py-2 rounded hover:bg-indigo-600">Login</button>
      <a href="login.php" class="text-sm text-neutral-300">Forgot?</a>
    </div>
  </form>
</body>
</html>
