<?php
require 'db.php';

$query = "
    SELECT 
        BOOK.BOOK_ID,
        BOOK.BOOK_TITLE,
        PUBLISHER.PUB_NAME
    FROM BOOK
    JOIN PUBLISHER ON BOOK.PUB_ID = PUBLISHER.PUB_ID
    WHERE BOOK.BOOK_STATUS = 'Available'
";

$result = mysqli_query($conn, $query);
?>
<!DOCTYPE html>
<html>
<head>
    <title>Available Books</title>
</head>
<body>

<h2>Available Books</h2>

<a href="home.php">Back to Home</a>

<table border="1" cellpadding="5" cellspacing="0">
    <tr>
        <th>Book ID</th>
        <th>Title</th>
        <th>Publisher</th>
        <th>Action</th>
    </tr>

    <?php if ($result && mysqli_num_rows($result) > 0) { ?>
        <?php while ($row = mysqli_fetch_assoc($result)) { ?>
            <tr>
                <td><?php echo htmlspecialchars($row['BOOK_ID']); ?></td>
                <td><?php echo htmlspecialchars($row['BOOK_TITLE']); ?></td>
                <td><?php echo htmlspecialchars($row['PUB_NAME']); ?></td>
                <td>
                    <a href="rent_book.php?book_
<?php } ?>
