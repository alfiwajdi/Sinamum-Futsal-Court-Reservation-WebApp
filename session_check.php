<?php
if(!isset($_SESSION["role"]) || !isset($_SESSION["user"]))
    header("location: frontpage.php?logout=TRUE");

function is_admin(){
    if($_SESSION["role"] != "admin"){
        echo "<script>";
        echo "window.location.href= 'cust_homepage.php?login=TRUE';";
        echo "</script>";
    }
}

function is_customer(){
    if($_SESSION["role"] != "customer"){
        echo "<script>";
        echo "window.location.href = 'admin_homepage.php?login=TRUE';";
        echo "</script>";
    }
}
?>