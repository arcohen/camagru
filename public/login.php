<?php include "./templates/header.php"; ?>

<body>
	<form class="has-text-centered" action="../php/login_back.php" method="post">
		<input placeholder="Username" type="text" name="username" required>
		<input placeholder="Password" type="password" name="password" required>
		<input type="submit" name="submit" value="Login">
		<a href="./reset_pass.php" class="has-text-dark">reset password</a>
	</form>
	<?php
		if ($_GET["login"])
			echo "<h1 class='has-text-centered is-size-4'>Incorrect Username/Password</h1>";
		else if ($_GET["message"])
			echo "<h1 class='has-text-centered is-size-4'>Successfully submitted. Please check email to complete sign up</h1>";
		else if ($_GET["done"])
			echo "<h1 class='has-text-centered is-size-4'>Your account has been verified. Please log in</h1>";
		else if ($_GET["reset"])
			echo "<h1 class='has-text-centered is-size-4'>Password Reset Please Login</h1>";
		else if ($_GET["access"])
			echo "<h1 class='has-text-centered is-size-4'>Please log in to access this page</h1>";
		else if ($_GET["comment"])
			echo "<h1 class='has-text-centered is-size-4'>Please log in to comment</h1>";
		else if ($_GET["delete"])
			echo "<h1 class='has-text-centered is-size-4'>Please log in to delete photos</h1>";
		else if ($_GET["like"])
			echo "<h1 class='has-text-centered is-size-4'>Please log in to like photos</h1>";
	?>
</body>

<?php include "templates/footer.php"; ?>