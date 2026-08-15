<?php
// api/login.php - Login Backend Endpoint for Daraz

header('Content-Type: application/json');
session_start();

require_once __DIR__ . '/../config/db.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    echo json_encode(['success' => false, 'message' => 'Invalid request method.']);
    exit;
}

$inputRaw = file_get_contents('php://input');
$data = json_decode($inputRaw, true);

if (!$data) {
    $data = $_POST;
}

$loginInput = isset($data['email']) ? trim($data['email']) : (isset($data['username']) ? trim($data['username']) : '');
$password = isset($data['password']) ? $data['password'] : '';

if (empty($loginInput)) {
    echo json_encode(['success' => false, 'message' => 'Please enter your Phone, Email or Username.']);
    exit;
}

if (empty($password)) {
    echo json_encode(['success' => false, 'message' => 'Please enter your password.']);
    exit;
}

try {
    // Look up user by email or username
    $stmt = $pdo->prepare("SELECT * FROM users WHERE email = ? OR username = ? LIMIT 1");
    $stmt->execute([$loginInput, $loginInput]);
    $user = $stmt->fetch();

    if (!$user) {
        echo json_encode(['success' => false, 'message' => 'No account found with this email or username.']);
        exit;
    }

    // Verify password
    $passwordValid = password_verify($password, $user['password']);
    if (!$passwordValid && $password === $user['password']) {
        // Fallback for legacy plain text passwords if any exist
        $passwordValid = true;
    }

    if (!$passwordValid) {
        echo json_encode(['success' => false, 'message' => 'Incorrect password. Please try again.']);
        exit;
    }

    // Store session
    $_SESSION['user_id'] = $user['id'];
    $_SESSION['username'] = $user['username'];
    $_SESSION['email'] = $user['email'];

    echo json_encode([
        'success' => true,
        'message' => 'Logged in successfully!',
        'user' => [
            'id' => $user['id'],
            'username' => $user['username'],
            'email' => $user['email']
        ]
    ]);

} catch (PDOException $e) {
    echo json_encode(['success' => false, 'message' => 'Database error: ' . $e->getMessage()]);
}
?>
