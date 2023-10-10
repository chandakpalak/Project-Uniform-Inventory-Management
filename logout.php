<?php
session_start();

// Clear the session data
session_unset();
session_destroy();

// Redirect to the login page
header('Location: login.html');
exit();
?>
