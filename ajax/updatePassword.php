<?php 
//Start The Session
session_start();
//Connect to dataBase
include ('../config/connection.php');

//Check users inputs
    //Define Error messages;
$EnterPassword1 = "<h6>Enter Your Old Password</h6>";
$EnterValidPassword = "<h6>The New Password should be at least 10 length contaning 4 digit  one capital letter and one small</h6>";
$EnterPassword2 = "<h6>Enter Your New Password</h6>";

    //Define the variables from ajax and other
$oldPassword = $_POST['oldPassword'];
$newPassword = $_POST['newPassword'];
$user_id = $_SESSION['user_id'];
$message = "";


// Searching for form errors
if(empty($oldPassword)){
    $message .= $EnterPassword1;
}else{
    $oldPassword = filter_var($oldPassword,FILTER_SANITIZE_STRING);
            if(empty($newPassword)){
                $message .= $EnterPassword2;
            } else{
                $newPassword = filter_var($newPassword,FILTER_SANITIZE_STRING);
            if(!(preg_match('/(?=^.{10,}$)(?=.{4,}\d)(?=.*[a-z])(?=.*[A-Z])/',$newPassword))){
                       $message .= $EnterValidPassword;
                } //regex filter
            }
}


// checking if there any form errors !
if(!($message === "")){
    echo "<div class='alert alert-danger'>$message</div>";
    exit();
}



// No Errors !
// Prepare  variables for the queries
$oldPassword = mysqli_real_escape_string($link,$oldPassword);
    // hash the Password
$oldPassword = hash('sha256',$oldPassword);
$newPassword = mysqli_real_escape_string($link,$newPassword);
    // hash the Password
$newPassword = hash('sha256',$newPassword);
//If the Old Password is incorrect 
$sql = "SELECT * FROM users WHERE password = '$oldPassword'";
if(!($result = mysqli_query($link, $sql))){
     echo '<div class="alert alert-danger">Error running the query!</div>';
    exit;
}
$results = mysqli_num_rows($result);
if(!$results){
    echo '<div class="alert alert-danger">Wrong password !</div>'; 
    exit;
}
//Update password 
$sql = "UPDATE `users` SET `password`='$newPassword' WHERE `password`='$newPassword'";
if(!($result = mysqli_query($link, $sql))){
     echo '<div class="alert alert-danger">Error running the query!</div>';
    exit;
}


echo "<div class='alert alert-success'><h6>We Updated Your Password Successfully.</h6></div> ";
