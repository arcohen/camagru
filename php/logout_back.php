<?php 
    session_start(); $_SESSION["username"] = NULL; session_destroy();
    header("Location: /public/logout.php");
?>
