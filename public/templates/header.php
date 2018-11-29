<!doctype html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta http-equiv="x-ua-compatible" content="ie=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<title>Camagru</title>

	<link rel="stylesheet" href="/css/bulma.css">
    <link rel="stylesheet" href="/css/style.css">
</head>

<nav class="navbar is-transparent nav-top">
  <div class="navbar-brand">
    <a class="navbar-item" href="/index.php">CAMAGRU</a>
  </div>

  <div id="navbarBasicExample" class="navbar-menu">
    
    <div class="navbar-end">
      <div class="navbar-item">
		<a class="navbar-item" href="#">Take Photo</a>
		<a class="navbar-item" href="#">Gallery</a>
		<a class="navbar-item" href="#">Account</a>
        <div class="buttons">
          <a class="button is-medium is-outlined is-primary" href="/public/registration.php"><strong>Sign up</strong></a>
          <a id="loginout" class="button is-medium is-outlined is-success"
            <?php
                session_start();
                if ($_SESSION["username"])
                    echo 'href="/php/logout_back.php">Log out</a>';
                else
                    echo 'href="/public/login.php">Log in</a>';
            ?>
        </div>
      </div>
    </div>

  </div>
</nav>