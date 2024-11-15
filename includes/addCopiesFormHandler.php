<?php
if($_SERVER["REQUEST_METHOD"]=="POST"){
    $book_id=htmlentities($_POST["book_id"]);
    $additional_copies=htmlentities($_POST["additional_copies"]);

    // Database Connection
    include '/Applications/XAMPP/xamppfiles/htdocs/LMS/connection.php';

    $books_update_sql= "UPDATE `BOOKS` SET `COPIES`=`COPIES`+ '$additional_copies' WHERE `B_ID`= '$book_id';";

    if($conn->query($books_update_sql)){
        echo '<script>alert("Copies Added Successfully"); 
                    window.location.href = "../components/booksPage.php";</script>';
    }
}else{
    header("Location: ../components/booksPage.php");
}