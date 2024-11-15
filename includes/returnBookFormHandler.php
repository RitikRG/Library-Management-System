<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/index.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="../css/paymentGateway.css?v=<?php echo time(); ?>">
    <title>Return Confirmation page</title>
</head>
<body>
    <?php
    if($_SERVER["REQUEST_METHOD"]=="POST"){
        $student_roll_no=htmlentities($_POST['roll_no']);
        $book_id=htmlentities($_POST["book_id"]);
        $date_of_issue=htmlentities($_POST["date_of_issue"]);

        //Here we do not need to do the empty checks because the data in this file is recieved from the search results file where majority of the conditions are already in-place
        
        // Database Connection
        
        include '/Applications/XAMPP/xamppfiles/htdocs/LMS/connection.php';

        // Getting current date from the server
        $curr_date_query = "SELECT CURRENT_DATE() AS CD;";
        $result = $conn->query($curr_date_query);
        $row = $result->fetch_assoc();
        $curr_date=$row["CD"];

        // Check if there is any late fee or not 
        $days_query="SELECT DATEDIFF(CURRENT_DATE(),'$date_of_issue') AS DateDiff;";
        $result = $conn->query($days_query);
        $row = $result->fetch_assoc();
        $no_of_days=$row["DateDiff"];
        
        if($no_of_days>14){
            // Since there is a late fee that has to be paid we will integrate a payment option here....
            $amount = ($no_of_days-14)*2;
            $conn->close();
            echo 
            "<div class='gatewayContainer'>
                <h2>Amount Due: <span>₹".$amount."</span></h2>
                <h4>Scan the UPI code to pay.</h4>
                <img src='../assets/GooglePay_QR.png' alt='Qr Code'>
                <div class='pgBtnContainer'>
                <form action='../components/studentPage.php'>
                    <button id='paymentCancelBtn' type='submit'>Cancel Return</button>
                </form>
                <form action='./returnBookFormHandler.php' method='post'>
                    <button id='paymentConFirmationBtn'>Payment Success</button>
                
                    <input type='hidden' name='book_id' value='".$book_id."'>
                    <input type='hidden' name='roll_no' value='".$student_roll_no."'>
                    <input type='hidden' name='date_of_issue' value='".$curr_date."'> 
                </form>
                </div>
            </div>";
        }else{
            // deleting issue data;
            $issue_delete_sql = "DELETE FROM `ISSUE` WHERE `B_ID`='$book_id' AND `ROLL_NO`='$student_roll_no';";
            $student_update_query= "UPDATE `STUDENT` SET `BOOKS_ISSUED`= `BOOKS_ISSUED`-1 WHERE `ROLL_NO`='$student_roll_no';";
            if($conn->query($issue_delete_sql) and $conn->query($student_update_query)){
                echo '<script>alert("Book Returned Successfully"); 
                            window.location.href = "../components/studentPage.php";</script>';
            }else{
                echo '<script>alert("Some Error Occurred"); 
                            window.location.href = "../components/studentPage.php";</script>';
            }
        }


        

        //Later on here will go the conditions like due payment and stuffs
        $conn->close();

    }else{
        header("Location: ../components/studentPage.php");
    }
    ?>

</body>
</html>

