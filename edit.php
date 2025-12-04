<?php
require "db.php";

$message = '';

// Map tables to their primary key columns and editable columns
$tableMap = [
    'STUDENT' => ['pk' => 'STU_ID_NUM', 'columns' => ['STU_NAME', 'STU_EMAIL', 'STU_PHONE']],
    'LIBRARIAN' => ['pk' => 'LIB_ID_NUM', 'columns' => ['LIB_NAME', 'LIB_EMAIL']],
    'BOOK' => ['pk' => 'BOOK_ID', 'columns' => ['BOOK_TITLE', 'BOOK_YEAR', 'BOOK_COPIES']],
    'AUTHOR' => ['pk' => 'AUTH_ID', 'columns' => ['AUTH_NAME']],
    'PUBLISHER' => ['pk' => 'PUB_ID', 'columns' => ['PUB_NAME', 'PUB_CITY']],
    'GENRE' => ['pk' => 'GENRE_ID', 'columns' => ['GENRE_NAME']],
    'RENTAL' => ['pk' => 'RENT_ID', 'columns' => ['RENT_DATE', 'RETURN_DATE']]
];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $table = $_POST['table'] ?? '';
    $id = $_POST['id'] ?? '';
    $column = $_POST['column'] ?? '';
    $newValue = $_POST['newValue'] ?? '';

    // Validate table exists
    if (!isset($tableMap[$table])) {
        $message = "Invalid table selected.";
    } elseif (empty($id)) {
        $message = "ID cannot be empty.";
    } elseif (empty($column)) {
        $message = "Column must be selected.";
    } elseif (empty($newValue)) {
        $message = "New value cannot be empty.";
    } elseif (!in_array($column, $tableMap[$table]['columns'])) {
        $message = "Invalid column for this table.";
    } else {
        $pk = $tableMap[$table]['pk'];
        
        // Use prepared statement for security
        $stmt = $conn->prepare("UPDATE $table SET $column = ? WHERE $pk = ?");
        $stmt->bind_param("ss", $newValue, $id);
        
        if ($stmt->execute()) {
            if ($stmt->affected_rows > 0) {
                $message = "Record updated successfully!";
            } else {
                $message = "No record found with that ID.";
            }
        } else {
            $message = "Error updating record: " . $stmt->error;
        }
        $stmt->close();
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Edit Record</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 20px; }
        .form-group { margin-bottom: 15px; }
        label { display: block; font-weight: bold; margin-bottom: 5px; }
        select, input[type="text"] { width: 300px; padding: 5px; }
        button { padding: 10px 20px; background-color: black; color: white; border: none; cursor: pointer; }
        button:hover { background-color: #333; }
        .message { padding: 10px; margin-bottom: 20px; }
        .success { color: black; }
        .error { color: black; }
    </style>
</head>
<body>
<h2>Edit Record</h2>
<?php 
    if ($message) {
        $messageClass = (strpos($message, "successfully") !== false || strpos($message, "No record") !== false) ? "success" : "error";
        echo "<div class='message $messageClass'>$message</div>";
    }
?>
<form method="post" action="edit.php">
    <div class="form-group">
        <label>Table:<br>
            <select name="table" required onchange="updateColumns()">
                <option value="">Select table</option>
                <option value="STUDENT">Student</option>
                <option value="BOOK">Book</option>
                <option value="AUTHOR">Author</option>
                <option value="PUBLISHER">Publisher</option>
                <option value="GENRE">Genre</option>
                <option value="LIBRARIAN">Librarian</option>
                <option value="RENTAL">Rental</option>
            </select>
        </label>
    </div>

    <div class="form-group">
        <label>Primary Key / ID:<br>
            <input type="text" name="id" required placeholder="Enter the ID to edit">
        </label>
    </div>

    <div class="form-group">
        <label>Column to Edit:<br>
            <select name="column" id="columnSelect" required>
                <option value="">Select column</option>
            </select>
        </label>
    </div>

    <div class="form-group">
        <label>New Value:<br>
            <input type="text" name="newValue" required placeholder="Enter new value">
        </label>
    </div>

    <button type="submit">Update Record</button>
</form>

<p><a href="admin_home.php">Back to Admin Home</a></p>

<script>
    const columnMap = {
        'STUDENT': ['STU_NAME', 'STU_EMAIL', 'STU_PHONE'],
        'LIBRARIAN': ['LIB_NAME', 'LIB_EMAIL'],
        'BOOK': ['BOOK_TITLE', 'BOOK_YEAR', 'BOOK_COPIES'],
        'AUTHOR': ['AUTH_NAME'],
        'PUBLISHER': ['PUB_NAME', 'PUB_CITY'],
        'GENRE': ['GENRE_NAME'],
        'RENTAL': ['RENT_DATE', 'RETURN_DATE']
    };

    function updateColumns() {
        const table = document.querySelector('select[name="table"]').value;
        const columnSelect = document.getElementById('columnSelect');
        columnSelect.innerHTML = '<option value="">Select column</option>';
        
        if (table && columnMap[table]) {
            columnMap[table].forEach(col => {
                const option = document.createElement('option');
                option.value = col;
                option.textContent = col;
                columnSelect.appendChild(option);
            });
        }
    }
</script>
</body>
</html>
