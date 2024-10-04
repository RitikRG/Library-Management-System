<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <link rel="stylesheet" href="../css/index.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="../css/navbar.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="../css/searchResult.css?v=<?php echo time(); ?>">
    <title>Search Results</title> 
</head>
<!-- Php Section -->
<?php
// The following condition will make sure user can't access this php file using url
    if($_SERVER["REQUEST_METHOD"]=="POST"){
        // htmlentities will make sure  that users cant isert sql using the form into our website 
        $student_id= htmlentities($_POST['student_id']);
        
        if (empty($student_id)){
            // This if will make sure that if someone provided empty field by changing front end they cant manipulate the database
            header("Location: ./studentPage.php");
        }else{
            // Database Connection
            $servername = "";
            $username = "";
            $password = "";
            $dbname = "";


            //Variables for data
            $student_roll_no="Default";
            $student_name="Default";
            $student_course="Default";
            $student_year="Default";
            $student_books_issued="Default";

            // Create connection
            $conn = new mysqli($servername, $username, $password, $dbname);

            // Check connection
            if ($conn->connect_error) {
                echo "error";
                die("Connection failed: " . $conn->connect_error);
            }

            // Search results;

            $search_Sql = "SELECT * FROM `STUDENT` WHERE ROLL_NO='$student_id';";
            $result = $conn->query($search_Sql);
            if ($result->num_rows > 0) {
                $row = $result->fetch_assoc();

                $student_roll_no=$row["ROLL_NO"];
                $student_name=$row["STUDENT_NAME"];
                $student_course=$row["COURSE"];
                $student_year=$row["YEAR"];
                $student_books_issued=$row["BOOKS_ISSUED"];

                
            }else{
                echo '<script>alert("Student Does  Not Exists"); 
                    window.location.href = "../components/studentPage.php";</script>';
            }
            
        }
        
    }else{
        header("Location: ./studentPage.php");
    }

?>
<body>
    <div class="container">
        <div class="navbar">
            <ul>
                <li><a href="./studentPage.php">Students</a></li>
                <li><a href="./booksPage.php">Books</a></li>
                <li><a href="#">Staff Info</a></li>
            </ul>
        </div>
        <div class="searchResultContainer">
            <div id="info">
                <p>Name: <span><?php echo $student_name ?></span></p>
                <p>Roll No: <span><?php echo $student_roll_no ?></span></p>
                <p>Course: <span><?php echo $student_course ?></span></p>
                <p>Year: <span><?php echo $student_year ?></span></p>
            </div>
            <div id="booksContainer">
                <div id="tableHead">
                    <h3>Books</h3>
                    <h4><?php echo $student_books_issued ?>/4</h4>
                </div>
                
                <table>
                    <tr>
                        <th>Book Title</th>
                        <th>Author</th>
                        <th>Issue Date</th>
                        <th>Return</th> 
                    </tr>
                    <?php
                        //books info 
                        $books_sql = "SELECT * FROM `ISSUE` WHERE `Roll_No`='$student_roll_no';";
                        $issued_books_details = $conn->query($books_sql);
                        if ($issued_books_details->num_rows > 0) {
                            
                            while($row = $issued_books_details->fetch_assoc()){
                                $book_id=$row["B_ID"];
                                $particular_book_info = "SELECT * FROM `BOOKS` WHERE `B_ID`='$book_id';";
                                $result = $conn->query($particular_book_info);

                                if ($result->num_rows > 0) {
                                    while($book_row = $result->fetch_assoc()){
                                        echo "<tr>";
                                        echo "<td>".$book_row["BOOK_NAME"]."</td>";
                                        echo "<td>".$book_row["AUTHOR"]."</td>";
                                        $date_of_issue="";
                                        $issued_query = "SELECT * FROM `ISSUE` WHERE `B_ID`='$book_id' AND `ROLL_NO`='$student_roll_no';";
                                        $issued_result = $conn->query($issued_query);
                                        if ($issued_result->num_rows > 0) {
                                            while($issue_row = $issued_result->fetch_assoc()){
                                                $date_of_issue=$issue_row["DATE_OF_ISSUE"];    
                                                echo "<td class='issueDateTD'>".$date_of_issue."</td>";
                                            }
                                        }
                                
                                        echo "<td><form action='../includes/returnBookFormHandler.php' method='post' id='returnForm' >
                                                    <button class='returnButton' value='returnBook'>Return</button>
                                                    <input type='hidden' name='book_id' value='".$book_id."'>
                                                    <input type='hidden' name='roll_no' value='".$student_roll_no."'>
                                                </form></td>";
                                        echo "</tr>";
                                    };
                                }
                                
                            }
                        }

                        $conn->close();
                    ?>
                </table>
                
            </div>
        </div>
    </div>
    
    <?php include './homeBtn.php' ?>
</body>
</html>