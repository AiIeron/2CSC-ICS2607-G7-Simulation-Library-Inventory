<?php 
require 'db.php'
?>

<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="style.css">
    <title>Manage Students</title>
</head>
<body>

<div class="container">

<h2>Students</h2>

<table border="1">
    <tr>
        <th>ID Number</th>
        <th>First Name</th>
        <th>Last Name</th>
        <th>Email</th>
        <th>Phone</th>
        <th>Actions</th>
    </tr>
        <?php
$res = $conn->query("SELECT * FROM student");

while($row = $res->fetch_assoc()) {
    echo "<tr>
        <td>{$row['STU_ID_NUM']}</td>
        <td>{$row['STU_FNAME']}</td>
        <td>{$row['STU_LNAME']}</td>
        <td>{$row['STU_EMAIL']}</td>
        <td>{$row['STU_PHONE_NUM']}</td>
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

