<?php

include "../config/connection.php";
session_start();

if (isset($_POST["submit"])) 
{
    if ($_SESSION["username"]) {
        $stmt = $conn->prepare("SELECT * FROM users WHERE username=?");
        $stmt->execute([$_SESSION["username"]]);
        $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $result = $stmt->fetch();

        if (password_verify($_POST["old_p"], $result["password"])) {
            $stmt = $conn->prepare("UPDATE users SET password=? WHERE username=?");
            $password = password_hash($_POST["new_p"], PASSWORD_DEFAULT);
            $username = $_SESSION["username"];
            $stmt->execute([$password, $username]);
            header("Location: /public/landing.php?reset=reset");
        } else {
            header("Location: /public/account.php?message=incorrect");
        }
    }
}

else if (isset($_POST["submit_email"]))
{
    $stmt = $conn->prepare("SELECT * FROM users WHERE username=?");
    $stmt->execute([$_SESSION["username"]]);
    $stmt->setFetchMode(PDO::FETCH_ASSOC);
    $result = $stmt->fetch();

    if (password_verify($_POST["old_p"], $result["password"])) {
        $stmt = $conn->prepare("SELECT * FROM users WHERE email=?");
        $stmt->execute([$_POST["new_email"]]);

        if ($stmt->rowCount() == 0) {
            $stmt = $conn->prepare("UPDATE users SET email=? WHERE username=?");
            $stmt->execute([$_POST["new_email"], $_SESSION["username"]]);
            header("Location: /public/landing.php?reset=email");
        }
        else
            header("Location: /public/account.php?message=email");
    }
    else 
        header("Location: /public/account.php?message=incorrect");
}

else if (isset($_POST["submit_username"]))
{
    $stmt = $conn->prepare("SELECT * FROM users WHERE username=?");
    $stmt->execute([$_SESSION["username"]]);
    $stmt->setFetchMode(PDO::FETCH_ASSOC);
    $result = $stmt->fetch();

    if (password_verify($_POST["old_p"], $result["password"])) {
        $stmt = $conn->prepare("SELECT * FROM users WHERE username=?");
        $stmt->execute([$_POST["new_username"]]);

        if ($stmt->rowCount() == 0) {
            $stmt = $conn->prepare("UPDATE users SET username=? WHERE username=?");
            $stmt->execute([$_POST["new_username"], $_SESSION["username"]]);
            $_SESSION["username"] = $_POST["new_username"];
            header("Location: /public/landing.php?reset=username");
        }
        else
            header("Location: /public/account.php?message=incorrect");
    }
    else 
        header("Location: /public/account.php?message=incorrect");
}

else if (isset($_POST["submit_comment"]))
{
    $stmt = $conn->prepare("UPDATE users SET comment=? WHERE username=?");
    $stmt->execute([$_POST["comment"], $_SESSION["username"]]);
    header("Location: /public/account.php?message=comment");
}

else if (isset($_POST["delete"])) {
    $stmt = $conn->prepare("DELETE FROM users WHERE username=?");
    $stmt->execute([$_SESSION["username"]]);
    session_destroy();
    header("Location: /index.php");
}


?>