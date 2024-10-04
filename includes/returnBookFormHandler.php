<?php
if($_SERVER["REQUEST_METHOD"]=="POST"){
    $student_roll_no=htmlentities($_POST['roll_no']);
    $book_id=htmlentities($_POST["book_id"]);

    //Here we do not need to do the empty checks because the data in this file is recieved from the search results file where majority of the conditions are already in-place
    
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

    // Check if there is any late fee or not 



    // deleting issue data;

    $issue_delete_sql = "DELETE FROM `ISSUE` WHERE `B_ID`='$book_id' AND `ROLL_NO`='$student_roll_no';";
    $student_update_query= "UPDATE `STUDENT` SET `BOOKS_ISSUED`= `BOOKS_ISSUED`-1 WHERE `ROLL_NO`='$student_roll_no';";
    if($conn->query($issue_delete_sql) and $conn->query($student_update_query)){
        echo '<script>alert("Book Returned Successfully"); 
                    window.location.href = "../components/studentPage.php";</script>';
    }else{
        echo '<script>alert("Some Error Occurred"); 
                    window.location.href = "../components/studentPage.php";</script>';
    }

    //Later on here will go the conditions like due payment and stuffs
    $conn->close();

}else{
    header("Location: ../components/studentPage.php");
}