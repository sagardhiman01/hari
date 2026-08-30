<?php
session_start();
require_once '../includes/db.php';

if (isset($_SESSION['admin_logged_in'])) {
    header('Location: dashboard.php');
    exit;
}

$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'] ?? '';
    $password = $_POST['password'] ?? '';

    $stmt = $pdo->prepare("SELECT * FROM users WHERE username = ?");
    $stmt->execute([$username]);
    $user = $stmt->fetch();

    if ($user && password_verify($password, $user['password'])) {
        $_SESSION['admin_logged_in'] = true;
        header('Location: dashboard.php');
        exit;
    } else {
        $error = 'Invalid username or password. Please try again.';
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login - Harihar Ratna Emporium</title>
    <link rel="stylesheet" href="admin_style.css">
    <style>
        .login-box {
            max-width: 420px;
            margin: 6rem auto;
            background: var(--admin-card);
            border: 1px solid var(--admin-border);
            border-radius: 12px;
            padding: 2.5rem;
            box-shadow: 0 15px 40px rgba(0, 0, 0, 0.6);
            text-align: center;
        }
        .login-logo {
            font-family: 'Cinzel', serif;
            font-size: 1.8rem;
            color: var(--admin-gold);
            margin-bottom: 0.5rem;
        }
        .login-subtitle {
            color: var(--admin-muted);
            font-size: 0.88rem;
            margin-bottom: 2rem;
        }
    </style>
</head>
<body>

<div class="login-box">
    <div class="login-logo">ॐ Harihar Ratna</div>
    <div class="login-subtitle">Admin Management Portal • Haridwar</div>

    <?php if ($error): ?>
        <div class="alert-admin error"><?php echo htmlspecialchars($error); ?></div>
    <?php endif; ?>

    <form method="POST">
        <div class="form-group" style="text-align: left;">
            <label>Username</label>
            <input type="text" name="username" class="form-control" placeholder="Enter admin username" required>
        </div>
        <div class="form-group" style="text-align: left;">
            <label>Password</label>
            <input type="password" name="password" class="form-control" placeholder="Enter password" required>
        </div>
        <button type="submit" class="btn-admin btn-admin-gold" style="width: 100%; justify-content: center; padding: 0.75rem; margin-top: 1rem;">
            Secure Admin Login
        </button>
    </form>

    <div style="margin-top: 1.75rem;">
        <a href="../" style="color: var(--admin-gold); font-size: 0.88rem; text-decoration: none;">Back to Main Website</a>
    </div>
</div>

</body>
</html>
