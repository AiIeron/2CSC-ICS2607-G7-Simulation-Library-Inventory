<?php
require "db.php";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $id = $_POST['id'];
    $query = "INSERT INTO AUTHOR (AUTH_ID, AUTH_NAME) 
                 VALUES ('$id', '$name')";
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

<form method="post" action="add_author.php">
    <h1> ADD AUTHOR </h1>
  <label>Author ID:<br><input type="text" name="id" required></label><br><br>
  <label>Author name:<br><input type="text" name="name" required></label><br><br>
  <button type="submit" name="register" value="register">ADD BOOK</button>
</form>
<p><a href="admin_home.php">Back to Admin home</a></p>
<p><a href="admin_author.php">Back to Admin author</a></p>
</body>
</html>