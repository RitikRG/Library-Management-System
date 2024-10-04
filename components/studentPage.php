<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/index.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="../css/studentHome.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="../css/navbar.css?v=<?php echo time(); ?>">
    <title>Students</title>
</head>
<?php
    include '../includes/basicStatsPhp.php';
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
        <div class="studentSectionContainer">
            <h2>Student Section</h2>
            <div class="studentSectionOptionsContainer">
                <div id="searchByIdBox" class="studentSectionBox">
                    <label for="student_id">Search By ID</label>
                    <form action="./studentSearchResult.php" method="post">
                        <input type="text" placeholder="Roll Number" id="student_id" name="student_id" >
                        <button type="submit">Search</button>
                    </form>
                </div>
                <div id="newStudentRegistrationBox" class="studentSectionBox">
                    <a href="./newStudentRegistration.php"><button> <p>New Student Registration</p>&nbsp <img src="../assets/add.png" alt="add"> </button></a>
                </div>
                <div id="studentSectionBasicStats" class="studentSectionBox">
                    <p>Total Students: <span><?php echo $student_count ?></span></p>
                    <p>Total Books: <span><?php echo $books_count ?></span></p>
                    <p>Books Issued: <span><?php echo $issued_books_count ?></span></p>
                </div>
            </div>
            
        </div>
    </div>
    <?php include './homeBtn.php' ?>
    
</body>
</html>