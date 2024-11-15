<?php

    $servername = "lms-database.c9qqy60ial2m.ap-southeast-2.rds.amazonaws.com";
    $username = "admin";
    $password = "rg12345678aws";
    $dbname = "LMS";

    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check connection
    if ($conn->connect_error) {
        echo "error";
        die("Connection failed: " . $conn->connect_error);
    }

    