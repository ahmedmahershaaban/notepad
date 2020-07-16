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
    <title>Contact Us</title>
  </head>
  <body  class="ContactUsBG">
<!--    NavBar  -->
 <?php isset($_SESSION['user_id'])? include ("./pages/signedNavbar.php") : include ("./pages/unsignedNavbar.php")?>     

      
<!--      Jumbotron -->
      <div class="jumbotron   jumbotronContactUS">
  <h1 class="display-1">Get touch with us</h1>
  <p>If you had any problems or you want to say something to us</p>
   
  <p>All u need to do is fill the form and we will contact with you as soon as posible ^_^</p>
</div>

<!--      the main page-->
      <section class="container">
        <div class="row">
            <div class="col-6 row">
                <h2 class="col-12">Location</h2>

                <div class="col-6">
                    <div class="address">
                <h6 class="display4">Location</h6>
                <h6>فندق مارشال الجزيرة, 8 الإمام الشافعي، Al Mansoura First, Dakahlia Governorate 35511</h6>
                    </div>
                    <div class="contactInfo">
                <h6 class="display4">phone: <span class="h6" >+44 555 555 555</span></h6>
                <h6 class="display4">Fax: <span class="h6">+44 556 666 555</span></h6>
                <h6 class="display4">Email: <span class="h6">Contact45@gamil.com</span></h6>
                <h6 class="display4">Skype: <span class="h6">Supporter</span></h6>
                    </div>
                </div>
                <div class="col-6">
                <img src="images/location.PNG" width="100%" height="100%" alt="companiey locatoin">
                </div>
              </div>
            <div class="col-6 row">
                <h2 class="col-12" >Ask a questions</h2>
                <div class="col-12" id="ContactUsFormMessage"></div>
                <form method="POST"  id="ContactUsForm">
                    <div class="form-row">
                    <div class="form-group col-md-6">
                      <label for="NameContactUs">Name:</label>
                      <input type="text" class="form-control" id="NameContactUs" 
                             name="name" placeholder="Name"  required>
                    </div>
                    <div class="form-group col-md-6">
                      <label for="EmailContactUs">Email:</label>
                      <input type="email" class="form-control" id="EmailContactUs" 
                             name="email" placeholder="Email"  required>
                    </div>
                     <div class="form-group col-12">
                        <label for="TextAreaContactUs">Message:</label>
                        <textarea class="form-control" id="TextAreaContactUs" rows="5" name="message" required></textarea>
                      </div>
                       <button class="btn btn-success center " type="submit" id="SubmitMessage" name="SubmitMessage" value="submit" >Send</button> 
                  </div>
                
                </form>
               </div>
      </div>
      </section>

      

<!-- include login and signUp and Forget Password Modals-->
 <?php isset($_SESSION['user_id'])? "" : include ("./pages/modalForms.php")?>     
      <!--      Footer   With  Scripts -->
<?php include ("./pages/footer.php"); ?>
  </body>
</html>