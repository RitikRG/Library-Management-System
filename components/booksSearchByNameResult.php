<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/index.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="../css/navbar.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="../css/booksSearchResult.css?v=<?php echo time(); ?>">
    <title>Result</title>
</head>
<!-- Php Section -->
<?php
// The following condition will make sure user can't access this php file using url
    if($_SERVER["REQUEST_METHOD"]=="POST"){       
        $book_name= htmlentities($_POST['bookName']);

        if(empty($book_name)){
            header("Location: ./booksPage.php");
        }else{
            // Database Connection
            $servername = "";
            $username = "";
            $password = "";
            $dbname = "";

            // Variables for values
            $author="";
            $copies=0;
            $issued=0;
            $remaining=0;

            // Create connection
            $conn = new mysqli($servername, $username, $password, $dbname);

            // Check connection
            if ($conn->connect_error) {
                echo "error";
                die("Connection failed: " . $conn->connect_error);
            }

            // Search Reuslt 
            $search_Sql = "SELECT * FROM `BOOKS` WHERE BOOK_NAME='$book_name';";
            $result = $conn->query($search_Sql);
            if ($result->num_rows > 0) {
                $row = $result->fetch_assoc();

                $b_id=$row["B_ID"];
                $author=$row["AUTHOR"];
                $copies=$row["COPIES"];

                $issue_Search_Sql = "SELECT count(*) FROM `ISSUE` WHERE B_ID='$b_id';";
                $issue_result = $conn->query($issue_Search_Sql);

                if($issue_result->num_rows > 0){
                    while($issue_row = $issue_result->fetch_assoc()) {
                        $issued = $issue_row["count(*)"];
                    }
                    
                }

                $remaining=$copies-$issued;

            }else{
                echo '<script>alert("Book Not Found"); 
                    window.location.href = "../components/booksPage.php";</script>';
            }
        }
    }else{
        header("Location: ./booksPage.php");
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
        <div class="booksSearchResultContainer">
            <h2>Search Results</h2>
            <div class="optionsContainer">
                <div class="bookInfo">
                    <p>Book Name: <span><?php echo $book_name ?></span></p>
                    <p>Author: <span><?php echo $author ?></span></p>
                    <p>Copies: <span><?php echo $copies ?></span></p>
                    <p>Issued: <span><?php echo $issued ?></span></p>
                    <p>Remaining: <span><?php echo $remaining ?></span></p>
                </div>
                <!-- We will enable the option to issue a copy only if remaining copies are more than 0 -->
                <?php 
                    if($remaining>0){
                        echo '<div class="issueContainer">
                            <h4>Issue A Copy To:</h4>
                            <form action="../includes/issueCopyFormHandler.php" method="post">
                                <input type="text" name="s_id" id="s_id" placeholder="Roll Number" required>
                                <input type="hidden" name="b_id" value="'.$b_id.'">
                                <button type="submit">Issue</button>
                            </form>
                        </div>';
                    }
                ?>
                
                <div class="addCopiesContainer">
                    <h4>Add Copies</h4>
                    <form action="../includes/addCopiesFormHandler.php" method="post">
                        <input type="number" name="additional_copies" id="additional_copies" placeholder="Copies">
                        <input type="hidden" name="book_id" value="<?php echo $b_id ?>">
                        <button type="submit">+</button>
                    </form>
                </div>
            </div>
            
        </div>
    </div>
    
    <?php include './homeBtn.php' ?>

    <?php $conn->close(); ?>
    
</body>
</html>