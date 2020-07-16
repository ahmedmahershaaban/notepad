
      <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <a class="navbar-brand" href="#">NOTEPAD</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
    <div class="navbar-nav mr-auto">
      <?php  
                $current = $_SERVER["PHP_SELF"];
                if (strpos($current, 'index.php') !== false){
                    echo '<a class="nav-item nav-link active" href="index.php">Home <span class="sr-only">(current)</span></a>
                     <a class="nav-item nav-link" href="AboutUs.php">About Us</a>
      <a class="nav-item nav-link" href="ContactUs.php">Contact Us</a>';
                }else if(strpos($current, 'AboutUs.php') !== false){
                    echo '<a class="nav-item nav-link " href="index.php">Home</a>
                     <a class="nav-item nav-link active" href="AboutUs.php">About Us<span class="sr-only">(current)</span></a>
      <a class="nav-item nav-link" href="ContactUs.php">Contact Us</a>';
                }else{
                    echo '<a class="nav-item nav-link " href="index.php">Home</a>
                     <a class="nav-item nav-link " href="AboutUs.php">About Us</a>
      <a class="nav-item nav-link active" href="ContactUs.php">Contact Us<span class="sr-only">(current)</span></a>';
                }
        ?>
    </div>
       <div class=" my-2 mr-2  my-lg-0">
    <button class="btn btn-outline-success my-2 mr-2 my-sm-0" type="submit" id="LoginModelButton" data-toggle="modal" data-target="#LoginModel">Login</button>
    <button class="btn btn-outline-warning my-2 mx-1 my-sm-0" type="submit" id="SignUpModelButton" data-toggle="modal" data-target="#SignUpModal">Sign Up</button>

        </div>
  </div>
</nav>
      
