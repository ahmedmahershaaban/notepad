<?php 
//Start The Session
session_start();
//Connect to dataBase
include ('../config/connection.php');

//Check users inputs
    //Define Error messages;
$EnterName = "<h6>Enter The Name</h6>";


    //Define the variables from ajax and other
$name = $_POST['ChangeName'];
$user_id = $_SESSION['user_id'];
$message = "";


// Searching for form errors
if(empty($name)){
    $message .= $EnterName;
}else{
    $name = filter_var($name,FILTER_SANITIZE_STRING);
}

// checking if there any form errors !
if(!($message === "")){
    echo "<div class='alert alert-danger'>$message</div>";
    exit();
}

// No Errors !
// Prepare  variables for the queries
$name = mysqli_real_escape_string($link,$name);

//If username or password is incorrect 
$sql = "UPDATE `users` SET `username`='$name' WHERE `user_id`='$user_id'";
if(!($result = mysqli_query($link, $sql))){
     echo '<div class="alert alert-danger">Error running the query!</div>';
    exit;
}


echo "success";
