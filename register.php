<!doctype html>
<html>
<head><meta charset="utf-8"><title>Truthary Lib | Register</title></head>
<body>
<h2>Create Account (Student)</h2>

<!-- Don't forget to add the errror text here..-->

<form method="post" action="register.php">
  <label>First Name:<br><input type="text" name="fname" required></label><br><br>
  <label>Surname:<br><input type="text" name="lname" required></label><br><br>
  <label>Student ID:<br><input type="text" name="id" required></label><br><br>
  <label>Phone No.:<br><input type="text" name="phone"></label><br><br>         
  <label>Email:<br><input type="email" name="email" required></label><br><br>
  <label>Password:<br><input type="password" name="password" required></label><br><br>
  <label>Confirm Password:<br><input type="password" name="password2" required></label><br><br>
  <button type="submit">Create Account</button>
</form>
<p><a href="login.php">Back to login</a></p>
</body>
</html>