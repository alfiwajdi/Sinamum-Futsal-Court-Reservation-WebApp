<?php
//database conneciton credentials
    $databaseHost = "localhost";
    $databaseName = "sinamum";
    $databaseUsername = "root";
    $databasePassword = "";

    //establish database connection
    $mysqli = mysqli_connect($databaseHost, $databaseUsername, $databasePassword, $databaseName);
    
    // Check connection
    if (mysqli_connect_errno()) {
        die("Connection failed: " . mysqli_connect_error());
    }
?>