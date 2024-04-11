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

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Getting data from the form
    $id = isset($_POST['id']) ? $_POST['id'] : '';
    $name = isset($_POST['name']) ? $_POST['name'] : '';
    $email = isset($_POST['email']) ? $_POST['email'] : '';

    // Sanitize inputs
    $id = mysqli_real_escape_string($conn, $id);
    $name = mysqli_real_escape_string($conn, $name);
    $email = mysqli_real_escape_string($conn, $email);

    // Updating data in the database
    $sql = "UPDATE students SET name='$name', email='$email' WHERE id='$id'";

    if ($conn->query($sql) === TRUE) {
        echo "Record updated successfully";
    } else {
        echo "Error updating record: " . $conn->error;
    }
}

// Retrieve current details from the database
$id = isset($_GET['id']) ? $_GET['id'] : '';
$id = mysqli_real_escape_string($conn, $id);
$sql_select = "SELECT * FROM students WHERE id='$id'";
$result = $conn->query($sql_select);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $name = $row['name'];
    $email = $row['email'];
} else {
    echo "No record found";
    exit(); // Exit the script if no record is found
}

$conn->close();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Update Student Details</title>
</head>
<body>
    <h2>Update Student Details</h2>
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
        <input type="hidden" name="id" value="<?php echo $id; ?>">
        Name: <input type="text" name="name" value="<?php echo $name; ?>"><br><br>
        Email: <input type="text" name="email" value="<?php echo $email; ?>"><br><br>
        <input type="submit" value="Update">
    </form>

    <!-- Button to redirect to read.php -->
    <a href="read.php">Return to Student Details</a>
</body>
</html>
