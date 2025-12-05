<?php
require "db.php";
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $name = $_POST['name'];
    $id = $_POST['id'];
    $desc = $_POST['desc'];
    $query = "INSERT INTO GENRE (GENRE_ID, GENRE_NAME, GENRE_DESC) 
                 VALUES ('$id', '$name', '$desc')";
    $conn->query($query);
    echo "Genre added successfully!";
    
}
?>
<!DOCTYPE html>  
<html>
<head><meta charset="utf-8"><title>Truthary Lib | add genres</title></head>
<body>
<h2>Admin control</h2>

<!-- Don't forget to add the errror text here..-->

<form method="post" action="add_genre.php">
    <h1> ADD GENRE </h1>
  <label>GENRE ID:<br><input type="text" name="id" required></label><br><br>
  <label>GENRE name:<br><input type="text" name="name" required></label><br><br>
  <label>GENRE description:<br><input type="text" name="desc" required></label><br><br>
  <button type="submit" name="register" value="register">ADD GENRE</button>
</form>
<p><a href="admin_home.php">Back to Admin home</a></p>
<p><a href="admin_genres.php">Back to Admin genres</a></p>
</body>

</html>
