<?php
session_start();
require 'db.php';

if (!isset($_SESSION['STU_ID_NUM'])) {
    header("Location: login.php");
    exit();
}

$stu_id = $_SESSION['STU_ID_NUM'];

$query = "
    SELECT STU_FNAME, STU_LNAME, STU_PHONE_NUM, STU_EMAIL 
    FROM STUDENT 
    WHERE STU_ID_NUM = '$stu_id'
";

$result = mysqli_query($conn, $query);
$user = mysqli_fetch_assoc($result);
?>
<!DOCTYPE html>
<html>
<head>
    <title>My Profile</title>
</head>
<body>

<h2>My Profile</h2>

<a href="home.php">Back to Home</a>

<p><strong>ID:</strong> <?php echo htmlspecialchars($stu_id); ?></p>
<p><strong>Name:</strong> <?php echo htmlspecialchars($user['STU_FNAME'] . " " . $user['STU_LNAME']); ?></p>
<p><strong>Phone:</strong> <?php echo htmlspecialchars($user['STU_PHONE_NUM']); ?></p>
<p><strong>Email:</strong> <?php echo htmlspecialchars($user['STU_EMAIL']); ?></p>

<br>

<a href="logout.php">Logout</a>

</body>
</html>

