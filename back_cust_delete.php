<?php
session_start();
require_once "config.php";

if($_SERVER["REQUEST_METHOD"] == "GET"){
    $id = $_GET['id'];

    try{
        // Prepare statement
        $stmt = mysqli_prepare($mysqli, "DELETE FROM events WHERE id = ?");
        
        //Bind statement
        mysqli_stmt_bind_param($stmt, "s", $id);

        //Executing statement
        mysqli_stmt_execute($stmt);
    
        //Check if row = 0, exit. Else, success
        if(mysqli_stmt_affected_rows($stmt) == 0 || mysqli_stmt_affected_rows($stmt) > 1){
            invalid_delete();
            //echo mysqli_stmt_affected_rows($stmt);

        } else if(mysqli_stmt_affected_rows($stmt) < 0){
            invalid_delete();

        } else{
            //Redirect to user profile
            success_delete();
            //echo mysqli_stmt_affected_rows($stmt);
        }

        //Closing statement
        mysqli_stmt_close($stmt);

        //Closing connection
        mysqli_close($mysqli);

        } catch (Exception $e) {echo 'Caught exception: '.  getMessage($e);} //catch exception
    }
    
    // if delete successful
    function success_delete(){
        header("location: cust_homepage.php?delete=TRUE");
        
    }

    //if delete invalid
    function invalid_delete($category) {
        header("location: cust_homepage.php?delete=FALSE");       
    }

?>