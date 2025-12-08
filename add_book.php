<?php
require "db.php";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
$pub_id = $_POST['p_id'];
$genre_id = $_POST['g_id'];

$pubCheck = $conn->query("SELECT * FROM PUBLISHER WHERE PUB_ID = '$pub_id'");
$genreCheck = $conn->query("SELECT * FROM GENRE WHERE GENRE_ID = '$genre_id'");

$status = (isset($_POST['fruit']) && $_POST['fruit'] == "avail") ? "Available" : "Not Available";

if ($pubCheck->num_rows == 0) {
    echo "Error: Publisher ID does not exist.";
} elseif ($genreCheck->num_rows == 0) {
    echo "Error: Genre ID does not exist.";
} else {
    $title = $_POST['title'];
    $age = $_POST['age'];
    if (!ctype_digit($age)) {
    echo "Error: Age must be a number.";
    } else {
    $age = (int)$age;
}
    $id = $_POST['id'];
    $query = "INSERT INTO BOOK (BOOK_ID, BOOK_TITLE, BOOK_AGE_RATING, BOOK_STATUS, PUB_ID, GENRE_ID) 
                 VALUES ('$id', '$title', $age, '$status', '$pub_id', '$genre_id')";
    $conn->query($query);
    echo "Book added successfully!";
}
}
?>
<!DOCTYPE html>  
<html>
<head>
<meta charset="utf-8">
<title>Truthary Lib | add books</title>
<link rel="stylesheet" href="style.css">
</head>
<body>

<div class="container">

<h2>Admin control</h2>

<div class="auth-box">
<form method="post" action="add_book.php">
    <h1> ADD BOOKS </h1>
  <label>Book Title:<br><input type="text" name="title"></label><br><br>
  <label>Book ID:<br><input type="text" name="id" required></label><br><br>
  <label>Age Rating:<br><input type="num" name="age"></label><br><br>         
   <label>
    <input type="radio" name="fruit" value="avail" checked> Available
  </label><br>
  <label>
    <input type="radio" name="fruit" value="n_avail"> Not Available
  </label><br>
  <label>Publisher id:<br><input type="number" name="p_id"></label><br><br>
  <label>Genre id:<br><input type="number" name="g_id"></label><br><br>
  <button type="submit" name="register" value="register">ADD BOOK</button>
</form>
</div>

<p><a href="admin_home.php">Back to Admin home</a></p>
<p><a href="admin_books.php">Back to Admin books</a></p>

</div>

</body>
</html>







