<?php
include "./templates/header.php";
if (isset($_SESSION['username']) == NULL)
    header('Location: /public/login.php/?access=no');
?>

<body>
    <h1 id="a_head" class="has-text-centered is-size-3"><?php echo $_SESSION["username"] ?>'s account</h1>
   
    <form class="has-text-centered" action="/php/account_reset.php" method="post">
		<input placeholder="Old Password" type="password" name="old_p" required>
        <input placeholder="New Password" type="password" name="new_p" 
            pattern="^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$%^&*-]).{8,}$"  
            title="Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters" required>
		<input type="submit" name="submit" value="Submit">
    </form>
    <?php
        if ($_GET["message"] == "incorrect") {
            echo "<h2 class='has-text-centered is-size-4'>Incorrect password</h2>";
        }
    ?>
    
    <form class="has-text-centered f_acc" action="/php/account_reset.php" method="post">
        <input placeholder="New Email" type="email" name="new_email" required>
		<input placeholder="Password" type="password" name="old_p" required>
        <input type="submit" name="submit_email" value="Submit">
    </form>
    <?php
        if ($_GET["message"] == "email") {
            echo "<h2 class='has-text-centered is-size-4'>Email already in use</h2>";
        }
    ?>
   
   <form class="has-text-centered f_acc" action="/php/account_reset.php" method="post">
        <input placeholder="New Username" type="text" name="new_username" required>
		<input placeholder="Password" type="password" name="old_p" required>
        <input type="submit" name="submit_username" value="Submit">
    </form>
    <?php
        if ($_GET["message"] == "username") {
            echo "<h2 class='has-text-centered is-size-4'>Username already in use</h2>";
        }
    ?>
    <form class="has-text-centered f_acc" action="/php/account_reset.php" method="post">
        <input type="radio" name="comment" value=1> Email comments<br>
        <input type="radio" name="comment" value=0> Do not email comments<br>
        <input type="submit" name="submit_comment" value="Submit">
    </form>
    <?php
        if ($_GET["message"] == "comment") {
            echo "<h2 class='has-text-centered is-size-4'>Comment settings updated</h2>";
        }
    ?>
    <form class="has-text-centered f_acc delete_button" action="/php/account_reset.php" method="post">
        <input placeholder="Password" type="password" name="old_p" required>
        <input type="submit" name="delete" value="Delete Account">
    </form>
</body>

<?php include "templates/footer.php"; ?>