<?php
// Daraz Online Shopping - PHP Entry Point
session_start();
require_once __DIR__ . '/config/db.php';

// Include existing frontend HTML without changing layout or design
include_once __DIR__ . '/index.html';
?>
