<?php
// admin/config.php - Admin Panel Configuration & Authentication Check
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Require shared database configuration
require_once __DIR__ . '/../CSS-6-May/config/db.php';

// Helper function to resolve product image URLs for Admin Panel display
if (!function_exists('get_product_image_url')) {
    function get_product_image_url($image_path) {
        $image_path = trim($image_path ?? '');
        if (empty($image_path)) {
            return '../CSS-6-May/darazlogo.png';
        }
        if (preg_match('/^(https?:\/\/|data:|\/\/)/i', $image_path)) {
            return $image_path;
        }
        if (strpos($image_path, '../CSS-6-May/') === 0) {
            return $image_path;
        }
        $cleanPath = ltrim($image_path, '.');
        $cleanPath = ltrim($cleanPath, '/');
        
        if (strpos($cleanPath, 'CSS-6-May/') === 0) {
            return '../' . $cleanPath;
        }
        
        return '../CSS-6-May/' . $cleanPath;
    }
}

// Helper function to require admin authentication on protected pages
function require_admin_login() {
    if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
        header("Location: login.php");
        exit;
    }
}
?>

