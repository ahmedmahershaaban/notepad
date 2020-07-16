<?php 
//Start the Session
session_start();

//check for living host
include ("config/checkForLive.php");

// check if there sesstion and cookies for rememberme
include ('config/rememberMe.php');


if(!isset($_SESSION['user_id'])){
    
    header("location: http://localhost/index.php");
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
      <link href="https://fonts.googleapis.com/css2?family=Cookie&display=swap" rel="stylesheet">
    <title>My Notes</title>
  </head>
  <body class="MyNotesBG">
      
 <!--      Nav Bar   -->
<?php include ("./pages/signedNavbar.php"); ?>
      
<!--      Main Page-->
      <div class="container mainDiv">


          <div class="container-fluid submain-div">
     <div class="container-fluid">
                 
          <div class="btnLine">
                    <div id="addNewNote">
                        <div class="btnX"><span class="noselect">Add New Note</span><div class="circle"></div></div>
                    </div>
                    <div id="done">
                        <div class="btnX"><span class="noselect">Save</span><div class="circle"></div></div>
                    </div>
                    <div id="deleteNote">
                        <div class="btnX"><span class="noselect">Delete</span><div class="circle"></div></div>
                    </div>
              </div>

      </div>
              <div id="main" class="contianer-fluid textareaPad">
              <textarea id="area" name="S1" autofocus="" class="notes" style="font-size: 19px;"></textarea>
                      <div id="bar">Line <span id="Slines">0</span>, Words <span id="Swords">0</span>    Chars <span id="Sletters">0</span></div>
              </div>
      <div id="noteRowContainer" class="container-fluid ">
          
     
              </div>
              </div>
              <div class="lastItem"></div>
                </div>

          </div>
      </div>
      
<!--      Footer   With  Scripts -->
<?php include ("./pages/footer.php"); ?>
    <script src="note.js"></script>
  </body>
</html>