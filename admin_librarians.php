<?php 
require 'db.php'
?>

<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="style.css">
    <title>Manage Librarians</title>
</head>
<body>

<div class="container">

<h2>Librarians</h2>

<a href="add_librarian.php" class="btn">Add Librarian</a>

<table border="1">
    <tr>
        <th>Librarian ID</th>
        <th>Librarian First Name</th>
        <th>Librarian Surname</th>
        <th>Librarian Phone No.</th>
        <th>Librarian Email</th>
        <th>Actions</th>
    </tr>

    <?php
$res = $conn->query("SELECT * FROM LIBRARIAN");

while($row = $res->fetch_assoc()) {
    echo "<tr>
        <td>{$row['LIB_ID']}</td>
        <td>{$row['LIB_FNAME']}</td>
        <td>{$row['LIB_LNAME']}</td>
        <td>{$row['LIB_EMAIL']}</td>
        <td>{$row['LIB_PHONE_NUM']}</td>
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
