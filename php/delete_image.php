<?php

    include "../config/connection.php";
    session_start();
    
    if (isset($_SESSION['username'])) {
        if ($_POST['username'] == $_SESSION['username']) {
            
            $stmt = $conn->prepare('DELETE FROM images WHERE id = ?');
            $stmt->execute([$_POST["id"]]);

            $stmt = $conn->prepare('DELETE FROM comments WHERE img_id = ?');
            $stmt->execute([$_POST["id"]]);

            header('Location: /public/gallery.php');

        } else {
            header("Location: /public/gallery.php?");
        }
    } 
    else
        header("Location: /public/login.php?delete=delete");

?>