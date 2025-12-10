
<?php
session_start();
require "db.php"; 

$adminEmail = "admin@tlib.com";
$adminPassword = "admin123";
$failure = "";

function POST($k) {
    return isset($_POST[$k]) ? trim($_POST[$k]) : "";
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $email = POST('email');
    $password = POST('password');

    if ($email === $adminEmail && $password === $adminPassword) {
        $_SESSION['role'] = 'admin';
        $_SESSION['email'] = $email;
        header("Location: admin_home.php");
        exit;
    }

        $stmt2 = $conn->prepare("SELECT STU_ID_NUM, STU_EMAIL FROM STUDENT WHERE STU_EMAIL = ? AND STU_PASS = ?");
        if ($stmt2) {
            $stmt2->bind_param("ss", $email, $password);
            $stmt2->execute();
            $res2 = $stmt2->get_result();
            if ($res2 && $res2->num_rows > 0) {
                $row2 = $res2->fetch_assoc();
                $_SESSION['role'] = 'student';
                $_SESSION['stu_id'] = $row2['STU_ID_NUM'];
                $_SESSION['email'] = $row2['STU_EMAIL'];
                $stmt2->close();
                header("Location: home.php");
                exit;
            }
            $stmt2->close();
        } else {
            $failure = "Internal error: " . $conn->error;
        }

    if (empty($failure)) {
        $failure = "Incorrect username or password.";
    }
}
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Truthary Lib | Login</title>
<link rel="stylesheet" href="style.css">
</head>
<body>

<div class="container">

<h2>Login</h2>

<div class="auth-box">
<form method="post" action="login.php">
    <?php if (!empty($failure)): ?>
        <p class="error"><?php echo htmlentities($failure); ?></p>
    <?php endif; ?>
  <label>Email:<br><input type="email" name="email" required></label><br><br>
  <label>Password:<br><input type="password" name="password" required></label><br><br>
  <button type="submit">Login</button>
  <?php
if ( $failure !== false ) {
    echo'<p class="error">'.htmlentities($failure)."</p>\n";
}
?>
</form>
</div>

<p><a href="register.php">Create Account</a></p>

</div>

</body>
</html>





