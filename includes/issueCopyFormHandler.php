<?php
if($_SERVER["REQUEST_METHOD"]=="POST"){
    $student_roll_no=htmlentities($_POST['s_id']);
    $book_id=htmlentities($_POST["b_id"]);

    if(empty($student_roll_no or $book_id)){
        header("Location: ../components/booksPage.php");

    }else{
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

        // Checking if student exists or not 

        $search_Sql = "SELECT * FROM `STUDENT` WHERE ROLL_NO='$student_roll_no';";
        $result = $conn->query($search_Sql);
        if ($result->num_rows == 0) {
            $conn->close();
            echo '<script>alert("Student Does  Not Exists"); 
                window.location.href = "../components/booksSearchByNameResult.php";</script>';
        }

        //check if student can issue a new book or not 
        $search_Sql = "SELECT `BOOKS_ISSUED` FROM `STUDENT` WHERE ROLL_NO='$student_roll_no';";
        $result = $conn->query($search_Sql);
        if ($result->num_rows> 0) {
            $row = $result->fetch_assoc();
            $issued = $row["BOOKS_ISSUED"];
            if($issued==4){
                $conn->close();
                echo '<script>alert("Student has already issued maximum allowed numbers of books."); 
                window.location.href = "../components/booksSearchByNameResult.php";</script>';
            }else{
                // Now we will check if the student already has the same book issued
                $issued_query = "SELECT * FROM `ISSUE` WHERE `B_ID`='$book_id' AND `ROLL_NO`='$student_roll_no';";
                $issued_result = $conn->query($issued_query);
                if ($issued_result->num_rows > 0) {
                    $conn->close();
                    echo '<script>alert("Student has already issued the same book."); 
                        window.location.href = "../components/booksSearchByNameResult.php";</script>';
                }
            }
        }

        // By this point we have made sure that the student exists, can issue more books and has issued the same book, also the option to issue a book is enabled only if we have enough copies which means that we have all the prerequisites for issuing a copy to the student.

        $insert_sql= "INSERT INTO `ISSUE`(`B_ID`, `ROLL_NO`, `DATE_OF_ISSUE`) VALUES ('$book_id','$student_roll_no',CURRENT_DATE());";
        $update_student= "UPDATE `STUDENT` SET`BOOKS_ISSUED`= `BOOKS_ISSUED`+1 WHERE `ROLL_NO`='$student_roll_no';";
        
        if($conn->query($insert_sql) and $conn->query($update_student)){
            $conn->close();
            echo '<script>alert("Issue Successful!!"); 
                        window.location.href = "../components/booksPage.php";</script>';
        }
    
        $conn->close();
    }
}else{
    header("Location: ../components/booksPage.php");
}