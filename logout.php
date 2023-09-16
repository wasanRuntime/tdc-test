<?php
session_start();
session_destroy(); // Destroy the session data.
header('Location: index.php'); // Redirect to the homepage.
exit();
?>
