<?php

if (isset($_POST["submit"])) {
    include "../config/connection.php";
    session_start();

    if (isset($_SESSION['username'])) {
        $stmt = $conn->prepare("INSERT INTO comments (img_id, username, comment) VALUES (?, ?, ?)");
        $stmt->execute([$_POST["img_id"], $_SESSION["username"], $_POST["comment"]]);
        header("Location: /public/gallery.php");
    } else {
        header("Location: /public/login.php?comment=comment");
    }
}

?>