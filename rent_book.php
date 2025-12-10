<?php
require "db.php";

$message = '';
$book = null;
$bookID = $_GET['BOOK_ID'] ?? $_GET['book_id'] ?? '';

if (empty($bookID)) {
    die("Book ID not provided.");
}

$stmt = $conn->prepare("SELECT BOOK_ID, BOOK_TITLE, BOOK_STATUS FROM BOOK WHERE BOOK_ID = ?");
$stmt->bind_param("s", $bookID);
$stmt->execute();
$result = $stmt->get_result();
$book = $result->fetch_assoc();
$stmt->close();

if (!$book) {
    die("Book not found.");
}

$isAvailable = ($book["BOOK_STATUS"] === "Available");

if ($_SERVER["REQUEST_METHOD"] == "POST" && $isAvailable) {
    $stuID = $_POST['stu_id'] ?? '';
    $libID = $_POST['lib_id'] ?? '';
    
    if (empty($stuID)) {
        $message = "Student ID is required.";
    } elseif (empty($libID)) {
        $message = "Librarian ID is required.";
    } else {
        $stmtStu = $conn->prepare("SELECT STU_ID_NUM FROM STUDENT WHERE STU_ID_NUM = ?");
        $stmtStu->bind_param("s", $stuID);
        $stmtStu->execute();
        $stuResult = $stmtStu->get_result();
        $stmtStu->close();
        
        if ($stuResult->num_rows == 0) {
            $message = "Student ID not found.";
        } else {
            $stmtLib = $conn->prepare("SELECT LIB_ID FROM LIBRARIAN WHERE LIB_ID = ?");
            $stmtLib->bind_param("s", $libID);
            $stmtLib->execute();
            $libResult = $stmtLib->get_result();
            $stmtLib->close();
            
            if ($libResult->num_rows == 0) {
                $message = "Librarian ID not found.";
            } else {
                $rentDate = date('Y-m-d');
                $expiryDate = date('Y-m-d', strtotime('+14 days'));
                
                $stmtRental = $conn->prepare("INSERT INTO RENTAL (RENT_DATE, RENT_EXPIRY_DATE, BOOK_ID, STU_ID_NUM, LIB_ID) VALUES (?, ?, ?, ?, ?)");
                $stmtRental->bind_param("sssss", $rentDate, $expiryDate, $bookID, $stuID, $libID);
                
                if ($stmtRental->execute()) {
                    $stmtUpdate = $conn->prepare("UPDATE BOOK SET BOOK_STATUS = 'Not Available' WHERE BOOK_ID = ?");
                    $stmtUpdate->bind_param("s", $bookID);
                    $stmtUpdate->execute();
                    $stmtUpdate->close();
                    
                    $message = "Book rented successfully! Expiry date: $expiryDate";
                } else {
                    $message = "Warning: Foreign key error: " . $stmtRental->error;
                }
                $stmtRental->close();
            }
        }
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Rent Book</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<div class="container">

<h2>Rent Book: <?php echo htmlspecialchars($book["BOOK_TITLE"]); ?></h2>

<div class="auth-box">

<p><b>Book ID:</b> <?php echo htmlspecialchars($bookID); ?></p>
<p><b>Status:</b> <?php echo htmlspecialchars($book["BOOK_STATUS"]); ?></p>

<?php if ($message): ?>
<p><?php echo htmlspecialchars($message); ?></p>
<?php endif; ?>

<?php if (!$isAvailable): ?>

<p>This book is currently not available.</p>
<a href="view_books.php" class="btn">Back</a>

<?php else: ?>

<form method="POST">
    <p>
        <label>Student ID:<br>
            <input type="text" name="stu_id" required>
        </label>
    </p>
    <p>
        <label>Librarian ID:<br>
            <input type="text" name="lib_id" required>
        </label>
    </p>
    <p>Confirm renting this book? (Expiry date: <?php echo date('Y-m-d', strtotime('+14 days')); ?>)</p>
    <button type="submit" class="btn">Rent Book</button>
    <a href="view_books.php" class="btn btn-secondary">Cancel</a>
</form>

<?php endif; ?>

</div>

</div>

</body>
</html>
