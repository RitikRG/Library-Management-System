<?php
// The following condition will make sure user can't access this php file using url
if($_SERVER["REQUEST_METHOD"]=="POST"){
    // htmlentities will make sure  that users cant isert sql using the form into our website 
    $studentName= htmlentities($_POST['name']);
    $studentRollNo= htmlentities($_POST['rollNo']);
    $studentYear= htmlentities($_POST['year']);
    $studentCourse= htmlentities($_POST['course']);
    
    if (empty($studentName) or empty($studentRollNo) or empty($studentYear) or empty($studentCourse) ){
        // This if will make sure that if someone provided empty field by changing front end they cant manipulate the database
        header("Location: ../components/newStudentRegistration.php");
    }else{
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

        $search_Current_Sql = "SELECT * FROM `STUDENT` WHERE ROLL_NO='$studentRollNo';";
        $result = $conn->query($search_Current_Sql);
        if ($result->num_rows > 0) {
            // Here we are injecting javascript using php alert generates the alert box and windows.location.href redirects the user back to the new registration page
            echo '<script>alert("Student Already Exists"); 
                  window.location.href = "../components/newStudentRegistration.php";</script>';
        }else{
            $insertSql = "INSERT INTO `STUDENT`(`ROLL_NO`, `STUDENT_NAME`, `COURSE`, `YEAR`) VALUES ('$studentRollNo','$studentName','$studentCourse','$studentYear');";
            if ($conn->query($insertSql) === TRUE) {
                echo '<script>alert("Student Registered Successfully"); 
                  window.location.href = "../components/newStudentRegistration.php";</script>';
            }else{
                echo '<script>alert("Invalid Fields.. Please use proper Required format."); 
                  window.location.href = "../components/newStudentRegistration.php";</script>';
            }
        }



        $conn->close();
    }
    
}else{
    header("Location: ../components/newStudentRegistration.php");
}