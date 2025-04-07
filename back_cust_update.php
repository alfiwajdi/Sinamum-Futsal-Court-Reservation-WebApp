<?php
    session_start();
    require_once "config.php";

    if($_SERVER["REQUEST_METHOD"] == "POST"){
        $cust_id = $_SESSION['user'];

        //trim and mysqli_real_escape_string for all input retrieve
        $id = mysqli_real_escape_string($mysqli, trim($_POST["id"]));
        $name = mysqli_real_escape_string($mysqli, trim($_POST["name"]));
        $phone = mysqli_real_escape_string($mysqli, trim($_POST["phone"]));
        $start = mysqli_real_escape_string($mysqli, trim($_POST["start"]));
        $end = mysqli_real_escape_string($mysqli, trim($_POST["end"]));
        $resource_id = mysqli_real_escape_string($mysqli, trim($_POST["resource_id"]));

        $date1 = new DateTime($start);
        $date2 = new DateTime($end);

        $diff = $date2->diff($date1);

        $hours = $diff->h;
        $hours = $hours + ($diff->days*24);
        $total_payment = $hours*80;
        $deposit_payment = $total_payment*0.3;

        try{
        // Prepare statement
        $stmt = mysqli_prepare($mysqli, "UPDATE events SET name=?, phone=?, start=?, end=?, resource_id=?, total_payment = ?, deposit_payment = ? WHERE id = ? AND cust_id = ?");
        
        //Bind statement
        mysqli_stmt_bind_param($stmt, "sssssddss", $name, $phone, $start, $end, $resource_id, $total_payment, $deposit_payment, $id, $cust_id);

        //Executing statement
        mysqli_stmt_execute($stmt);
        //echo mysqli_stmt_affected_rows($stmt);
        //Check if row = 0, exit. Else, success
        if(mysqli_stmt_affected_rows($stmt) == 0 || mysqli_stmt_affected_rows($stmt) > 1){
          error();
          //echo mysqli_stmt_affected_rows($stmt);
        } else if(mysqli_stmt_affected_rows($stmt) < 0){
          error();

        } else{
            //Redirect to user profile
            success();
            //echo mysqli_stmt_affected_rows($stmt);
        }

        //Closing statement
        mysqli_stmt_close($stmt);

        //Closing connection
        mysqli_close($mysqli);

        } catch (Exception $e) {echo 'Caught exception: '.  getMessage($e);} //catch exception
    }

    // if login successful
    function success(){
        header("location: cust_homepage.php?update=TRUE");
    
    }

    //if login invalid
    function error() {
        header("location: cust_homepage.php?update=FALSE");
      }

?>