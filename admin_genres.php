<?php 
require 'db.php'
?>

<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="style.css">
    <title>Manage Genres</title>
</head>
<body>

<div class="container">

<h2>Genres</h2>

<a href="add_genre.php" class="btn">Add Genre</a>

<table border="1">
    <tr>
        <th>Genre ID</th>
        <th>Genre Name</th>
        <th>Genre Description</th>
        <th>Actions</th>
    </tr>

        <?php
$res = $conn->query("SELECT * FROM GENRE");

while($row = $res->fetch_assoc()) {
    echo "<tr>
        <td>{$row['GENRE_ID']}</td>
        <td>{$row['GENRE_NAME']}</td>
        <td>{$row['GENRE_DESC']}</td>
        <td>
            <a href='edit.php' class='btn btn-secondary'>Edit</a> |
            <a href='delete.php' class='btn btn-danger' onclick='return confirm(\"Delete order?\")'>Delete</a>
        </td>
    </tr>";
}
?>
</table>

</div>

</body>
</html>

