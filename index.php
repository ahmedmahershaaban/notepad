<?php

session_start();
 

if(isset($_SESSION['user_id'])){
    header("location: http://localhost/MyNote.php");
}

?>
<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
      <link href="css/styling.css" rel="stylesheet" >
    <title>Free Onilne NotePad</title>
  </head>
  <body>
<!--      Video background -->
      <video abindex="-1" autoplay loop muted id="bgvideo">
        <source src="images/background-video.mp4" type="video/mp4">
          Your browser does not support the video tag.
      </video>
      
<!--      Nav Bar   -->
<?php include ("./pages/unsignedNavbar.php"); ?>

<!--      Jumbotron -->
      <div class="jumbotron">
  <h1 class="display-1">Welcome to our Website</h1>
  <p>Please login to access your profile and your notes.</p>
   
  <p>If you are new you can join us now for free.  </p>
</div>
      
<!-- include login and signUp and Forget Password Modals-->
<?php include ("./pages/modalForms.php"); ?>

<!--      Footer   With  Scripts -->
<?php include ("./pages/footer.php"); ?>
  </body>
</html>