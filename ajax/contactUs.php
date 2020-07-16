<?php

  // connect to database
include ('../config/connection.php');

// Error messages;
$EnterName = "<h6>Enter Your Name</h6>";
$EnterEmail = "<h6>Enter Your Email</h6>";
$EnterValidEmail = "<h6>Enter Valid Email</h6>";
$EnterMessage = "<h6>Please Write Your Message To Send It</h6>";

// Define varibles of POST and other
$name = $_POST["name"];
$email = $_POST["email"];
$sendMessage = $_POST["message"];
$message = "";

// Searching for form errors
if(empty($name)){
 $message .= $EnterName;
}else{
    $name = filter_var($name, FILTER_SANITIZE_STRING);
}
if(empty($email)){
    $message .= $EnterEmail;
}else{
    $email = filter_var($email,FILTER_SANITIZE_EMAIL);
    if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
        $message .= $EnterValidEmail; 
    }
}
if(empty($sendMessage)){
 $message .= $EnterMessage;
}else{
    $sendMessage = filter_var($sendMessage, FILTER_SANITIZE_STRING);
}

// checking if there any form errors !
if(!($message === "")){
    echo "<div class='alert alert-danger'>$message</div>";
    exit();
}
// No Errors !
// Prepare  variables for the queries

$name = mysqli_real_escape_string($link,$name);
$email = mysqli_real_escape_string($link,$email);
$sendMessage = mysqli_real_escape_string($link,$sendMessage);
    
$sql = "INSERT INTO `contact_us`(`email`, `name`, `message`) VALUES ('$email','$name','$sendMessage')";
$result = mysqli_query($link, $sql);
if(!$result){
     echo '<div class="alert alert-danger">Error running the query!</div>';
    exit;
}
    echo "success";

?>