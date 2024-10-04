<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/index.css?v=<?php echo time();?>">
    <link rel="stylesheet" href="./css/navbar.css?v=<?php echo time();?>">
    <link rel="stylesheet" href="./css/homepage.css?v=<?php echo time();?>">
    <!-- the text placed after css file name will make sure the css file is force reloaded because the css files are not loaded properly many times -->
    <title>LMS</title>
</head>
<!-- Including all the required variables -->
<?php
    include './includes/basicStatsPhp.php';
?>
<body>
    <div class="container">
        <div class="navbar">
            <ul>
                <li><a href="./components/studentPage.php">Students</a></li>
                <li><a href="./components/booksPage.php">Books</a></li>
                <li><a href="#">Staff Info</a></li>
            </ul>
        </div>
        <div class="home" id="home_section">
            <div class="homeContainer">
                <h1>Ramanujan College's LMS</h1>
                <div class="basicStatsContainer">
                    <h2 class="basicStatsHeading">Quick Glimpses:</h2>
                    <div class="basicStatsBox">Students Enrolled: <p><?php echo $student_count ?></p></div>
                    <div class="basicStatsBox">Total Books: <p><?php echo $books_count ?></p></div>
                    <div class="basicStatsBox">Issued Books: <p><?php echo $issued_books_count ?></p></div>
                </div>
                <div class="homeAbout">
                    <h2>Ramanujan College Library</h2>
                    <p>“Library is the heart of educational institutions. Well functioning heart keeps the body healthy and lively. Efficient library creates healthy educational atmosphere”- Dr. S.R. Ranganathan
                        Welcome to the Ramanujan College library which is one of the academic resources support facility for faculty and students of the college. The library is fully automated with RFID technology integrated with KOHA library open source software. It is well equipped with resources in the form of books, journals, magazines, newspapers and online resources. The library is fully air-conditioned, IT enabled and under CCTV surveillance. It has separate reading rooms for faculty and students. All students, faculty and staff of the college can access the library by taking on its membership. The library homepage will direct you to information on library rules, services, staff, timings, webopac etc.
                        We invite you to use the library and its resources.</p>
                </div>
            </div>
            
        </div>
    </div>
    
</body>
</html>