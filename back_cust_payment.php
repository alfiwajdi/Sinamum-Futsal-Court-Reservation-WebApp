<?php
    session_start();
    require_once "config.php";

    if($_SERVER["REQUEST_METHOD"] == "GET"){
        $cust_id = $_SESSION['user'];
        $a = 1;
        //trim and mysqli_real_escape_string for all input retrieve
        $id = mysqli_real_escape_string($mysqli, trim($_GET["id"]));

        try{
        // Prepare statement
        $stmt = mysqli_prepare($mysqli, "UPDATE events SET make_payment = ? WHERE id = ? AND cust_id = ?");
        
        //Bind statement
        mysqli_stmt_bind_param($stmt, "iss", $a, $id, $cust_id);

        //Executing statement
        mysqli_stmt_execute($stmt);
    
        //Check if row = 0, exit. Else, success
        if(mysqli_stmt_affected_rows($stmt) == 0 || mysqli_stmt_affected_rows($stmt) > 1){
            invalid_payment();
            //echo mysqli_stmt_affected_rows($stmt);

        } else if(mysqli_stmt_affected_rows($stmt) < 0){
            invalid_payment();

        } else{
            //Redirect to user profile
            success_payment();
            //echo mysqli_stmt_affected_rows($stmt);
        }

        //Closing statement
        mysqli_stmt_close($stmt);

        //Closing connection
        mysqli_close($mysqli);

        } catch (Exception $e) {echo 'Caught exception: '.  getMessage($e);} //catch exception
    }

    // if login successful
    function success_payment(){
        header("location: cust_homepage.php?payment=TRUE");
    
    }

    //if login invalid
    function invalid_payment() {
        header("location: cust_homepage.php?payment=FALSE");
      }

?>