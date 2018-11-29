<?php

function send_mail($email, $username, $ver_code) {
    echo "beginning";
    $url = sprintf('%sverify.php?%s', "http://localhost:8080/php/", http_build_query([
		'email' => $email,
		'verification' => $ver_code,
	]));

	$message = "Hi " . $username;
	$message .= "\n\nYou signed up to Camagru.";
	$message .= "\n\nClick on the following link finish registration:\n";
	$message .= sprintf('%s', $url);

	$message = wordwrap($message, 70);

	$headers = "From: Camagru\r\n";
	$headers .= "Reply-To: noreply@camagru.com\r\n";
	$headers .= "Return-Path: no-reply@camagru.com\r\n";

    mail($email, "Account registration", $message, $headers);
}

if (isset($_POST["submit"])) {
    include "../config/connection.php";
    
	$stmt = $conn->prepare("SELECT * FROM users WHERE username=:username");
	$stmt->bindParam(":username", $user);
	$user = $_POST["username"];
	$stmt->execute();

	$est = $conn->prepare("SELECT * FROM users WHERE email=:email");
	$est->bindParam(":email", $eeemail);
	$eeemail = $_POST["email"];
    $est->execute();
    
    $ver_code = bin2hex(random_bytes(8));

	if ($_POST["password"] == $_POST["password2"])
	{
		if ($est->rowcount() == 0)
		{
			if ($stmt->rowcount() == 0)
			{
				$stmt = $conn->prepare("INSERT INTO users (username, email, password, ver_code) VALUES (?, ?, ?, ?)");
				$password = password_hash($_POST["password"], PASSWORD_DEFAULT);
                $stmt->execute([$_POST["username"], $_POST["email"], $password, $ver_code]);
                send_mail($_POST["email"], $_POST["username"], $ver_code);
				//header("Location: /public/login.php?message=Successfully submitted. Please check email to complete sign up");
			}
			else
				echo "username already taken";
		}
		else
			echo "email already taken";
	}
	else
		echo "passwords do not match";
}

?>