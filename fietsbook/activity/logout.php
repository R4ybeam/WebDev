<?php
session_set_cookie_params(['secure' => true, 'httponly' => true]);
session_start();

// Regenerate session ID
session_regenerate_id(true);

// Unset specific session variables
unset($_SESSION['user_id'], $_SESSION['username']);

// Destroy the session
session_destroy();

// Set a logout message
$_SESSION['logout_message'] = "You have been successfully logged out.";

// Redirect to the login page
header("Location: ./login/");
exit();
?>