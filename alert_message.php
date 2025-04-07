<?php
function alert_login(){
    $success = null;
    if($_SERVER["REQUEST_METHOD"] == "GET"){
        if(isset($_GET['login'])){
            $success = $_GET['login'];
            if($success == "TRUE"){
                $user = $_SESSION['user'];
                echo "<script>";
                echo "alert('Welcome $user')";
                echo "</script>";
                }
        }

        else if(isset($_GET['logout'])){
            $success = $_GET['logout'];
            if($success == "TRUE"){
                echo "<script>";
                echo "alert('Session has expired. You are logged out!')";
                echo "</script>";
            }
        }
    }
}

function alert_register(){
    $success = null;
    if($_SERVER["REQUEST_METHOD"] == "GET"){
        if(isset($_GET['register'])){
            $success = $_GET['register'];
            if($success == 'TRUE'){
                echo "<script>";
                echo "alert('Register Successful!')";
                echo "</script>";
            } else if($success == "emailInUse"){
                echo "<script>";
                echo "alert('Email in Use!')";
                echo "</script>";
            } else{
                echo "<script>";
                echo "alert('Register Failed!')";
                echo "</script>";
            }
        }
    }
}

function alert_payment(){
    $success = null;
    if($_SERVER["REQUEST_METHOD"] == "GET"){
        if(isset($_GET['payment'])){
            $success = $_GET['payment'];
            if($success == "TRUE"){
                echo "<script>";
                echo "alert('Payment Succesful!')";
                echo "</script>";
            } else{
                echo "<script>";
                echo "alert('Payment Failed!')";
                echo "</script>";
            }
        }
    }
}

function alert_update(){
    $success = null;
    if($_SERVER["REQUEST_METHOD"] == "GET"){
        if(isset($_GET['update'])){
            $success = $_GET['update'];
            if($success == 'TRUE'){
                echo "<script>";
                echo "alert('Update Successful!')";
                echo "</script>";
            } else{
                echo "<script>";
                echo "alert('Update Failed!')";
                echo "</script>";
            }
        }
    }
}

function alert_delete(){
    $success = null;
    if($_SERVER["REQUEST_METHOD"] == "GET"){
        if(isset($_GET['delete'])){
            $success = $_GET['delete'];
            if($success == 'TRUE'){
                echo "<script>";
                echo "alert('Delete Successful!')";
                echo "</script>";
            } else{
                echo "<script>";
                echo "alert('Delete Failed!')";
                echo "</script>";
            }
        }
    }
}

function alert_approval(){
    $success = null;
    if($_SERVER["REQUEST_METHOD"] == "GET"){
        if(isset($_GET['approval'])){
            $success = $_GET['approval'];
            if($success == "TRUE"){
                echo "<script>";
                echo "alert('Approval Successful!')";
                echo "</script>";
            } else{
                echo "<script>";
                echo "alert('Approval Failed!')";
                echo "</script>";
            } 
        }
    }
}
?>