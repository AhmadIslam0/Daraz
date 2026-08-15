<?php
// api/user.php - Session Status Endpoint for Daraz

header('Content-Type: application/json');
session_start();

if (isset($_SESSION['user_id']) && !empty($_SESSION['user_id'])) {
    echo json_encode([
        'logged_in' => true,
        'user' => [
            'id' => $_SESSION['user_id'],
            'username' => $_SESSION['username'],
            'email' => $_SESSION['email']
        ]
    ]);
} else {
    echo json_encode([
        'logged_in' => false
    ]);
}
?>
