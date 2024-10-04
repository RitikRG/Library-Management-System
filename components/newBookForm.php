<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/index.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="../css/navbar.css?v=<?php echo time(); ?>">
    <!-- This file is using CSS from the student registration form only because majorly the two pages are similar in nature and doing so reduces redundancy in code -->
    <link rel="stylesheet" href="../css/newStudentRegistation.css?v=<?php echo time(); ?>">
    <title>Add New Book</title>
</head>
<body>
    <div class="container">    
        <div class="navbar">
                <ul>
                    <li><a href="./studentPage.php">Students</a></li>
                    <li><a href="./booksPage.php">Books</a></li>
                    <li><a href="#">Staff Info</a></li>
                </ul>
        </div>
        <div class="newStudentRegistration">
            <form action="../includes/newBookFormHandler.php" method="post">
                <h2>New Book Registration</h2>
                <label for="book_name">Book Name:</label>
                <input type="text" id="book_name" name="book_name" required>
                <label for="author">Author Name:</label>
                <input type="text" id="author" name="author" required>
                <label for="copies">Copies:</label>
                <input type="number" name="copies" id="copies" required>
                <div class="formBtnContainer">
                    <button type="submit" class="registerBtn">Register</button>
                    <button type="reset" class="resetBtn">Reset</button>
                </div>
                
            </form>
        </div>
    </div>
    
    <?php include './homeBtn.php' ?>
    
</body>
</html>