<!DOCTYPE html>
<html>
<head>
    <title>Insert Student</title>
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

// Check if form is submitted and if name and email are set
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['name']) && isset($_POST['email'])) {
    // Getting data from the form
    $name = $_POST['name'];
    $email = $_POST['email'];

    // Sanitize inputs
    $name = mysqli_real_escape_string($conn, $name);
    $email = mysqli_real_escape_string($conn, $email);

    // Inserting data into the database
    $sql = "INSERT INTO students (name, email) VALUES ('$name', '$email')";

    if ($conn->query($sql) === TRUE) {
        echo "New record created successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
} else {
    // Display a message if name and email are not set
    echo "Name and/or email not provided";
}

$conn->close();
?>

<!-- Button to return to read.php -->
<form action="read.php">
    <input type="submit" value="Return to Student Details">
</form>

</body>
</html>
