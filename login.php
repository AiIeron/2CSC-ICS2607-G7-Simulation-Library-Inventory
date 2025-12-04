
<?php
session_start();

$adminEmail = "admin@tlib.com";
$adminPassword = "admin123";
$failure = false;
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $email = $_POST['email'];
    $password = $_POST['password'];
    if ($email === $adminEmail && $password === $adminPassword) {
        header("Location: admin_home.php");
        exit;
    }
    if (isset($_SESSION['users'])) {
        foreach ($_SESSION['users'] as $user) {
            if ($user['email'] === $email && $user['password'] === $password) {
                header("Location: home.php");
                exit;
            }
        }
    }
    $failure = "Incorrect username or password";
}
?>
<!doctype html>
<html>
<head><meta charset="utf-8"><title>Truthary Lib | Login</title></head>
<body>
<h2>Login</h2>

<!-- Don't forget to add the errror text here..-->

<form method="post" action="login.php">
  <label>Email:<br><input type="email" name="email" required></label><br><br>
  <label>Password:<br><input type="password" name="password" required></label><br><br>
  <button type="submit">Login</button>
  <?php
if ( $failure !== false ) {
    echo'<p style="color: red;">'.htmlentities($failure)."</p>\n";
}
?>
</form>
<p><a href="register.php">Create Account</a></p>
</body>

</html>



