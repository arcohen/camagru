<?php

    include "../config/connection.php";
    session_start();

    if (isset($_SESSION['username']))
    {
        $stmt = $conn->prepare("SELECT * FROM likes WHERE username = ? AND img_id = ?");
        $stmt->execute([$_SESSION["username"], $_POST["id"]]);
        if ($stmt->rowCount() == 0)
        {
            $stmt = $conn->prepare("INSERT INTO likes (username, img_id) VALUES (?, ?)");
            $stmt->execute([$_SESSION["username"], $_POST["id"]]);
            header("Location: /public/gallery.php");            
        }
        else
            header("Location: /public/gallery.php?commented=already");
    }
    else
        header("Location: /public/login.php?like=login");
?>

