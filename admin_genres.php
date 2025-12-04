<?php 
require 'db.php'
?>

<!DOCTYPE html>
<html>
<head>
    <title>Manage Genres</title>
</head>
<body>

<h2>Genres</h2>

<a href="add_genre.php">Add Genre</a>

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
            <a href='TOTAL.php?edit={$row['STU_ID_NUM']}'>Edit</a> |
            <a href='TOTAL.php?delete={$row['STU_ID_NUM']}' onclick='return confirm(\"Delete order?\")'>Delete</a>
        </td>
    </tr>";
}
?>
</table>

</body>
</html>
