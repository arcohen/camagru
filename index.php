<?php include "public/templates/header.php"; ?>

<body>
	<section class="section is-medium hero">
		<div class="container has-text-right">
			<div class="columns">
				<div class="column is-half">
					<?php
						if ($_GET["login"]) {
							echo "<h1 class='has-text-centered is-size-3'>Successfully Logged In</h1>";
						}
						else if ($_GET["reset"]) {
							echo "<h1 class='has-text-centered is-size-3'>Please check email to reset password</h1>";
						}
					?>
				</div>
				<div class="column is-half">
					<h1 class="title has-text-gray-darker has-font-weight-bold has-text-centered is-size-2 main-thing">Cam | agru</h1>
					<h2 class="subtitle has-text-gray-dark has-text-centered is-size-4 main-thing">Your photo sharing App</h2>
				</div>
			</div>
		</div>
	</section>
</body>
<?php include "public/templates/footer.php"; ?>

<style>footer {position: fixed;}</style>