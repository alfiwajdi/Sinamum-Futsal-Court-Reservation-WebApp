<?php
    session_start();
    require_once "config.php";

    if($_SERVER["REQUEST_METHOD"] == "POST"){
        // Check if username is empty
        if(empty(trim($_POST["user"]))){
            invalid_login();
        } else{
            $user = mysqli_real_escape_string($mysqli, trim($_POST["user"]));
        }
    
        // Check if password is empty
        if(empty(trim($_POST["pass"]))){
            invalid_login();
        } else{
            $pass = mysqli_real_escape_string($mysqli, trim($_POST["pass"]));
            $pass = hash("sha256", $pass);
        }
    
        try{
        // Prepare statement
        $stmt = mysqli_prepare($mysqli, "SELECT password FROM admin WHERE admin_id = ?");
        
        //Bind statement
        mysqli_stmt_bind_param($stmt, "s", $user);

        //Executing statement
        mysqli_stmt_execute($stmt);

        // Get result from previous execuuted statemnet
        $result = mysqli_stmt_get_result($stmt);
    
        //Check if row = 0, exit. Else, success
        if(mysqli_stmt_affected_rows($stmt) == 0 || mysqli_stmt_affected_rows($stmt) > 1){
            invalid_login();
        } else{
            //Fetch row from $result
            while ($row = mysqli_fetch_array($result))
            {
                $r = $row[0];
                 if($r == $pass){
                    $_SESSION["user"] = $user;
                    $_SESSION["role"] = "admin";
                    success_login();
                 }
                 else {
                    invalid_login();
                }
            }
        }

        //Closing statement
        mysqli_stmt_close($stmt);

        //Closing connection
        mysqli_close($mysqli);

        } catch (Exception $e) {echo 'Caught exception: '.  getMessage($e);} //catch exception
    }

    // if login successful function
    function success_login(){
        header("location: admin_homepage.php?login=TRUE");
    }

    //if login invalid function
    function invalid_login() {
        header("location: admin_login.php?login=FALSE");
      }
?>