
<?php
session_start(); // must be first
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $adminEmail = "admin@tlib.com";
  $adminPassword = "admin123";
  $failure = false;  // If we have no POST data
if ( isset($_POST['email']) && isset($_POST['password']) ) {
    if ( strlen($_POST['email']) < 1 || strlen($_POST['password']) < 1 ) {
        $failure = "User name and password are required";
    } else {
        if ( $_SESSION['email'] == $_POST['email'] && $_SESSION['password'] == $_POST['password']) {
            if($_POST['email'] == $adminEmail && $_POST['password'] == $adminPassword){
              header("Location: admin_home.php")
            }
            header("Location: home.php")
        } else {
            $failure = "Incorrect username or password";
        }
    }
}
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

