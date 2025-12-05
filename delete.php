<?php
require "db.php";

$message = '';

// Map tables to their primary key columns
$tableMap = [
    'STUDENT' => 'STU_ID_NUM',
    'LIBRARIAN' => 'LIB_ID_NUM',
    'BOOK' => 'BOOK_ID',
    'AUTHOR' => 'AUTH_ID',
    'PUBLISHER' => 'PUB_ID',
    'GENRE' => 'GENRE_ID',
    'RENTAL' => 'RENT_ID'
];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $table = $_POST['table'] ?? '';
    $id = $_POST['id'] ?? '';

    if (!isset($tableMap[$table])) {
        $message = "Invalid table selected.";
    } elseif (empty($id)) {
        $message = "ID cannot be empty.";
    } else {
        $pk = $tableMap[$table];
        
        $stmt = $conn->prepare("DELETE FROM $table WHERE $pk = ?");
        $stmt->bind_param("s", $id);
        
        if ($stmt->execute()) {
            $message = "Row deleted successfully!";
        } else {
            $message = "Error deleting row: " . $stmt->error;
        }
        $stmt->close();
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Delete Record</title>
</head>
<body>
<h2>Delete Record</h2>
<?php if ($message) echo "<p>$message</p>"; ?>
<form method="post" action="delete.php">
    <label>Table:<br>
        <select name="table" required>
            <option value="">Select table</option>
            <option value="STUDENT">Student</option>
            <option value="BOOK">Book</option>
            <option value="AUTHOR">Author</option>
            <option value="PUBLISHER">Publisher</option>
            <option value="GENRE">Genre</option>
            <option value="LIBRARIAN">Librarian</option>
            <option value="RENTAL">Rental</option>
        </select>
    </label><br><br>
    <label>Primary Key / ID:<br>
        <input type="text" name="id" required>
    </label><br><br>
    <button type="submit">Delete Record</button>
</form>
<p><a href="admin_home.php">Back to Admin Home</a></p>
</body>
</html>