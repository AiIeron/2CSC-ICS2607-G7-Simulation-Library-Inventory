<?php
require "db.php";
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $name = $_POST['name'];
    $id = $_POST['id'];
    $address = $_POST['address'];
    $query = "INSERT INTO PUBLISHER (PUB_ID, PUB_NAME, PUB_ADDRESS) 
                 VALUES ('$id', '$name', '$address')";
    $conn->query($query);
    echo "Publisher added successfully!";
    
}
?>
<!DOCTYPE html>  
<html>
<head><meta charset="utf-8"><title>Truthary Lib | add punlisher</title></head>
<body>
<h2>Create Account (Student)</h2>

<!-- Don't forget to add the errror text here..-->

<form method="post" action="add_publisher.php">
    <h1> ADD PUBLISHER </h1>
  <label>Publisher ID:<br><input type="text" name="id" required></label><br><br>
  <label>Publisher name:<br><input type="text" name="name" required></label><br><br>
  <label>Publisher address:<br><input type="text" name="address" required></label><br><br>
  <button type="submit" name="register" value="register">ADD PUBLISHER</button>
</form>
<p><a href="admin_home.php">Back to Admin home</a></p>
<p><a href="admin_publisher.php">Back to Admin publishers</a></p>
</body>
</html>