<?php
$servername = "localhost";
$username = "root";
$password = "";

$conn = new mysqli($servername, $username, $password);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "CREATE DATABASE lib";
if ($conn->query($sql) === TRUE) {
    echo "Proceed, Databaaes has been created";
} else {
    echo "Error creating lib" . $conn->error;
}

$conn->close();
?>