<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/index.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="../css/navbar.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="../css/booksHome.css?v=<?php echo time(); ?>">
    <title>Books</title>
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
        <div class="bookSectionContainer">
            <h2>Books Section</h2>
            <div id="searchByAuthorBox" class="bookSectionBox">
                <label for="bookAuthor">Search By Author</label>
                <form action="./bookSearchByAuthorName.php"  method="post">
                    <input type="text" placeholder="Author Name" id="author" name="author" >
                    <button type="submit">Search</button>
                </form>
            </div>
            <div id="searchByNameBox" class="bookSectionBox">
                <label for="bookName">Search By Name</label>
                <form action="./booksSearchByNameResult.php" method="post">
                    <input type="text" placeholder="Book Name" id="bookName" name="bookName" >
                    <button type="submit">Search</button>
                </form>
            </div>
            <div id="newBookBox" class="bookSectionBox">
                <a href="./newBookForm.php"><button>Add New Books + </button></a>
            </div>
        </div>
    </div>

    
    <?php include './homeBtn.php' ?>
    
</body>
</html>