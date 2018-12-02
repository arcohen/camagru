<?php

include "./database.php";

try {
    $conn = new PDO($DB_DSN, $DB_USER, $DB_PASSWORD);
    $conn->setAttribute(PDO::ERRMODE_EXCEPTION);
    echo "Connected successfully"; 
    }
catch(PDOException $e)
    {
    echo "Connection failed: " . $e->getMessage();
    die();
    }

$sql = "CREATE DATABASE IF NOT EXISTS camagru";
$conn->exec($sql);
$sql = "USE camagru";
$conn->exec($sql);

$user_table = "CREATE TABLE IF NOT EXISTS `users` (
    `id` int(5) PRIMARY KEY AUTO_INCREMENT NOT NULL,
    `username` VARCHAR(25) NOT NULL,
    `email` VARCHAR(50) NOT NULL,
    `password` VARCHAR(255) NOT NULL,
    `ver_code` VARCHAR(255) NOT NULL,
    `verified` BOOLEAN NOT NULL DEFAULT '0',
    `comment` BOOLEAN NOT NULL DEFAULT '1'
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8";

$conn->exec($user_table);

$reset_password = "CREATE TABLE IF NOT EXISTS `password_reset` (
    `id` INT(11) PRIMARY KEY AUTO_INCREMENT NOT NULL,
    `email` VARCHAR(255) NOT NULL,
    `selector` VARCHAR(255) NOT NULL,
    `token` VARCHAR(255) NOT NULL,
    `expires` BIGINT(20) NOT NULL
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8";

$conn->exec($reset_password);

$image_table = "CREATE TABLE IF NOT EXISTS `images` (
    `id` INT(11) PRIMARY KEY AUTO_INCREMENT NOT NULL,
    `username` VARCHAR(255) NOT NULL,
    `img` MEDIUMTEXT NOT NULL
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8";

$conn->exec($image_table);

$comment_table = "CREATE TABLE IF NOT EXISTS `comments` (
    `id` INT(11) PRIMARY KEY AUTO_INCREMENT NOT NULL,
    `img_id` VARCHAR(255) NOT NULL,
    `username` MEDIUMTEXT NOT NULL,
    `comment` VARCHAR(255)
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8";

$conn->exec($comment_table);

header('Location: ../index.php');
?>