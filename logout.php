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
</head>
<body>
    <p>You have been logged out. Redirecting...</p>
</body>
</html>
