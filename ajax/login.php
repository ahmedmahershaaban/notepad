<?php 
//Start The Session
session_start();
//Connect to dataBase
include ('../config/connection.php');

//Check users inputs
    //Define Error messages;
$EnterEmail = "<h6>Enter Your Email</h6>";
$EnterValidEmail = "<h6>Enter Valid Email</h6>";
$EnterPassword1 = "<h6>Enter Your Password</h6>";

    //Define the variables from ajax and other
$email = $_POST['EmailLogin'];
$password = $_POST['PasswordLogin'];
$rememberMe = isset($_POST['RememberMe']) ? $_POST['RememberMe'] : "no" ;
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
if(empty($password)){
    $message .= $EnterPassword1;
}else{
    $password = filter_var($password,FILTER_SANITIZE_STRING); 
}

// checking if there any form errors !
if(!($message === "")){
    echo "<div class='alert alert-danger'>$message</div>";
    exit();
}

// No Errors !
// Prepare  variables for the queries
$email = mysqli_real_escape_string($link,$email);
$password = mysqli_real_escape_string($link,$password);
    // hash the Password
$password = hash('sha256',$password);
//If username or password is incorrect 
$sql = "SELECT * FROM users WHERE email = '$email' AND password = '$password'";
if(!($result = mysqli_query($link, $sql))){
     echo '<div class="alert alert-danger">Error running the query!</div>';
    exit;
}
$results = mysqli_num_rows($result);
if(!$results){
    echo '<div class="alert alert-danger">Wrong email or password !</div>'; 
    exit;
}
//fetch the data of this user and check if it's active or not 
$row = mysqli_fetch_assoc($result);
if($row['activation'] != "activated"){
    echo '<div class="alert alert-warning">Please Activate your account first using the link we send to your email address.</div>'; 
    exit;
}

// Set the Session variable 
$_SESSION['user_id'] = $row['user_id'];
$_SESSION['username'] = $row['username'];
$_SESSION['email'] = $row['email'];
$_SESSION['last_action'] = time();
$_SESSION['keepAlive'] = 'true';
//check if he Checked on remeberMe
if($rememberMe === "on"){

    //Create two variables $authentificator1 and $authentificator2
    $authentication1 = bin2hex(openssl_random_pseudo_bytes(6));
    $authentication2 = openssl_random_pseudo_bytes(20);
    //Define other query variables
    $user_id =  $row['user_id'];

    //Prepare to save data in the COOKIE
     function f1($a,$b){
         return $a . "," . bin2hex($b);
    }
    $cookieValue = f1($authentication1,$authentication2);
    $expire_time = time() + 604800;
    //Store authentcations in Cookies
        setcookie(
            "rememberme",
            $cookieValue,
            $expire_time,
            '/'
        );
            
    //Prepare $authentication2 to query
    function f2($a){
        return hash('sha256',$a);
    }
    $f2authentication2 = f2($authentication2);
    
    //If there was old record update it if not insert new one 
$sql = "SELECT * FROM remember_me WHERE user_id = '$user_id'";
if(!($result = mysqli_query($link, $sql))){
     echo '<div class="alert alert-danger">Error running the query!</div>';
    exit;
}
$results = mysqli_num_rows($result);
if($results){ // there is a record 
    $sql = "UPDATE remember_me SET authentication1 = '$authentication1', f2authentication2 = '$f2authentication2', expire_time = '$expire_time' WHERE user_id = '$user_id'";

    if(!($result = mysqli_query($link, $sql))){
     echo '<div class="alert alert-danger">There was an error updating data to remember you next time.</div>';
        exit;
    }
}else{
    //Run query to store them in rememberme table
    $sql = "INSERT INTO remember_me (authentication1, f2authentication2, user_id, expire_time) VALUES ('$authentication1','$f2authentication2','$user_id','$expire_time')";
    
    if(!($result = mysqli_query($link, $sql))){echo '<div class="alert alert-danger">There was an error storing data to remember you next time.</div>';
        exit;}

}
} // check remember me box 
//When EveryThing is success
//return success to the ajax call to the user to mynote.php page;
echo "success";
