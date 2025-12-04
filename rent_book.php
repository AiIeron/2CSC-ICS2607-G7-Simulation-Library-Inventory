<!DOCTYPE html>
<html>
<head>
    <title>Rent Book</title>
</head>
<body>

<h2>Rent Book: <?php echo htmlspecialchars($book["BOOK_TITLE"]); ?></h2>

<p><b>Book ID:</b> <?php echo htmlspecialchars($bookID); ?></p>
<p><b>Status:</b> <?php echo htmlspecialchars($book["BOOK_STATUS"]); ?></p>

<?php if ($book["BOOK_STATUS"] !== "Available"): ?>

<p style="color:red;">This book is currently not available.</p>
<a href="view_books.php">Back</a>

<?php else: ?>

<form method="POST">
    <p>Confirm renting this book?</p>
    <button type="submit">Rent Book</button>
    <a href="view_books.php">Cancel</a>
</form>

<?php endif; ?>

</body>
</html>
