<?php
session_start();
require 'db.php';

if (!isset($_SESSION['stu_id'])) {
    header("Location: profile.php");
    exit();
}

$stu_id = $_SESSION['stu_id'];

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
    <link rel="stylesheet" href="style.css">
</head>
<body>

<div class="container">

<h2>My Profile</h2>

<a href="home.php" class="btn">Back to Home</a>

<div class="auth-box">

<p><strong>ID:</strong> <?php echo htmlspecialchars($stu_id); ?></p>
<p><strong>Name:</strong> <?php echo htmlspecialchars($user['STU_FNAME'] . " " . $user['STU_LNAME']); ?></p>
<p><strong>Phone:</strong> <?php echo htmlspecialchars($user['STU_PHONE_NUM']); ?></p>
<p><strong>Email:</strong> <?php echo htmlspecialchars($user['STU_EMAIL']); ?></p>

<br>

<a href="logout.php" class="btn btn-danger">Logout</a>

</div>

</div>

</body>
</html>


