<!DOCTYPE html>
<html>
<head>
    <title>Delete Record</title>
</head>
<body>

<?php
// Establishing connection to the database
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "SampleDB";

$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Getting ID of the record to be deleted
$id = $_GET['id'];

// Deleting data from the database
$sql = "DELETE FROM students WHERE id=$id";

if ($conn->query($sql) === TRUE) {
    echo "Record deleted successfully";
} else {
    echo "Error deleting record: " . $conn->error;
}

$conn->close();
?>

<!-- Button to return to read.php -->
<form action="read.php">
    <input type="submit" value="Return to Student Details">
</form>

</body>
</html>
