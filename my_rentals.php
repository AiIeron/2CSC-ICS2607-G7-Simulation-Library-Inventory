<?php
session_start();
require 'db.php';

if (!isset($_SESSION['stu_id'])) {
    header("Location: login.php");
    exit();
}

$stu_id = $_SESSION['stu_id'];

$query = "
    SELECT 
        RENTAL.RENT_ID,
        RENTAL.RENT_DATE,
        RENTAL.RENT_EXPIRY_DATE,
        RENTAL.RENT_FINE,
        BOOK.BOOK_TITLE
    FROM RENTAL
    JOIN BOOK ON RENTAL.BOOK_ID = BOOK.BOOK_ID
    WHERE RENTAL.STU_ID_NUM = '$stu_id'
    ORDER BY RENTAL.RENT_DATE DESC
";

$result = mysqli_query($conn, $query);
?>
<!DOCTYPE html>
<html>
<head>
    <title>My Rentals</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<div class="container">

<h2>My Rentals</h2>

<a href="home.php" class="btn">Back to Home</a>

<table border="1" cellpadding="5" cellspacing="0">
    <tr>
        <th>Rent ID</th>
        <th>Book Title</th>
        <th>Rent Date</th>
        <th>Expiry Date</th>
        <th>Fine</th>
    </tr>

    <?php if ($result && mysqli_num_rows($result) > 0) { ?>
        <?php while ($row = mysqli_fetch_assoc($result)) { ?>
            <tr>
                <td><?php echo htmlspecialchars($row['RENT_ID']); ?></td>
                <td><?php echo htmlspecialchars($row['BOOK_TITLE']); ?></td>
                <td><?php echo htmlspecialchars($row['RENT_DATE']); ?></td>
                <td><?php echo htmlspecialchars($row['RENT_EXPIRY_DATE']); ?></td>
                <td><?php echo htmlspecialchars($row['RENT_FINE']); ?></td>
            </tr>
        <?php } ?>
    <?php } else { ?>
        <tr>
            <td colspan="5">You have no rentals.</td>
        </tr>
    <?php } ?>

</table>

</div>

</body>
</html>

