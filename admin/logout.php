<?php
session_start();

// 1. Clear all session variables
$_SESSION = array();

// 2. Delete the session cookie from browser ← THIS IS THE KEY PART
if (ini_get("session.use_cookies")) {
    setcookie(session_name(), '', time() - 3600, '/');
}

// 3. Destroy the session on server
session_destroy();




// 4. Redirect to login
header('Location: ../login.php');
exit();
?>