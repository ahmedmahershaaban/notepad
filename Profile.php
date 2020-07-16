<?php 
//Start the Session
session_start();

//check for living host
include ("config/checkForLive.php");

// check if there sesstion and cookies for rememberme
include ('config/rememberMe.php');


if(!isset($_SESSION['user_id'])){
    
    header("location: http://notepad-github.gearhostpreview.com/index.php");
}

 $user_id =  $_SESSION['user_id'];
             $sql = "SELECT * FROM users WHERE user_id = '$user_id'";
if(!($result = mysqli_query($link, $sql))){
     echo '<div class="alert alert-danger">Error running the query!</div>';
    exit;
}
//fetch the data of this user and get the email
if($row = mysqli_fetch_assoc($result)){
   
    $_SESSION['email'] = $row['email'];
    $_SESSION['username'] = $row['username'];
}else{
    echo '<div class="alert alert-danger">Error running the query!</div>';
    exit;
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
      <script src="https://kit.fontawesome.com/a076d05399.js"></script>
      <link href="https://fonts.googleapis.com/css2?family=Cookie&display=swap" rel="stylesheet">
    <title>My Profile</title>
  </head>
  <body class="ProfileBG">
       <!--      Nav Bar   -->
<?php include ("./pages/signedNavbar.php"); ?>

<!--      Main Page-->
      <div class="container profile">
          <div class="MainInfo">
              <img src="images/progileImage.jpg" alt="profile picture">
              <div class="contactInfo ">
                <h1><?php echo $_SESSION['username'] ?></h1>
                  <h4>Adverstising Execute</h4>
              </div>
           
          </div>
          <div class="row infoToChange">
            <h3 class="borderShapleft">
              Name: 
              </h3>
              <h3 class="borderShapright" id="name"  type="submit"  data-toggle="modal" data-target="#ChangeNameModel">
<?php echo $_SESSION['username'] ?>
              </h3>
          </div>
           <div class="row infoToChange">
            <h3 class="borderShapleft">
              Email: 
              </h3>
              <h3 class="borderShapright" id="email" type="submit"  data-toggle="modal" data-target="#ChangeEmailModel">
<?php echo $_SESSION['email'] ?>
              </h3>
          </div>
          <div class="row infoToChange">
            <h3 class="borderShapleft">
              password: 
              </h3>
              <h3 class="borderShapright" id="password" type="submit"  data-toggle="modal" data-target="#ChangePasswordModel">
              Hidden 
              </h3>
          </div>
      </div>
 
      
      <!--     Change Name Modal -->
<div class="modal fade" id="ChangeNameModel" tabindex="-1" role="dialog" aria-labelledby="Change Name Form" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" >Change Your Name:</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
              <!--Change Name message from PHP file-->
             <div  id="ChangeNameMessage"></div>
        <form method="post" id="ChangeNameForm">
      <div class="modal-body">
             <div class="form-group">
                 <label for="ChangeName">Please enter your New Name:</label>
                 <input type="text" class="form-control" id="ChangeName" name="ChangeName" placeholder="<?php echo $_SESSION['username']?>">
            </div>
          <div class="row justify-content-end">
                <button type="button" class="btn btn-secondary mr-2  " data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-success mr-2" name="SubmitForgetPassword">Update</button>
          </div>
              
      </div>
     
        </form>
    </div>
  </div>
</div>
      <!--    Change Email Modal -->
<div class="modal fade" id="ChangeEmailModel" tabindex="-1" role="dialog" aria-labelledby="Change Email Form" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" >Change Email:</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
              <!--Change Email message from PHP file-->
             <div  id="ChangeEmailMessage"></div>
        <form method="post" id="ChangeEmailForm">
      <div class="modal-body">
             <div class="form-group">
                 <label for="ChangeEmail">Please enter your email to reset the password:</label>
                 
                 <input type="email" class="form-control" id="ChangeEmail" name="ChangeEmail" value="<?php echo  $_SESSION['email']?>">
            </div>
          <div class="row justify-content-end">
                <button type="button" class="btn btn-secondary mr-2  " data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-success mr-2" name="SubmitForgetPassword">Update</button>
          </div>
              
      </div>
     
        </form>
    </div>
  </div>
</div>
      <!--    Change Password Modal -->
<div class="modal fade" id="ChangePasswordModel" tabindex="-1" role="dialog" aria-labelledby="Change Password Form" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" >Change Password:</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
              <!--Change Password message from PHP file-->
             <div  id="ChangePasswordMessage"></div>
        <form method="post" id="ChangePasswordForm">
      <div class="modal-body">
          
             <div class="form-group">
                 <label for="oldPassword">Please enter your old password:</label>
                 
                 <input type="password" class="form-control" id="oldPassword" name="oldPassword" placeholder="Old Password">
            </div>
             <div class="form-group">
                 <label for="newPassword">Please enter your New password:</label>
                 
                 <input type="password" class="form-control" id="newPassword" name="newPassword" placeholder="New Password">
            </div>
          
          <div class="row justify-content-end">
                <button type="button" class="btn btn-secondary mr-2  " data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-success mr-2" name="SubmitForgetPassword">Update</button>
          </div>
              
      </div>
     
        </form>
    </div>
  </div>
</div>
      

<!--      Footer   With  Scripts -->
<?php include ("./pages/footer.php"); ?>

  </body>
</html>