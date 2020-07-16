

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
    <title>Activatived Account</title>
    <style>
            #cover {
    background: #222 url("../images/Activation.jpg") center center no-repeat;
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
                <div class=" ">
                    <h1 class=" py-2">
                    <?php


//Connect to the DataBase
include ('../config/connection.php');

//Define the variables from the GET link
$email = $_GET['email'];
    //Decode the email
$email = urldecode($email);
$activationKey = $_GET['key'];

//Prepare variables to the query
$email = mysqli_real_escape_string($link,$email);
$activationKey = mysqli_real_escape_string($link,$activationKey);

$sql = "SELECT * FROM users WHERE email = '$email' AND activation = '$activationKey'";
$result = mysqli_query($link, $sql);
if(!$result){
     echo '<div class="alert alert-danger">Error running the query!</div>';
    exit;
}
$results = mysqli_num_rows($result);
// didn't find any record for this data in the DataBase
if(!$results){
    echo '<div class="alert alert-danger">please click on the link that we send in the email address you have registered with</div>'; 
    exit;
}
$sql = "UPDATE users SET activation = 'activated'";
if($result = mysqli_query($link, $sql)){
     echo '<div class="alert alert-success">We Activated your account Please visit our website and Login</div>';
    exit;
}



?>
                    
                    </h1>

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