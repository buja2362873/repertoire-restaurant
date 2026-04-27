<?php
session_start();

// If already logged in, redirect to dashboard
if (isset($_SESSION['admin_id'])) {
    header('Location: dashboard.php');
    exit;
}

require_once 'db_connection.php';

$error = '';
$success = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username'] ?? '');
    $password = $_POST['password'] ?? '';

    if (empty($username) || empty($password)) {
        $error = 'Username and password are required';
    } else {
        try {
            $stmt = $pdo->prepare("SELECT id, password FROM admin WHERE username = ?");
            $stmt->execute([$username]);
            $admin = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($admin && $password === $admin['password']) {
                $_SESSION['admin_id'] = $admin['id'];
                $_SESSION['admin_username'] = $username;
                
                // Set cookie for 7 days
                setcookie('admin_logged', '1', time() + (7 * 24 * 60 * 60), '/admin/');
                
                header('Location: dashboard.php');
                exit;
            } else {
                $error = 'Invalid username or password';
            }
        } catch (PDOException $e) {
            $error = 'Login error: ' . $e->getMessage();
        }
    }
}
?>
<!DOCTYPE html>
<html lang="EN">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login - Restaurant</title>
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="../css/admin/login.css">
</head>
<body>
    <div class="admin-login-container">
        <div class="admin-login-box">
            <h1 class="admin-login-title">Admin Panel</h1>
            
            <?php if ($error): ?>
                <div class="admin-error-message">
                    <?php echo htmlspecialchars($error); ?>
                </div>
            <?php endif; ?>

            <form method="POST" class="admin-login-form">
                <div class="admin-form-group">
                    <label for="username" class="admin-label">Username</label>
                    <input 
                        type="text" 
                        id="username" 
                        name="username" 
                        class="admin-input" 
                        required 
                        autofocus
                    >
                </div>

                <div class="admin-form-group">
                    <label for="password" class="admin-label">Password</label>
                    <input 
                        type="password" 
                        id="password" 
                        name="password" 
                        class="admin-input" 
                        required
                    >
                </div>

                <button type="submit" class="admin-btn-primary">Login</button>
            </form>

            <p class="admin-login-hint">
                Default credentials: admin / admin123
            </p>
        </div>
    </div>
</body>
</html>
