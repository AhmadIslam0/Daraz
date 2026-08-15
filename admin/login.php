<?php
// admin/login.php - Professional Admin Authentication Page
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

require_once __DIR__ . '/../CSS-6-May/config/db.php';

// If already authenticated, redirect directly to Admin Dashboard
if (isset($_SESSION['admin_logged_in']) && $_SESSION['admin_logged_in'] === true) {
    header("Location: index.php");
    exit;
}

$error = '';
$emailInput = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $emailInput = trim($_POST['email'] ?? '');
    $passwordInput = trim($_POST['password'] ?? '');

    if (empty($emailInput) || empty($passwordInput)) {
        $error = 'Please enter both email address and password.';
    } else {
        try {
            // Check admin credentials against database
            $stmt = $pdo->prepare("SELECT * FROM admins WHERE email = ? OR username = ? LIMIT 1");
            $stmt->execute([$emailInput, $emailInput]);
            $admin = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($admin && password_verify($passwordInput, $admin['password'])) {
                // Successful Login - Store Admin Session
                $_SESSION['admin_logged_in'] = true;
                $_SESSION['admin_id'] = $admin['id'];
                $_SESSION['admin_name'] = $admin['full_name'];
                $_SESSION['admin_username'] = $admin['username'];
                $_SESSION['admin_email'] = $admin['email'];

                // Redirect directly to Admin Dashboard
                header("Location: index.php");
                exit;
            } else {
                $error = 'Invalid email or password. Access denied.';
            }
        } catch (PDOException $e) {
            $error = 'System error: ' . $e->getMessage();
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login - Daraz E-Commerce Admin Panel</title>

    <!-- Google Fonts & FontAwesome 6.4.0 -->
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <!-- Bootstrap 5.3 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        :root {
            --primary-orange: #f57224;
            --primary-orange-hover: #d85c12;
            --dark-navy: #0f172a;
            --card-navy: #1e293b;
            --accent-blue: #3b82f6;
        }

        body {
            font-family: 'Plus Jakarta Sans', -apple-system, BlinkMacSystemFont, sans-serif;
            background: radial-gradient(circle at 50% 0%, #1e293b 0%, #0f172a 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0;
            padding: 1.5rem;
            color: #f8fafc;
        }

        .login-wrapper {
            width: 100%;
            max-width: 440px;
        }

        .brand-header {
            text-align: center;
            margin-bottom: 2rem;
        }

        .brand-icon-box {
            width: 64px;
            height: 64px;
            background: linear-gradient(135deg, var(--primary-orange) 0%, #ff8c42 100%);
            border-radius: 18px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            font-size: 1.75rem;
            color: #ffffff;
            box-shadow: 0 10px 25px rgba(245, 114, 36, 0.35);
            margin-bottom: 1rem;
        }

        .brand-title {
            font-weight: 800;
            font-size: 1.6rem;
            letter-spacing: -0.02em;
            color: #ffffff;
            margin: 0;
        }

        .brand-subtitle {
            font-size: 0.875rem;
            color: #94a3b8;
            margin-top: 0.25rem;
        }

        .login-card {
            background-color: var(--card-navy);
            border: 1px solid rgba(255, 255, 255, 0.08);
            border-radius: 1.25rem;
            padding: 2.25rem 2rem;
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.4);
            backdrop-filter: blur(10px);
        }

        .form-label {
            font-weight: 600;
            font-size: 0.825rem;
            color: #cbd5e1;
            margin-bottom: 0.5rem;
        }

        .custom-input-group {
            position: relative;
            margin-bottom: 1.25rem;
        }

        .custom-input-group .input-icon {
            position: absolute;
            left: 1rem;
            top: 50%;
            transform: translateY(-50%);
            color: #64748b;
            font-size: 1rem;
            transition: color 0.2s;
            z-index: 5;
        }

        .custom-input-group .form-control {
            background-color: #0f172a;
            border: 1.5px solid #334155;
            color: #f8fafc;
            border-radius: 0.75rem;
            padding: 0.8rem 1rem 0.8rem 2.75rem;
            font-size: 0.9rem;
            transition: all 0.2s ease;
        }

        .custom-input-group .form-control:focus {
            background-color: #0f172a;
            border-color: var(--primary-orange);
            box-shadow: 0 0 0 4px rgba(245, 114, 36, 0.15);
            color: #ffffff;
        }

        .custom-input-group .form-control::placeholder {
            color: #475569;
        }

        .password-toggle-btn {
            position: absolute;
            right: 0.75rem;
            top: 50%;
            transform: translateY(-50%);
            background: none;
            border: none;
            color: #64748b;
            cursor: pointer;
            padding: 0.25rem 0.5rem;
            font-size: 0.95rem;
            z-index: 5;
            transition: color 0.2s;
        }

        .password-toggle-btn:hover {
            color: #f8fafc;
        }

        .btn-submit-admin {
            background: linear-gradient(135deg, var(--primary-orange) 0%, var(--primary-orange-hover) 100%);
            border: none;
            color: #ffffff;
            font-weight: 700;
            font-size: 0.95rem;
            padding: 0.85rem 1.5rem;
            border-radius: 0.75rem;
            width: 100%;
            box-shadow: 0 8px 20px rgba(245, 114, 36, 0.3);
            transition: all 0.2s ease;
            margin-top: 0.5rem;
        }

        .btn-submit-admin:hover {
            background: linear-gradient(135deg, #ff843d 0%, var(--primary-orange) 100%);
            transform: translateY(-1px);
            box-shadow: 0 12px 24px rgba(245, 114, 36, 0.4);
            color: #ffffff;
        }

        .btn-submit-admin:active {
            transform: translateY(0);
        }

        .error-alert {
            background-color: rgba(239, 68, 68, 0.12);
            border: 1px solid rgba(239, 68, 68, 0.3);
            color: #fca5a5;
            border-radius: 0.75rem;
            padding: 0.85rem 1rem;
            font-size: 0.85rem;
            margin-bottom: 1.25rem;
            display: flex;
            align-items: center;
            gap: 0.6rem;
        }

        .footer-link {
            text-align: center;
            margin-top: 1.75rem;
        }

        .footer-link a {
            color: #94a3b8;
            text-decoration: none;
            font-size: 0.825rem;
            transition: color 0.2s;
        }

        .footer-link a:hover {
            color: var(--primary-orange);
        }
    </style>
</head>
<body>

    <div class="login-wrapper">
        <!-- Header Logo & Branding -->
        <div class="brand-header">
            <div class="brand-icon-box">
                <i class="fa-solid fa-shield-halved"></i>
            </div>
            <h1 class="brand-title">Daraz Admin</h1>
            <p class="brand-subtitle">Management System Authentication</p>
        </div>

        <!-- Login Card Container -->
        <div class="login-card">
            <?php if (!empty($error)): ?>
                <div class="error-alert">
                    <i class="fa-solid fa-circle-exclamation fs-6"></i>
                    <span><?php echo htmlspecialchars($error); ?></span>
                </div>
            <?php endif; ?>

            <form method="POST" action="login.php" autocomplete="off">
                <!-- Email Input Field -->
                <div class="mb-1">
                    <label for="email" class="form-label">Email Address</label>
                    <div class="custom-input-group">
                        <i class="fa-solid fa-envelope input-icon"></i>
                        <input type="email" class="form-control" id="email" name="email" placeholder="Enter admin email address" value="<?php echo htmlspecialchars($emailInput); ?>" required autofocus>
                    </div>
                </div>

                <!-- Password Input Field -->
                <div class="mb-2">
                    <label for="password" class="form-label">Password</label>
                    <div class="custom-input-group">
                        <i class="fa-solid fa-lock input-icon"></i>
                        <input type="password" class="form-control" id="password" name="password" placeholder="Enter password" required>
                        <button type="button" class="password-toggle-btn" id="togglePassword" title="Show/Hide Password">
                            <i class="fa-solid fa-eye" id="eyeIcon"></i>
                        </button>
                    </div>
                </div>

                <!-- Submit Button -->
                <button type="submit" class="btn btn-submit-admin">
                    Sign In to Dashboard <i class="fa-solid fa-arrow-right-to-bracket ms-2"></i>
                </button>
            </form>

            <div class="footer-link">
                <a href="../index.php">
                    <i class="fa-solid fa-arrow-left me-1"></i> Return to Daraz Store Website
                </a>
            </div>
        </div>
    </div>

    <!-- Password Visibility Toggle Script -->
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const passwordInput = document.getElementById('password');
            const togglePasswordBtn = document.getElementById('togglePassword');
            const eyeIcon = document.getElementById('eyeIcon');

            if (togglePasswordBtn && passwordInput && eyeIcon) {
                togglePasswordBtn.addEventListener('click', () => {
                    const isPassword = passwordInput.getAttribute('type') === 'password';
                    passwordInput.setAttribute('type', isPassword ? 'text' : 'password');
                    
                    if (isPassword) {
                        eyeIcon.classList.remove('fa-eye');
                        eyeIcon.classList.add('fa-eye-slash');
                    } else {
                        eyeIcon.classList.remove('fa-eye-slash');
                        eyeIcon.classList.add('fa-eye');
                    }
                });
            }
        });
    </script>
</body>
</html>
