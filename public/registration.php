<?php include "./templates/header.php";

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

	if ($_POST["password"] == $_POST["password2"])
	{
		if ($est->rowcount() == 0)
		{
			if ($stmt->rowcount() == 0)
			{
				$stmt = $conn->prepare("INSERT INTO users (username, email, password) 
										VALUES (:username, :email, :password)");
				$stmt->bindParam(":username", $username);
				$stmt->bindParam(":email", $email);
				$stmt->bindParam(":password", $password);
		
				$username = $_POST["username"];
				$email = $_POST["email"];
				$password = password_hash($_POST["password"], PASSWORD_DEFAULT);

				$stmt->execute();
				echo "Successfully logged in";
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

<body>
	<form action="./registration.php" method="post">
		<input placeholder="Username" type="text" name="username" required>
		<input placeholder="Email Address" type="email" name="email" required>
		<input placeholder="Password" type="password" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" 
			title="Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters" name="password" required>
		<input placeholder="Confirm Password" type="password" name="password2" required>
		<input type="submit" name="submit" value="Submit">
	</form>
</body>
</html>