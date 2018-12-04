<?php
include "./templates/header.php";

if ($_POST["submit"] == "Submit") {
    include "../config/connection.php";

    $selector = $_POST["selector"];
    $validator = $_POST["validator"];
    $email = $_POST["email"];

    $stmt = $conn->prepare("SELECT * FROM password_reset WHERE email=:email");
    $stmt->bindParam(":email", $email);
    $stmt->execute();
	$stmt->setFetchMode(PDO::FETCH_ASSOC);    
    $result = $stmt->fetch();

    if ($result["selector"] == $selector && password_verify($validator, $result["token"])) {
        if ($result["expires"] > time()) {
            $stmt = $conn->prepare("UPDATE users SET password=? WHERE email=?");
            if ($stmt->execute([password_hash($_POST["password"], PASSWORD_DEFAULT), $email])) {
                $stmt = $conn->prepare("DELETE FROM password_reset WHERE email=?");
                $stmt->execute([$email]);
                header("Location: /public/login.php?reset=reset");
            }
            else
                echo "Something went wrong";
            }
        else
            echo "Reset Link has Expired";
    }
    else
        echo "Incorrect Validation Info";
}

$selector = filter_input(INPUT_GET, 'selector');
$validator = filter_input(INPUT_GET, 'validator');
$email = filter_input(INPUT_GET, 'email');

if (false !== ctype_xdigit($selector) && false !== ctype_xdigit($validator)):
?>
        <form action="reset.php" method="post">
            <input type="hidden" name="selector" value="<?php echo $selector; ?>">
            <input type="hidden" name="validator" value="<?php echo $validator; ?>">
            <input type="hidden" name="email" value="<?php echo $email; ?>">
            <input placeholder="Password" type="password" pattern="^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$%^&*-]).{8,}$"  
                title="Must contain at least one number and one uppercase and lowercase letter, and 
                at least 8 or more characters" name="password" required>
            <input type="submit" name="submit" value="Submit">
        </form>
        <?php include "./templates/footer.php"; ?>
<?php endif; ?>

<style>footer {position: fixed;}</style>