<?php

$DB_DSN = "mysql:host=localhost;dbname=camagru";
$DB_USER = "root";
$DB_PASSWORD = "wethinkcode";

try {
    $conn = new PDO($DB_DSN, $DB_USER, $DB_PASSWORD);
    $conn->setAttribute(PDO::ERRMODE_EXCEPTION);
    }
catch(PDOException $e)
    {
    echo "Connection failed: " . $e->getMessage();
    }
