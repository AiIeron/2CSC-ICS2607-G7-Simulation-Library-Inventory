$adminEmail = "admin@tlib.com";
$adminPassword = "admin123";



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
</form>
<p><a href="register.php">Create Account</a></p>
</body>
</html>