<?php include "./templates/header.php";?>

<body>
	<form action="/php/reg_back.php" method="post">
		<input placeholder="Username" type="text" name="username" required>
		<input placeholder="Email Address" type="email" name="email" required>
		<input placeholder="Password" type="password"
			title="Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters" name="password" required>
		<input placeholder="Confirm Password" type="password" name="password2" required>
		<input type="submit" name="submit" value="Submit">
	</form>
</body>

<?php include "./templates/footer.php"; ?>
