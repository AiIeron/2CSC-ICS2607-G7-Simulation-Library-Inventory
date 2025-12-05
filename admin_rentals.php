<?php 
require 'db.php'
?>

<!DOCTYPE html>
<html>
<head>
    <title>Manage Rentals</title>
</head>
<body>

<h2>Rentals</h2>

<table border="1">
    <tr>
        <th>Rental ID</th>
        <th>Book ID</th>
        <th>Date Rented</th>
        <th>Expiry Date</th>
        <th>Fine</th>
        <th>Student ID</th>
        <th>Librarian ID</th>
    </tr>
    <?php
$res = $conn->query("SELECT * FROM RENTAL");

while($row = $res->fetch_assoc()) {
    echo "<tr>
        <td>{$row['RENT_ID']}</td>
        <td>{$row['BOOK_ID']}</td>
        <td>{$row['RENT_DATE']}</td>
        <td>{$row['RENT_EXPIRY_DATE']}</td>
        <td>{$row['RENT_FINE']}</td>
        <td>{$row['STU_ID_NUM']}</td>
        <td>{$row['LIB_ID']}</td>
        <td>
            <a href='edit.php'>Edit</a> |
            <a href='delete.php' onclick='return confirm(\"Delete order?\")'>Delete</a>
        </td>
    </tr>";
}
?>
</table>

</body>
</html>
