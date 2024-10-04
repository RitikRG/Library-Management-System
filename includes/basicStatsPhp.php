<!-- This php file contains all the variabbles of a single session -->

<?php
    $servername = "";
    $username = "";
    $password = "";
    $dbname = "";

    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check connection
    if ($conn->connect_error) {
        echo "error";
        die("Connection failed: " . $conn->connect_error);
    }

    $student_sql = "SELECT count(*) FROM STUDENT";
    $result = $conn->query($student_sql);
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $student_count=$row["count(*)"];
    }


    $books_sql = "SELECT SUM(COPIES) FROM BOOKS;";
    $result = $conn->query($books_sql);
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $books_count= $row["SUM(COPIES)"];
    }

    $issued_books_sql = "SELECT COUNT(*) FROM ISSUE;";
    $result = $conn->query($issued_books_sql);
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $issued_books_count= $row["COUNT(*)"];
    }

    $conn->close();