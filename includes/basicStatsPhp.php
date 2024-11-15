
<?php
    include '/Applications/XAMPP/xamppfiles/htdocs/LMS/connection.php';

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