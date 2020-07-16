<?php 

//Connect to dataBase
include ('../config/connection.php');

//Check users inputs
    //Define Error messages;
$EnterEmail = "<h6>Enter Your Email</h6>";
$EnterValidEmail = "<h6>Enter Valid Email</h6>";

    //Define the variables from ajax and other
$email = $_POST['EmailForgetPassword'];
$message = "";


// Searching for form errors
if(empty($email)){
    $message .= $EnterEmail;
}else{
    $email = filter_var($email,FILTER_SANITIZE_EMAIL);
    if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
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
$email = mysqli_real_escape_string($link,$email);


//If username or password is incorrect 
$sql = "SELECT * FROM users WHERE email = '$email'";
if(!($result = mysqli_query($link, $sql))){
     echo '<div class="alert alert-danger">Error running the query!</div>';
    exit;
}
$results = mysqli_num_rows($result);
if(!$results){
    echo '<div class="alert alert-danger">is email is not regestered in our system!</div>'; 
    exit;
}
// prepare the quirey
$row = mysqli_fetch_assoc($result);
$user_id = $row['user_id'];
$uniqueKey = bin2hex(random_bytes(6));
$timeExpire = time() +86400; // expire at 24 hour


$sql = "INSERT INTO forget_password (user_id, unique_key, time, status) VALUES ('$user_id','$uniqueKey','$timeExpire','pending')";
$result = mysqli_query($link,$sql);
if(!$result){
    echo "<div class='alert alert-danger'>There was an error updating the users details in the database!</div>";
    exit;
}


//Send the user an email with a link to forgetPassword.php with their email and unique code

// set the variables to the mail()
$to = $email;
$subject = "Reset Your Password";
$message = "Please click on this link to reset your password:\n\n";
$message .= "http://localhost/ajax/ResetPassword.php?email=". urlencode($email) . "&key=$uniqueKey";
$SC = "From: Techincal Support Team Of NotePad";
if(mail($to,$subject,$message,$SC)){
    echo "<div class='alert alert-success'>Please Check your email to Reset your password</div>";
}else{
     echo "<div class='alert alert-danger'>We Couldn't send the mail to your email please try again later!</div>";
    exit;
}

?>