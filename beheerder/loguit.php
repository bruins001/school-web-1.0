<?php
// Destroy's session.
session_start();
session_destroy();

// Redirects user
header("Location: index.php");
?>