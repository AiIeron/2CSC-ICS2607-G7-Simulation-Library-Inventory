<?php
session_start(); // must be first

require "db.php";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $_SESSION['email'] = $_POST['email'];
  $_SESSION['password'] = $_POST['password'];
}
$s_id = $_POST['id'];
$s_fn = $_POST['fname'];
$s_ln = $_POST['lname'];
$s_pn = $_POST['phone'];
$s_email = $_POST['email'];

$query = "INSERT INTO student (STUDENT_ID, STU_FNAME, STU_LNAME, STU_PHONE_NUM, STU_EMAIL)
VALUES ('$s_id', '$s_fn', '$s_ln', '$s_pn', '$s_email')";

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


if(mysqli_query($conn, $query)){
    echo;
}
else{
    echo "Error!: {$conn -> error}";
}

$conn->close();  
?>

<!DOCTYPE html>  
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
  <button type="submit" name="register" value="register">Register</button>
  <button type="submit" name="register" value="register">Register</button>
</form>
<p><a href="login.php">Back to login</a></p>
</body>
</html>



