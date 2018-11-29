<?php include "./templates/header.php"; ?>

<body>
    <?php
        if ($_GET["reset"] == "sent") {
            echo "<h1 class='has-text-centered is-size-3 land'>Please check email to reset password</h1>";
        }
        else if ($_GET["reset"] == "reset") {
            echo "<h1 class='has-text-centered is-size-3 land'>Password Reset</h1>";
        }
        else if ($_GET["reset"] == "email") {
            echo "<h1 class='has-text-centered is-size-3 land'>Email Updated</h1>";
        }
        else if ($_GET["reset"] == "username") {
            echo "<h1 class='has-text-centered is-size-3 land'>Username Updated</h1>";
        }
    ?>
</body>

<?php include "templates/footer.php"; ?>