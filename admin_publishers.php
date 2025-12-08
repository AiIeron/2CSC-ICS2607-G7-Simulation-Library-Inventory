<?php 
require 'db.php'
?>

<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="style.css">
    <title>Manage Publishers</title>
</head>
<body>

<div class="container">

<h2>Publishers</h2>

<a href="add_publisher.php" class="btn">Add Publisher</a>

<table border="1">
    <tr>
        <th>Publisher ID</th>
        <th>Publisher Name</th>
        <th>Publisher Address</th>
        <th>Actions</th>
    </tr>
        <?php
$res = $conn->query("SELECT * FROM PUBLISHER");

while($row = $res->fetch_assoc()) {
    echo "<tr>
        <td>{$row['PUB_ID']}</td>
        <td>{$row['PUB_NAME']}</td>
        <td>{$row['PUB_ADDRESS']}</td>
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

