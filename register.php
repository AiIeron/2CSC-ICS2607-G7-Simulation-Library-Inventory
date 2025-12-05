<?php
session_start();
require "db.php";

$error = "";
$success = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") { 

    $s_id    = trim($_POST['id']);
    $s_fn    = trim($_POST['fname']);
    $s_ln    = trim($_POST['lname']);
    $s_pn    = trim($_POST['phone']);
    $s_email = trim($_POST['email']);
    $pass1   = $_POST['password'];
    $pass2   = $_POST['password2'];

    if ($pass1 !== $pass2) {
        $error = "Passwords do not match.";
    } else {

        $check = $conn->prepare("SELECT STU_ID_NUM, STU_EMAIL FROM STUDENT WHERE STU_ID_NUM = ? OR STU_EMAIL = ?");
        $check->bind_param("ss", $s_id, $s_email);
        $check->execute();
        $result = $check->get_result();

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();

            if ($row['STU_ID_NUM'] == $s_id) {
                $error = "Student ID is already registered.";
            } 
            if ($row['STU_EMAIL'] == $s_email) {
                $error .= "<br>Email is already registered.";
            }
        } else {

            // Insert student into database
            $stmt = $conn->prepare("INSERT INTO STUDENT 
                (STU_ID_NUM, STU_FNAME, STU_LNAME, STU_PHONE_NUM, STU_EMAIL, STU_PASS) 
                VALUES (?, ?, ?, ?, ?, ?)");

            $stmt->bind_param("ssssss", $s_id, $s_fn, $s_ln, $s_pn, $s_email, $pass1);

            if ($stmt->execute()) {
                $success = "Student registered successfully!";
            } else {
                $error = "Database error: " . $stmt->error;
            }
        }
    }
}
?>

<!DOCTYPE html>  
<html>
<head><meta charset="utf-8"><title>Truthary Lib | Register</title></head>
<body>
<h2>Create Account (Student)</h2>

<?php if (!empty($error)) echo "<p style='color:red;'>$error</p>"; ?>
<?php if (!empty($success)) echo "<p style='color:green;'>$success</p>"; ?>

<form method="post" action="register.php">
  <label>First Name:<br><input type="text" name="fname" required></label><br><br>
  <label>Surname:<br><input type="text" name="lname" required></label><br><br>
  <label>Student ID:<br><input type="text" name="id" required></label><br><br>
   <label>Phone No.:<br>
      <input type="text" name="phone" pattern="[0-9]{11}" title="11 digits only">
  </label><br><br>   
  <label>Email:<br><input type="email" name="email" required></label><br><br>
  <label>Password:<br><input type="password" name="password" required></label><br><br>
  <label>Confirm Password:<br><input type="password" name="password2" required></label><br><br> 
  <button type="submit" name="register" value="register">Register</button>
</form>
<p><a href="login.php">Back to login</a></p>
</body>
</html>














