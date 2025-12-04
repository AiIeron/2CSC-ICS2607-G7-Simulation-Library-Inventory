<!DOCTYPE html>
<html>
<head>
    <title>Library Home</title>
</head>
<body>

<h2>Welcome, <?php echo htmlspecialchars($studentName); ?>!</h2>

<!-- BASIC NAVIGATION -->
<ul>
    <li><a href="view_books.php">View Available Books</a></li>
    <li><a href="my_rentals.php">My Rentals</a></li>
    <li><a href="rent_book.php">Rent a Book</a></li>
    <li><a href="profile.php">My Profile</a></li>
    <li><a href="register.php">Logout</a></li>
</ul>

</body>
</html>
