<?php
if($_SERVER["REQUEST_METHOD"]=="POST"){
    $book_id=htmlentities($_POST["book_id"]);
    $additional_copies=htmlentities($_POST["additional_copies"]);

    // Database Connection
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

    $books_update_sql= "UPDATE `BOOKS` SET `COPIES`=`COPIES`+ '$additional_copies' WHERE `B_ID`= '$book_id';";

    if($conn->query($books_update_sql)){
        echo '<script>alert("Copies Added Successfully"); 
                    window.location.href = "../components/booksPage.php";</script>';
    }
    $conn->close();
}else{
    header("Location: ../components/booksPage.php");
}