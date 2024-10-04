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
        $author= htmlentities($_POST['author']);
        
        if (empty($author)){
            // This if will make sure that if someone provided empty field by changing front end they cant manipulate the database
            header("Location: ./booksPage.php");
        }else{
            // Database Connection
            $servername = "";
            $username = "";
            $password = "";
            $dbname = "";


            //Variables for data
            $books_in_library="Default";
            $total_copies="Default";

            // Create connection
            $conn = new mysqli($servername, $username, $password, $dbname);

            // Check connection
            if ($conn->connect_error) {
                echo "error";
                die("Connection failed: " . $conn->connect_error);
            }

            // Search results;

            $search_Sql = "SELECT count(*), sum(`COPIES`) FROM `BOOKS` WHERE `AUTHOR`='$author';";
            $result = $conn->query($search_Sql);
            if (!($result->num_rows > 0)) {
                echo '<script>alert("Author Not Found"); 
                    window.location.href = "../components/booksPage.php";</script>';
            }else{
                $row = $result->fetch_assoc();
                $books_in_library = $row["count(*)"];
                $total_copies=$row["sum(`COPIES`)"];
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
                <p>Author Name: <span><?php echo $author ?></span></p>
                <p>Titles: <span><?php echo $books_in_library ?></span></p>
                <p>Total Copies: <span><?php echo $total_copies ?></span></p>
            </div>
            <div id="booksContainer">
                <table>
                    <tr>
                        <th>Book Title</th>
                        <th>Details</th>
                    </tr>
                    <?php
                        //books info 
                        $search_Sql = "SELECT * FROM `BOOKS` WHERE `AUTHOR`='$author';";
                        $books_details = $conn->query($search_Sql);
                        if ($books_details->num_rows > 0) {
                            while($row = $books_details->fetch_assoc()){
                                $book_name=$row["BOOK_NAME"];
                                echo "<tr>";
                                echo "<td>".$book_name."</td>";
                                echo "<td><form action='./booksSearchByNameResult.php' method='post'>
                                            <input type='hidden' name='bookName' value='".$book_name."'>
                                            <button class='detailsBtn' value='bookDetails' type='submit' >Details</button>
                                        </form></td>";
                                echo "</tr>";
                                    
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