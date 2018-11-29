<?php include "./templates/header.php"; ?>

<body>
	<form action="../php/login_back.php" method="post">
		<input placeholder="Username" type="text" name="username" required>
		<input placeholder="Password" type="password" name="password" required>
		<input type="submit" name="submit" value="Submit">
		<a href="./reset_pass.php" class="has-text-dark">reset password</a>
	</form>
	<?php
		if ($_GET["login"])
			echo "<p>Incorrect Username/Password</p>";
		if ($_GET["message"])
			echo sprintf("<p>%s</p>", $_GET["message"]);
	?>
</body>

<?php include "templates/footer.php"; ?>