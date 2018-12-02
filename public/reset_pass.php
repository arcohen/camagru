<?php

if ($_SESSION['username'] == NULL)
    header('Location: /public/login.php/?access=no');

include "./templates/header.php";

function reset_email($email, $conn) {

	$selector = bin2hex(random_bytes(8));
	
	$token = bin2hex(random_bytes(32));
	$token_encrypt = password_hash($token, PASSWORD_DEFAULT);
	
	$url = sprintf('%sreset.php?%s', "http://localhost:8080/public/", http_build_query([
		'selector' => $selector,
		'validator' => $token,
		'email' => $email
	]));

	$expires = new DateTime("NOW");
	$expires->add(new DateInterval("PT01H"));
	$expires = $expires->format('U');

	$stmt = $conn->prepare("DELETE FROM password_reset WHERE email=:email");
	$stmt->bindParam(":email", $s_email);
	$s_email = $email;
	$stmt->execute();
	
	$stmt = $conn->prepare("INSERT INTO password_reset (email, selector, token, expires)
							VALUES (:email, '$selector', '$token_encrypt', '$expires')");
	$stmt->bindParam(":email", $t_email);
	$t_email = $email;

	$stmt->execute();


	return ($url);
};

function send_email($email, $username, $url) {

	$message = "Hi " . $username;
	$message .= "\n\nYou requested a password reset from Camagru.";
	$message .= "\n\nClick on the following link to reset password:\n";
	$message .= sprintf('%s', $url);

	$message = wordwrap($message, 70);

	$headers = "From: Camagru\r\n";
	$headers .= "Reply-To: noreply@camagru.com\r\n";
	$headers .= "Return-Path: no-reply@camagru.com\r\n";

	mail($email, "Password Reset", $message, $headers);
}

if (isset($_POST["submit"])) 
{
	include "../config/connection.php";

	$stmt = $conn->prepare("SELECT * FROM users WHERE email=:email");
	$stmt->bindParam(":email", $email);
	$email = $_POST["email"];
    $stmt->execute();
	
	$stmt->setFetchMode(PDO::FETCH_ASSOC);
	$result = $stmt->fetch();

	if ($stmt->rowCount() == 1) {
		$url = reset_email($email, $conn);
		send_email($email, $result[username], $url);
		header("Location: /public/landing.php?reset=sent");
	}
    else
        echo "email address not found";
}
?>

<body>
	<form method="post">
		<input placeholder="Email" type="email" name="email" required>
		<input type="submit" name="submit" value="Submit">
	</form>
</body>

<?php include "./templates/footer.php"; ?>