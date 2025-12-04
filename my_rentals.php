<!DOCTYPE html>
<html>
<head>
    <title>My Rentals</title>
</head>
<body>

<h2>My Rentals</h2>

<table border="1" cellpadding="5">
    <tr>
        <th>Rental ID</th>
        <th>Book Title</th>
        <th>Date Rented</th>
        <th>Expiry Date</th>
        <th>Fine</th>
    </tr>

    <?php while ($row = $result->fetch_assoc()): ?>
        <tr>
            <td><?= htmlspecialchars($row['RENT_ID']) ?></td>
            <td><?= htmlspecialchars($row['BOOK_TITLE']) ?></td>
            <td><?= htmlspecialchars($row['RENT_DATE']) ?></td>
            <td><?= htmlspecialchars($row['RENT_EXPIRY_DATE']) ?></td>
            <td><?= $row['RENT_FINE'] === null ? "None" : htmlspecialchars($row['RENT_FINE']) ?></td>
        </tr>
    <?php endwhile; ?>
</table>

<br>
<a href="home.php">Back to Home</a>

</body>
</html>
