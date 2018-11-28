<?php include "./templates/header.php";
if (isset($_POST["submit"])) {
	include "../config/connection.php";

	$stmt = $conn->prepare("SELECT * FROM users WHERE username=:username");
	$stmt->bindParam(":username", $username);
	$username = $_POST["username"];
	$stmt->execute();

	if ($stmt->rowCount() == 1)
	{
		$stmt->setFetchMode(PDO::FETCH_ASSOC);
		$result = $stmt->fetch();
		if (password_verify($_POST["password"], $result["password"]))
		{
			echo "login successful";
		}
		else
			echo "incorrect username/password";
	}
	else
		echo "incorrect username/password"; 
}

?>

<body>
	<form method="post">
		<input placeholder="Username" type="text" name="username" required>
		<input placeholder="Password" type="password" name="password" required>
		<input type="submit" name="submit" value="Submit">
		<a href="./reset_pass.php" class="has-text-dark">reset password</a>
	</form>
</body>