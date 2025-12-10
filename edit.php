<?php
require "db.php";

$message = '';

$tableMap = [
    'STUDENT' => ['pk' => 'STU_ID_NUM', 'columns' => ['STU_FNAME', 'STU_LNAME', 'STU_EMAIL', 'STU_PHONE_NUM']],
    'LIBRARIAN' => ['pk' => 'LIB_ID', 'columns' => ['LIB_FNAME', 'LIB_LNAME', 'LIB_PHONE_NUM', 'LIB_EMAIL']],
    'BOOK' => ['pk' => 'BOOK_ID', 'columns' => ['BOOK_TITLE', 'BOOK_AGE_RATING', 'BOOK_STATUS', 'PUB_ID', 'GENRE_ID']],
    'AUTHOR' => ['pk' => 'AUTH_ID', 'columns' => ['AUTH_NAME']],
    'PUBLISHER' => ['pk' => 'PUB_ID', 'columns' => ['PUB_NAME', 'PUB_ADDRESS']],
    'GENRE' => ['pk' => 'GENRE_ID', 'columns' => ['GENRE_NAME', 'GENRE_DESC']],
    'RENTAL' => ['pk' => 'RENT_ID', 'columns' => ['RENT_DATE', 'RENT_EXPIRY_DATE', 'RENT_FINE', 'BOOK_ID', 'STU_ID_NUM', 'LIB_ID', 'RETURN_DATE']]
];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $table = $_POST['table'] ?? '';
    $id = $_POST['id'] ?? '';
    $column = $_POST['column'] ?? '';
    $newValue = $_POST['newValue'] ?? '';

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

        $validationFailed = false;
        if ($table === 'RENTAL') {
            if ($column === 'BOOK_ID') {
                $chk = $conn->prepare("SELECT 1 FROM BOOK WHERE BOOK_ID = ?");
                $chk->bind_param("s", $newValue);
                $chk->execute();
                $r = $chk->get_result();
                if (!$r || $r->num_rows == 0) {
                    $message = "Invalid Book ID.";
                    $validationFailed = true;
                }
                $chk->close();
            } elseif ($column === 'STU_ID_NUM') {
                $chk = $conn->prepare("SELECT 1 FROM STUDENT WHERE STU_ID_NUM = ?");
                $chk->bind_param("s", $newValue);
                $chk->execute();
                $r = $chk->get_result();
                if (!$r || $r->num_rows == 0) {
                    $message = "Invalid Student ID.";
                    $validationFailed = true;
                }
                $chk->close();
            } elseif ($column === 'LIB_ID') {
                $chk = $conn->prepare("SELECT 1 FROM LIBRARIAN WHERE LIB_ID = ?");
                $chk->bind_param("s", $newValue);
                $chk->execute();
                $r = $chk->get_result();
                if (!$r || $r->num_rows == 0) {
                    $message = "Invalid Librarian ID.";
                    $validationFailed = true;
                }
                $chk->close();
            }

            if (!$validationFailed && in_array($column, ['RENT_DATE', 'RENT_EXPIRY_DATE'])) {
                $d = DateTime::createFromFormat('Y-m-d', $newValue);
                if (!$d || $d->format('Y-m-d') !== $newValue) {
                    $message = "Invalid date format. Use YYYY-MM-DD.";
                    $validationFailed = true;
                }
            }

            if (!$validationFailed && $column === 'RENT_FINE') {
                if (!is_numeric($newValue)) {
                    $message = "Rent fine must be a numeric value.";
                    $validationFailed = true;
                }
            }
        }

        if (!$validationFailed) {
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
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Edit Record</title>
    <link rel="stylesheet" href="style.css">
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

<div class="container">

<h2>Edit Record</h2>

<?php 
    if ($message) {
        $messageClass = (strpos($message, "successfully") !== false || strpos($message, "No record") !== false) ? "success" : "error";
        echo "<div class='message $messageClass'>$message</div>";
    }
?>

<div class="auth-box">
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

    <button type="submit" class="btn">Update Record</button>
</form>
</div>

<p><a href="admin_home.php">Back to Admin Home</a></p>

</div>

<script>
    const columnMap = {
        'STUDENT': ['STU_FNAME', 'STU_LNAME', 'STU_EMAIL', 'STU_PHONE_NUM'],
        'LIBRARIAN': ['LIB_FNAME', 'LIB_LNAME', 'LIB_EMAIL', 'LIB_PHONE_NUM', 'LIB_EMAIL'],
        'BOOK': ['BOOK_TITLE', 'BOOK_AGE_RATING', 'BOOK_STATUS', 'PUB_ID','GENRE_ID'],
        'AUTHOR': ['AUTH_NAME'],
        'PUBLISHER': ['PUB_NAME', 'PUB_ADDRESS'],
        'GENRE': ['GENRE_NAME', 'GENRE_DESC'],
        'RENTAL': ['RENT_DATE', 'RENT_EXPIRY_DATE', 'RENT_FINE', 'BOOK_ID', 'STU_ID_NUM', 'LIB_ID', 'RETURN_DATE']
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



