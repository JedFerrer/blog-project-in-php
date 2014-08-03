<?php
    //Connection to Database
    $con = @mysqli_connect("localhost","root","","blog-sample");

    // Check connection
    if (mysqli_connect_errno()) {
        // echo "Failed to connect to MySQL: " . mysqli_connect_error();
        die('Could not connect: ' . mysql_error());
    } else {
        // echo "Successfully connected MySQL database...";
        // echo "<br />";
    }

?>