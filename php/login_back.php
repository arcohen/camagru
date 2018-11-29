<?php

if (isset($_POST["submit"])) {
	session_start();
	include "../config/connection.php";

	$stmt = $conn->prepare("SELECT * FROM users WHERE username=:username");
	$stmt->bindParam(":username", $username);
	$username = $_POST["username"];
	$stmt->execute();

	if ($stmt->rowCount() == 1)
	{
		$stmt->setFetchMode(PDO::FETCH_ASSOC);
		$result = $stmt->fetch();
		if (password_verify($_POST["password"], $result["password"]) && $result["verified"])
		{
			echo "login successful";
            $_SESSION["username"] = $username;
            header("Location: /index.php?login=login");
		}
        else {
            echo "incorrect username/password";
            header("Location: /public/login.php?login=error");
        }
        
	}
    else {
        echo "incorrect username/password";
        header("Location: /public/login.php?login=error");
    }
}

?>