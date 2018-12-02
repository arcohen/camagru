<!doctype html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta http-equiv="x-ua-compatible" content="ie=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">

  <title>Camagru</title>
  <link rel="shortcut icon" href="/img/favicon-32x32.png" type="image/png">

  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">
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
		<a class="navbar-item" href="/public/photo.php">Take Photo</a>
		<a class="navbar-item" href="/public/gallery.php">Gallery</a>
        <div class="buttons">
          <a class="button is-medium is-outlined is-primary"
          <?php
              session_start();
              if ($_SESSION["username"])
                echo 'href="/public/account.php"><strong>Account</strong></a>';
              else
                echo 'href="/public/registration.php"><strong>Sign up</strong></a>';
          ?>
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
  <div id="container"> 