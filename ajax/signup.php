<?php
// Start Session
session_start();
// connect to database
include ('../config/connection.php');

// Error messages;
$EnterName = "<h6>Enter Your Name</h6>";
$EnterEmail = "<h6>Enter Your Email</h6>";
$EnterValidEmail = "<h6>Enter Valid Email</h6>";
$EnterPassword1 = "<h6>Enter Your Password</h6>";
$EnterValidPassword = "<h6>The Password should be at least 10 length contaning 4 digit  one capital letter and one small</h6>";
$EnterPassword2 = "<h6>Enter Confirmation Password</h6>";
$DifferentPassword  = "<h6>The Password Is Different</h6>";
$AceeptOurTerms  = "<h6>Please read and accept our terms to Sign Up</h6>";

// Define varibles of POST and other
$name = $_POST["NameSignUp"];
$email = $_POST["EmailSignUp"];
$password1 = $_POST["PasswordSignUp"];
$password2 = $_POST["Password2SignUp"];
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
if(empty($password1)){
    $message .= $EnterPassword1;
}else{
    $password1 = filter_var($password1,FILTER_SANITIZE_STRING);
 
    if(preg_match('/(?=^.{10,}$)(?=.{4,}\d)(?=.*[a-z])(?=.*[A-Z])/',$password1)){
            if(empty($password2)){
        $message .= $EnterPassword2;
        } else{
            if(!($password1 === $password2)){
                $message .= $DifferentPassword;
            }
        }
   /*regex filter*/ } else {
        $message .= $EnterValidPassword;
    }   

    
}
if(!isset($_POST["AcceptTerms"])){
    $message .= $AceeptOurTerms;
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
$password1 = mysqli_real_escape_string($link,$password1);
    // hash the Password
$password1 = hash('sha256',$password1);
// 128 bits -> 32 chracters
// 256 bits -> 64 characters
//If username exists in the users table print error
$sql = "SELECT * FROM users WHERE username = '$name'";
$result = mysqli_query($link, $sql);
if(!$result){
     echo '<div class="alert alert-danger">Error running the query!</div>';
    exit;
}
$results = mysqli_num_rows($result);
if($results){
    echo '<div class="alert alert-danger">That username is already registered. Do you want to log in?</div>'; 
    exit;
}

// If the email exist in the users table
$sql = "SELECT * FROM users WHERE email = '$email'";
$result = mysqli_query($link,$sql);
if(!$result){
    echo "<div class='alert alert-danger'>Error running the query!</div>";
    exit;
}
$results = mysqli_num_rows($result);
if($results){
    echo "<div class='alert alert-danger'>That email is already registered. Do you want to log in?</div>";
    exit;
}

//Create a unique activation code
$activationKey = bin2hex(random_bytes(16));
    //byte: unit of data = 8 bits
    //bit : 0 or 1
    //16 bytes = 16*8 = 128 bits
    // 1111 0001 -> F1  1byte -> 2hexa     16bytes -> 32 hexa     
 

//Insert user details and activation code in the users table
$sql = "INSERT INTO users (username,email,password,activation) VALUES ('$name','$email','$password1','$activationKey')";
$result = mysqli_query($link,$sql);
if(!$result){
    echo "<div class='alert alert-danger'>There was an error inserting the users details in the database!</div>";
    exit;
}
//Send the user an email with a link to activate.php with their email and activation code

// set the variables to the mail()
$to = $email;
$subject = "Confirm Your Registratoin";
$message = "Please click on this link to activate your account:\n\n";
$message .= "http://localhost/ajax/activation.php?email=". urlencode($email) . "&key=$activationKey";
$SC = "From: Techincal Support Team Of NotePad";
if(mail($to,$subject,$message,$SC)){
    echo "<div class='alert alert-success'>Thank for your registring! A confirmation email has been sent to $email. Please click on the activation link to activate your account.</div>";
}else{
     echo "<div class='alert alert-danger'>We Couldn't send the mail to your email please try again later!</div>";
    exit;
}

?>