<?php 
require 'db.php'
?>
<!DOCTYPE html>
<html>
<head>
    <title>My Profile</title>
</head>
<body>

<h2>My Profile</h2>

<p><strong>Name:</strong> <?php echo htmlspecialchars($data['STU_FNAME'] . " " . $data['STU_LNAME']); ?></p>
<p><strong>Email:</strong> <?php echo htmlspecialchars($data['STU_EMAIL']); ?></p>
<p><strong>Phone:</strong> <?php echo htmlspecialchars($data['STU_PHONE_NUM']); ?></p>

<h3>Update Profile</h3>

<form method="POST">
    <label>New Phone:</label><br>
    <input type="text" name="phone" required maxlength="11"><br><br>

    <label>New Email:</label><br>
    <input type="email" name="email" required><br><br>

    <label>New Password:</label><br>
    <input type="password" name="password" required><br><br>

    <button type="submit">Update</button>
</form>

<a href="home.php">Back</a>

</body>
</html>
