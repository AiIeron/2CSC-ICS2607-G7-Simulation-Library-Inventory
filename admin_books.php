<?php 
require 'db.php'
?>

<!DOCTYPE html>
<html>
<head>
    <title>Manage Books</title>
</head>
<body>

<h2>Books</h2>

<a href="add_book.php">Add Book</a>

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
            <a href='TOTAL.php?edit={$row['STU_ID_NUM']}'>Edit</a> |
            <a href='TOTAL.php?delete={$row['STU_ID_NUM']}' onclick='return confirm(\"Delete order?\")'>Delete</a>
        </td>
    </tr>";
}
?>
</table>

</body>
</html>
