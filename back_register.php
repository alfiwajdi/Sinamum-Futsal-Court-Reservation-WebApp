<?php
    session_start();
    require_once "config.php";

    if($_SERVER["REQUEST_METHOD"] == "POST"){

        //trim and mysqli_real_escape_string for all input retrieve
        $cust_id = mysqli_real_escape_string($mysqli, trim($_POST["cust_id"]));
        $name = mysqli_real_escape_string($mysqli, trim($_POST["name"]));
        $pass = mysqli_real_escape_string($mysqli, trim($_POST["pass"]));

        //encrypt pass
        $password = hash("sha256", $pass);
        try{
        // Prepare statement
        $stmt = mysqli_prepare($mysqli, "INSERT INTO customer(cust_id, name, password) VALUES (?,?,?)");
        
        //Bind statement
        mysqli_stmt_bind_param($stmt, "sss", $cust_id, $name, $password);

        //Executing statement
        mysqli_stmt_execute($stmt);
    
        //Check if row = 0, exit. Else, success
        if(mysqli_stmt_affected_rows($stmt) == 0 || mysqli_stmt_affected_rows($stmt) > 1){
            invalid_create();
            //echo mysqli_stmt_affected_rows($stmt);
        } else if(mysqli_stmt_affected_rows($stmt) < 0){
            invalid_create();
            //echo mysqli_stmt_affected_rows($stmt);
        } else{
            //Redirect to Login Page
            success_create();
            //echo mysqli_stmt_affected_rows($stmt);
        }

        //Closing statement
        mysqli_stmt_close($stmt);

        //Closing connection
        mysqli_close($mysqli);

        } catch (Exception $e) {echo 'Caught exception: '.  getMessage($e);} //catch exception
    }
    
    // if successful
    function success_create(){
        header("location: cust_login.php?register=TRUE");
    }

    //if invalid
    function invalid_create() {
        header("location: register.php?register=FALSE");
      }

    //if cust_id exist
    function invalid_email() {
        header("location: register.php?register=emailInUse");
      }
?>