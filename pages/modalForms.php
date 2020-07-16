
<!--      Sing Up Modal -->
<div class="modal fade" id="SignUpModal" tabindex="-1" role="dialog" aria-labelledby="SignUp form" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" >Sign Up:</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
         <form method="post" id="SignUpForm">
                               
              <!--Sign up message from PHP file-->
             <div  id="signUpMessage"></div>
      <div class="modal-body">
             <div class="form-group">
                 <label for="NameSignUp">Name:</label>
                 <input type="text" class="form-control" id="NameSignUp" name="NameSignUp" placeholder="Name">
            </div>
             <div class="form-group">
                 <label for="EmailSignUp">Email:</label>
                 <input type="email" class="form-control" id="EmailSignUp" name="EmailSignUp" placeholder="Email">
            </div>
             <div class="form-group">
                 <label for="PasswordSignUp">Password:</label>
                 <input type="password" class="form-control" id="PasswordSignUp" name="PasswordSignUp" placeholder="Password">
            </div>
             <div class="form-group">
                 <label for="Password2SignUp">Confirm Password:</label>
                 <input type="password" class="form-control" id="Password2SignUp" name="Password2SignUp" placeholder="Confirm Your Password">
            </div>
                <div class="form-check pointer mb-2">
        <input class="form-check-input" type="checkbox" id="AcceptTerms" name="AcceptTerms">
        
            <label class="form-check-label" for="AcceptTerms">
         <a href="#"> Our Terms </a>
        </label>
           
    </div>
          <div class="row justify-content-end">
                    
                <button type="button" class="btn btn-secondary mr-2  " data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-success mr-2" id="SubmitSignUp">SignUp</button>
          </div>
          
              
      </div>
      <div class="modal-footer">
     
      </div>
        </form>
    </div>
  </div>
</div>
      
<!--     Login Modal -->
<div class="modal fade" id="LoginModel" tabindex="-1" role="dialog" aria-labelledby="Login form" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" >Login:</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
              <!--Login message from PHP file-->
             <div  id="LogInMessage"></div>
        <form method="post" id="LoginForm">
      <div class="modal-body">
             <div class="form-group">
                 <label for="EmailLogin">Email:</label>
                 <input type="email" class="form-control" id="EmailLogin" name="EmailLogin" placeholder="Email">
            </div>
             <div class="form-group">
                 <label for="PasswordLogin">Password:</label>
                 <input type="password" class="form-control" id="PasswordLogin" name="PasswordLogin" placeholder="Password">
            </div>
      <div class="form-check  pointer mb-2">
        <input class="form-check-input" type="checkbox" id="RememberMe" name="RememberMe">
        <label class="form-check-label pointer  " for="RememberMe">
          Remember me
        </label>
    </div>
          <div class="row justify-content-end">
                <button type="button" class="btn btn-secondary mr-2  " data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-success mr-2" name="SubmitLogin">login</button>
          </div>
              
      </div>
       <div class="modal-footer">
        <a href="#" type="submit" data-toggle="modal" data-dismiss="modal" data-target="#ForgetPasswordModel" > Reset your password</a>
      </div>
        </form>
    </div>
  </div>
</div>
      
<!--     Forget Password Modal -->
<div class="modal fade" id="ForgetPasswordModel" tabindex="-1" role="dialog" aria-labelledby="Forget Password form" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" >Forget Password:</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
              <!--Forget Password message from PHP file-->
             <div  id="ForgetPasswordMessage"></div>
        <form method="post" id="ForgetPasswordForm">
      <div class="modal-body">
             <div class="form-group">
                 <label for="EmailForgetPassword">Please enter your email to reset the password:</label>
                 <input type="email" class="form-control" id="EmailForgetPassword" name="EmailForgetPassword" placeholder="Email">
            </div>
          <div class="row justify-content-end">
                <button type="button" class="btn btn-secondary mr-2  " data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-success mr-2" name="SubmitForgetPassword">Send</button>
          </div>
              
      </div>
     
        </form>
    </div>
  </div>
</div>