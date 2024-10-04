<?php
// The following condition will make sure user can't access this php file using url
if($_SERVER["REQUEST_METHOD"]=="POST"){
    // htmlentities will make sure  that users cant isert sql using the form into our website 
    $book_name= htmlentities($_POST['book_name']);
    $author= htmlentities($_POST['author']);
    $copies= htmlentities($_POST['copies']);

    echo $book_name;
    echo $author;
    echo $copies;

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
    
    // Firstly we will check if the provided book already exists or not

    $checl_sql="SELECT `B_ID`, `BOOK_NAME`, `AUTHOR`, `COPIES` FROM `BOOKS` WHERE `BOOK_NAME`= '$book_name' AND `AUTHOR`= '$author';";
    $result = $conn->query($checl_sql);
    if ($result->num_rows > 0) {
        $conn->close();
        // Here we are injecting javascript using php alert generates the alert box and windows.location.href redirects the user back to the new registration page
        echo '<script>alert("Book Already Exists"); 
                window.location.href = "../components/newBookForm.php";</script>';
    }else{
        $insert_sql="INSERT INTO `BOOKS`(`BOOK_NAME`, `AUTHOR`, `COPIES`) VALUES ('$book_name','$author','$copies');";
        if($conn->query($insert_sql)){
            echo '<script>alert("Book Added Successfully"); 
                window.location.href = "../components/newBookForm.php";</script>';
        }else{
            echo '<script>alert("Some Error Occurred"); 
                window.location.href = "../components/newBookForm.php";</script>';
        }
        $conn->close();
    }
    
    $conn->close();

}else{
    header("Location: ../components/newBookForm.php");
}