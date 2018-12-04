<?php include "./templates/header.php";?>

<body>
	<form action="/php/reg_back.php" method="post">
		<input placeholder="Username" type="text" name="username" required>
		<input placeholder="Email Address" type="email" name="email" required>
		<input placeholder="Password" type="password"
			pattern="^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$%^&*-]).{8,}$"
			title="Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters" name="password" required>
		<input placeholder="Confirm Password" type="password" name="password2" required>
		<input type="submit" name="submit" value="Submit">
	</form>
	<?php
        if ($_GET["message"] == "username") {
            echo "<h1 class='has-text-centered is-size-3 land'>Username already taken</h1>";
        }
        else if ($_GET["message"] == "email") {
            echo "<h1 class='has-text-centered is-size-3 land'>Email already taken</h1>";
		}
		else if ($_GET["message"] == "password") {
            echo "<h1 class='has-text-centered is-size-3 land'>Passewords do not match</h1>";
        }
    ?>
</body>

<?php include "./templates/footer.php"; ?>
<style>footer {position: fixed;}</style>
