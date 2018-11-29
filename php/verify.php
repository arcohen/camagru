<?php

include "../config/connection.php";

$email = $_GET["email"];
$ver_code = $_GET["verification"];

$stmt = $conn->prepare("SELECT * FROM users WHERE email=?");
$stmt->execute([$email]);
$result = $stmt->fetch(PDO::FETCH_ASSOC);

if ($ver_code == $result["ver_code"]) {
    $stmt = $conn->prepare("UPDATE users SET verified=1 WHERE email=?");
    $stmt->execute([$email]);
    header("Location: /public/login.php?done=done.");
}
else
    echo "Error please go back";

?>