<?php
require "db.php";
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $pnum = $_POST['pnum'];
    $email = $_POST['email'];
    $id = $_POST['id'];
    $query = "INSERT INTO LIBRARIAN (LIB_ID, LIB_FNAME, LIB_LNAME, LIB_PHONE_NUM, LIB_EMAIL) 
                 VALUES ('$id', '$fname', '$lname', '$pnum', '$email')";
    $conn->query($query);
    echo "Librarian added successfully!";
}
?>
<!DOCTYPE html>  
<html>
<head><meta charset="utf-8"><title>Truthary Lib | add books</title></head>
<body>
<h2>Create Account (Student)</h2>

<!-- Don't forget to add the errror text here..-->

<form method="post" action="add_librarian.php">
    <h1> ADD LIBRARIAN </h1>
  <label>First Name:<br><input type="text" name="fname" required></label><br><br>
  <label>Last Name:<br><input type="text" name="lname" required></label><br><br>
  <label>Librarian ID:<br><input type="number" name="id" required></label><br><br>
  <label>Phone Number:<br><input type="number" name="pnum"></label><br><br>
  <label>Email:<br><input type="email" name="email" required></label><br><br>         
  <button type="submit" name="register" value="register">ADD BOOK</button>
</form>
<p><a href="admin_home.php">Back to Admin home</a></p>
<p><a href="admin_librarians.php">Back to Admin librarians</a></p>
</body>

</html>

