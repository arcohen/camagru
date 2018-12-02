<?php

if (isset($_POST["submit"])) {
    include "../config/connection.php";
    session_start();

    function send_email($username, $comment)
    {
        include "../config/connection.php";

        $message = "Hi " . $username;
        $message .= "\n\nYour photo on Camagru has received a new comment:";
        $message .= "\n\n" . $_SESSION["username"] . ": " . $comment;
        
        $message = wordwrap($message, 70);
        
        $headers = "From: Camagru\r\n";
        $headers .= "Reply-To: no-reply@camagru.com\r\n";
        $headers .= "Return-Path: no-reply@camagru.com\r\n";

        $stmt = $conn->prepare("SELECT * FROM users WHERE username = ?");
        $stmt->execute([$username]);
        $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $result = $stmt->fetch();
        
        if ($result["comment"] == 1)
            mail($result["email"], "Photo Comment", $message, $headers);
    }

    if (isset($_SESSION['username'])) {
        $stmt = $conn->prepare("INSERT INTO comments (img_id, username, comment) VALUES (?, ?, ?)");
        $stmt->execute([$_POST["img_id"], $_SESSION["username"], $_POST["comment"]]);
        $stmt = $conn->prepare("SELECT * FROM images WHERE id = ?");
        $stmt->execute([$_POST["img_id"]]);
		$stmt->setFetchMode(PDO::FETCH_ASSOC);
        $result = $stmt->fetch();
        send_email($result["username"], $_POST["comment"]);
        header("Location: /public/gallery.php");
    } else {
        header("Location: /public/login.php?comment=comment");
    }
}

?>