<?php 
require 'db.php'
?>

<!DOCTYPE html>
<html>
<head>
    <title>Manage Publishers</title>
</head>
<body>

<h2>Publishers</h2>

<a href="add_publisher.php">Add Publisher</a>

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
            <a href='TOTAL.php?edit={$row['STU_ID_NUM']}'>Edit</a> |
            <a href='TOTAL.php?delete={$row['STU_ID_NUM']}' onclick='return confirm(\"Delete order?\")'>Delete</a>
        </td>
    </tr>";
}
?>
</table>

</body>
</html>
