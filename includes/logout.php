<?php
// Kill session
session_start();
session_unset();
session_destroy();

// Remove the cookie
setcookie("cookie_name", "", time() - 3600, "/"); // Replace "cookie_name" with the actual cookie name

header("Location: ../index.php");
?>
