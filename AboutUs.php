<?php 
//Start the Session
session_start();

//check for living host
include ("config/checkForLive.php");

// check if there sesstion and cookies for rememberme
include ('config/rememberMe.php');




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
      <script src="https://kit.fontawesome.com/a076d05399.js"></script>

    <title>About Us</title>
  </head>
  <body class="AboutUsBG">

      
<!--      Nav Bar   -->

<?php isset($_SESSION['user_id'])? include ("./pages/signedNavbar.php") : include ("./pages/unsignedNavbar.php")?>     

<!--      Jumbotron -->
      <div class="jumbotron">
  <h1 class="display-1">know us more</h1>
  <p>We are a group of developers who want to make somthing good and useful for the community.</p>
   
  <p>we are doing our best to satify you hope u like our work</p>
          <div class="container icons">
            <ul>
                <li><i class="fab fa-facebook-f"></i></li>  
                <li><i class="fab fa-twitter"></i></li>  
                <li><i class="fab fa-instagram"></i></li>   
                <li><i class="fab fa-linkedin-in"></i></li>  
                <li><i class="fab fa-youtube"></i></li>  
  
            </ul>
          </div>
</div>

      
      
<!-- include login and signUp and Forget Password Modals-->
 <?php isset($_SESSION['user_id'])? "" : include ("./pages/modalForms.php")?> 
<!--      Footer   With  Scripts -->
<?php include ("./pages/footer.php"); ?>
      
  </body>
</html>