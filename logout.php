<?php
session_start();
session_unset();
session_destroy();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Logging Out...</title>
    <meta http-equiv="refresh" content="1; URL=login.php">
    <link rel="stylesheet" href="style.css">
</head>
<body>

<div class="container">

<div class="auth-box">
    <p>You have been logged out. Redirecting...</p>
</div>

</div>

</body>
</html>

