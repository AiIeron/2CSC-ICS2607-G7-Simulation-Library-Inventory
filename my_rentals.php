<!DOCTYPE html>
<html>
<head>
    <title>My Rentals</title>
</head>
<body>

<h2>My Rentals</h2>

<table border="1" cellpadding="5">
    <tr>
        <th>Book Title</th>
        <th>Rent Date</th>
        <th>Expiry Date</th>
        <th>Fine</th>
    </tr>

    <?php foreach ($rentals as $r): ?>
        <tr>
            <td><?php echo htmlspecialchars($r['BOOK_TITLE']); ?></td>
            <td><?php echo htmlspecialchars($r['RENT_DATE']); ?></td>
            <td><?php echo htmlspecialchars($r['RENT_EXPIRY_DATE']); ?></td>
            <td><?php echo $r['RENT_FINE'] === null ? "—" : htmlspecialchars($r['RENT_FINE']); ?></td>
        </tr>
    <?php endforeach; ?>
</table>

<br>
<a href="home.php">Back to Home</a>

</body>
</html>
