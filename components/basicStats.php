<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Basic stats</title>
</head>
<body>
<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "lms_database";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    echo "error";
    die("Connection failed: " . $conn->connect_error);
}

$student_sql = "SELECT count(*) FROM STUDENT";
$books_sql = "SELECT SUM(COPIES) FROM BOOKS;";

$result = $conn->query($student_sql);
if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
      echo "Students: ".$row["count(*)"];
    }
}

echo "<br>";

$result = $conn->query($books_sql);
if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
      echo "Books: ".$row["SUM(COPIES)"];
    }
}
?>
</body>
</html>