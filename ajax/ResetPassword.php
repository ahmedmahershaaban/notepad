
<!doctype html>
<html lang="en">
    <head>
            <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
      <link href="css/styling.css" rel="stylesheet" >
      <link href="https://fonts.googleapis.com/css2?family=Cookie&display=swap" rel="stylesheet">
    <title>Reset Password</title>
    <style>
            #cover {
    background: #222 url('../images/ResetPassword.jpg') center center no-repeat;
    background-size: cover;
    height: 100%;
    text-align: center;
    display: flex;
    align-items: center;
    position: relative;
}

#cover-caption {
    width: 100%;
    position: relative;
    z-index: 1;
}

/* only used for background overlay not needed for centering */
form:before {
    content: '';
    height: 100%;
    left: 0;
    position: absolute;
    top: 0;
    width: 100%;
    background-color: rgba(0,0,0,0.3);
    z-index: -1;
    border-radius: 10px;
}

    </style>
    </head>
    <body>
        <section id="cover" class="min-vh-100">
    <div id="cover-caption">
        <div class="container">
            <div class="row text-white">
                <div class="col-xl-5 col-lg-6 col-md-8 col-sm-10 mx-auto text-center form p-4">
                    <h1 class=" py-2">Reset Your Password</h1>
          <?php
if(isset($_GET['email'])&&isset($_GET['key'])){
    //Connect to the DataBase
include ('../config/connection.php');

//Define the variables from the GET link
$email = $_GET['email'];
    //Decode the email
$email = urldecode($email);
$uniqueKey = $_GET['key'];

//Prepare variables to the query
$email = mysqli_real_escape_string($link,$email);
$uniqueKey = mysqli_real_escape_string($link,$uniqueKey);


$sql = "SELECT * FROM users WHERE email = '$email'";
$result = mysqli_query($link, $sql);
if(!$result){
    echo "<h3 class='py-2'>ask for setting your password first from the login in the main website!</h3>";
    exit;
}
$results = mysqli_num_rows($result);
if(!$results){
      echo "<h3 class='py-2'>Please enter the link on your email !</h3>"; 
    exit;
}
//fetch the data of this user  
$row = mysqli_fetch_assoc($result);
$user_id = $row['user_id'];

$sql = "SELECT * FROM forget_password WHERE user_id = '$user_id' AND unique_key	= '$uniqueKey'";
$result = mysqli_query($link, $sql);
if(!$result){
    echo "<h3 class='py-2'>ask for setting your password first from the login in the main website!</h3>";
    exit;
}
$results = mysqli_num_rows($result);
if(!$results){
    echo "<h3 class='py-2'>ask for setting your password first from the login in the main website!</h3>";
    exit;
}
$row = mysqli_fetch_assoc($result);

    if($row['unique_key'] == $uniqueKey && $row['status'] == 'pending' && $row['time'] > time()){
        echo '
        <div id="resetPasswordMessage"></div>
                    <div class="px-2 formo">
    <form method="POST"  id="ResetPassword" class="justify-content-center">
        <div class="form-group">
            <label class="sr-only">Name</label>
            <input type="password" class="form-control" name="password1" placeholder="Your New Password">
        </div>
        <div class="form-group">
            <label class="sr-only">Email</label>
            <input type="password" class="form-control" name="password2" placeholder="Confirm Your Password">
        </div>
        <input type="hidden"  name="user_id" value="'.$user_id.'">
        <input type="hidden"  name="unique_key" value="'.$uniqueKey.'">
        <button type="submit" class="btn btn-primary btn-lg">Reset Password</button>
 
 </form>
                    </div>';
    }else{
           echo "<h3 class='py-2'>Ask for resset password again</h3>";
    }
}else{
    echo "<h3 class='py-2'>Please enter the link on your email !</h3>";
}


?>          
                    
                    
                    
                   
                    
                </div>
            </div>
        </div>
    </div>
</section>
        <!--      Footer   With  Scripts -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
      <script src="../ajax.js"></script> 
    </body>
</html>
