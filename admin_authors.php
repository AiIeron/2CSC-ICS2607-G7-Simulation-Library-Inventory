<?php 
require 'db.php'
?>

<!DOCTYPE html>
<html>
<head>
    <title>Manage Authors</title>
</head>
<body>

<h2>Authors</h2>

<a href="add_author.php">Add Author</a>

<table border="1">
    <tr>
        <th>Author ID</th>
        <th>Author Name</th>
        <th>Actions</th>
    </tr>
    <?php
$res = $conn->query("SELECT * FROM AUTHOR");

while($row = $res->fetch_assoc()) {
    echo "<tr>
        <td>{$row['AUTHOR_ID']}</td>
        <td>{$row['AUTHOR_NAME']}</td>
        <td>
            <a href='edit.php'>Edit</a> |
            <a href='dekete.php' onclick='return confirm(\"Delete order?\")'>Delete</a>
        </td>
    </tr>";
}
?>
</table>

</body>
</html>
