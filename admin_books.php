<?php 
require 'db.php'
?>

<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="style.css">
    <title>Manage Books</title>
</head>
<body>

<div class="container">

<h2>Books</h2>

<a href="add_book.php" class="btn">Add Book</a>

<table border="1">
    <tr>
        <th>Book ID</th>
        <th>Title</th>
        <th>Age Rating</th>
        <th>Status</th>
        <th>Publisher</th>
        <th>Actions</th>
    </tr>
        <?php
$res = $conn->query("SELECT * FROM BOOK");

while($row = $res->fetch_assoc()) {
    echo "<tr>
        <td>{$row['BOOK_ID']}</td>
        <td>{$row['BOOK_TITLE']}</td>
        <td>{$row['BOOK_AGE_RATING']}</td>
        <td>{$row['BOOK_STATUS']}</td>
        <td>{$row['PUB_ID']}</td>
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

