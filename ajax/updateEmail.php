<?php 
//Start The Session
session_start();
//Connect to dataBase
include ('../config/connection.php');

//Check users inputs
    //Define Error messages;
$EnterEmail = "<h6>Enter Your Email</h6>";
$EnterValidEmail = "<h6>Enter Valid Email</h6>";

    //Define the variables from ajax and other
$newEmail = $_POST['ChangeEmail'];
$user_id = $_SESSION['user_id'];
$message = "";


// Searching for form errors
if(empty($newEmail)){
    $message .= $EnterEmail;
}else{
    $newEmail = filter_var($newEmail,FILTER_SANITIZE_EMAIL);
    if(!filter_var($newEmail, FILTER_VALIDATE_EMAIL)){
        $message .= $EnterValidEmail; 
    }
}

// checking if there any form errors !
if(!($message === "")){
    echo "<div class='alert alert-danger'>$message</div>";
    exit();
}

// No Errors !
// Prepare  variables for the queries
$newEmail = mysqli_real_escape_string($link,$newEmail);
//Create a unique activation code
$activationKey = bin2hex(openssl_random_pseudo_bytes(16));




//Get the old details from the users_table to insert it into change_email with activation key
$sql = "SELECT * FROM users WHERE user_id = '$user_id'";
if(!($result = mysqli_query($link, $sql))){
     echo '<div class="alert alert-danger">Error running the query!</div>';
    exit;
}
//fetch the data
if(!($row = mysqli_fetch_assoc($result))){
      echo '<div class="alert alert-danger">Error running the query!</div>';
    exit;
}
$oldEmail = $row['email'];

 //Run query to store them in rememberme table
$sql = "INSERT INTO `change_email`(`user_id`, `old_email`, `new_email`, `activation`) VALUES ('$user_id','$oldEmail','$newEmail','$activationKey')";

if(!($result = mysqli_query($link, $sql))){
    echo '<div class="alert alert-danger">There was an error storing data to remember you next time.</div>';
    exit;
}

$to = $newEmail;
$subject = "Confirm Your New Email";
$message = "Please click on this link to Confirm that you has this account:\n\n";
$message .= "http://notepad-github.gearhostpreview.com/ajax/NewActivationEmail.php?email=". urlencode($newEmail) . "&key=$activationKey";
$SC = "From: Techincal Support Team Of NotePad";
if(mail($to,$subject,$message,$SC)){
    echo "<div class='alert alert-success'> A confirmation email has been sent to $newEmail. Please click on the activation link to Confirm your New Email.</div>";
}else{
     echo "<div class='alert alert-danger'>We Couldn't send the mail to your email please try again later!</div>";
    exit;
}

