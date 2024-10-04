<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/index.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="../css/navbar.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="../css/newStudentRegistation.css?v=<?php echo time(); ?>">
    <title>Document</title>
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
            <form action="../includes/studentRegistrationFormHandler.php" method="post">
                <h2>New Student Registration</h2>
                <label for="name">Name:</label>
                <input type="text" id="name" name="name" required>
                <label for="rollNo">Roll No.:</label>
                <input type="text" id="rollNo" name="rollNo" required>
                <label for="year">Year:</label>
                <input type="text" name="year" id="year" required>
                <label for="course">Course</label>
                <input type="text" name="course" id="course" required>
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