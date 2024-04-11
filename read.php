<!DOCTYPE html>
<html>
<head>
    <title>Student Details</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            border: 1px solid #dddddd;
            text-align: left;
            padding: 8px;
        }
        th {
            background-color: #f2f2f2;
        }
    </style>
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

// Retrieving data from the database
$sql = "SELECT * FROM students";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // Outputting data in a table
    echo "<h2>Student Details</h2>";
    echo "<table>";
    echo "<tr><th>ID</th><th>Name</th><th>Email</th><th>Actions</th></tr>";
    while($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td>" . $row["id"] . "</td>";
        echo "<td>" . $row["name"] . "</td>";
        echo "<td>" . $row["email"] . "</td>";
        echo "<td>";
        echo "<a href='update.php?id=" . $row["id"] . "'>Update</a> ";
        echo "<a href='delete.php?id=" . $row["id"] . "'>Delete</a>";
        echo "</td>";
        echo "</tr>";
    }
    echo "</table>";
} else {
    echo "0 results";
}

$conn->close();
?>

<!-- Insert Button -->
<form action="create.php" method="post">
    <input type="submit" value="Insert">
</form>

</body>
</html>
