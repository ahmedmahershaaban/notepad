// to keep the host alive 
function keepAliveCall(){
    $.ajax({
        url: "/config/keepAlive.php",
        method: "POST",
    })
}
keepAliveCall();
setInterval(keepAliveCall, 20000);

// Ajax call for SignUp form
// When clicking on SignUp in the form
$("#SignUpForm").submit(function(event){
    //prevent the default php proccessing
    event.preventDefault();
    // Clear MessageBox from any errors cased by calls of ajax 
    $('#signUpMessage').empty();
    //Collecting the data
    var dataToPost = $(this).serializeArray();

    //Make the ajax call
    $.ajax({
        url: "./ajax/signup.php",
        method: "POST",
        data: dataToPost,
        success: function(data){
        if(data){
            $("#signUpMessage").html(data);
        }
    },
    error: function(data){
        let text = "<div class='alert alert-danger'>there was an error with the AJAX call. Please try again later.</div>";
        text += "<div>this is the data"+data.responseText+"</div>"
      //  $("#signUpMessage").html("<div class='alert alert-danger'>there was an error with the AJAX call. Please try again later.</div>");
        $("#signUpMessage").html(text);
        }
    });// Ajax call
}); // click submit


//Ajax call for LogIn Form
//When Clicking on Login in the Form
$("#LoginForm").submit(function(event){
    //Prevent the default proccess of the from
    event.preventDefault();
    // Clear MessageBox from any errors cased by calls of ajax 
    $("#LogInMessage").empty();
    //Prepare the dataToPost
    let dataToPost = $(this).serializeArray();
    
    // Making the Ajax call
    $.ajax({
        url: "./ajax/login.php",
        method: "POST",
        data : dataToPost,
        success: function(data){
            if(data === "success"){
                 let url = "http://notepad-github.gearhostpreview.com/MyNote.php";
                $(location).attr('href',url);
            }else{
                $('#LogInMessage').html(data);
            }
        },
        error: function(){
            $("#signUpMessage").html("<div class='alert alert-danger'>there was an error with the AJAX call. Please try again later.</div>");
        }
        });// Ajax call
});// click submit


//AJAX call for forget password
//When clicking on Send in Forget Password form
$("#ForgetPasswordForm").submit(function(event){
    // prevent the default php actoin
    event.preventDefault();
    //  prepare the values
    let dataToPost = $(this).serializeArray();
    $.ajax({
        url: "ajax/forgetPassword.php",
        method: "POST",
        data: dataToPost,
        success: function(data){
                $('#ForgetPasswordMessage').html(data);
        },
        error: function(){
            $("#ForgetPasswordMessage").html("<div class='alert alert-danger'>there was an error with the AJAX call. Please try again later.</div>");
        }
        });// Ajax call
});// click forget password


  //AJAX call for ResetPassword.php 
//When clicking on Reset Password in ResetPassword form
$("#ResetPassword").submit(function(event){
    // prevent the default php actoin
    event.preventDefault();
    //  prepare the values
    let dataToPost = $(this).serializeArray();
    $.ajax({
        url: "changePassword.php",
        method: "POST",
        data: dataToPost,
        success: function(data){
            if(data == "success"){
           $('#resetPasswordMessage').html("<div class='alert alert-success'><h4>We reset your password successfully . you can login with new password now</h4></div>");
            $(".formo").empty(); 
            }
        },
        error: function(){

            $("#resetPasswordMessage").html("<div class='alert alert-danger'>there was an error with the AJAX call. Please try again later.</div>");
        }
        });// Ajax call
});// click forget password



// Ajax call for UpdatingName form
// When clicking on Update in the form
$("#ChangeNameForm").submit(function(event){
    //prevent the default php proccessing
    event.preventDefault();
    // Clear MessageBox from any errors cased by calls of ajax 
    $('#ChangeNameMessage').empty();
    //Collecting the data
    var dataToPost = $(this).serializeArray();

    //Make the ajax call
    $.ajax({
        url: "./ajax/updateName.php",
        method: "POST",
        data: dataToPost,
        success: function(data){
        if(data === "success"){
            $("#ChangeNameMessage").html("<div class='alert alert-success'>We updated your name Sucessfully</div>");
            location.reload();
        }else{
            $("#ChangeNameMessage").html(data);
        }
    },
    error: function(){
        $("#ChangeNameMessage").html("<div class='alert alert-danger'>there was an error with the AJAX call. Please try again later.</div>");
        }
    });// Ajax call
}); // UpdatingName



// Ajax call for UpdatingEmail form
// When clicking on Update in the form
$("#ChangeEmailForm").submit(function(event){
    //prevent the default php proccessing
    event.preventDefault();
    // Clear MessageBox from any errors cased by calls of ajax 
    $('#ChangeEmailMessage').empty();
    //Collecting the data
    var dataToPost = $(this).serializeArray();

    //Make the ajax call
    $.ajax({
        url: "./ajax/updateEmail.php",
        method: "POST",
        data: dataToPost,
        success: function(data){
        if(data === "success"){
            $("#ChangeEmailMessage").html("<div class='alert alert-success'>We updated your name Sucessfully</div>");
            location.reload();
        }else{
            $("#ChangeEmailMessage").html(data);
        }
    },
    error: function(){
        $("#ChangeEmailMessage").html("<div class='alert alert-danger'>there was an error with the AJAX call. Please try again later.</div>");
        }
    });// Ajax call
}); // UpdatingName



// Ajax call for UpdatingPassword form
// When clicking on Update in the form
$("#ChangePasswordForm").submit(function(event){
    //prevent the default php proccessing
    event.preventDefault();
    // Clear MessageBox from any errors cased by calls of ajax 
    $('#ChangePasswordMessage').empty();
    //Collecting the data
    var dataToPost = $(this).serializeArray();

    //Make the ajax call
    $.ajax({
        url: "./ajax/updatePassword.php",
        method: "POST",
        data: dataToPost,
        success: function(data){
        if(data){
            $("#ChangePasswordMessage").html(data);
            
        }
    },
    error: function(){
        $("#ChangePasswordMessage").html("<div class='alert alert-danger'>there was an error with the AJAX call. Please try again later.</div>");
        }
    });// Ajax call
}); // UpdatingName


// Ajax call for Sending ContactUS Info
// When clicking on Send in the form
$("#ContactUsForm").submit(function(event){
    //prevent the default php proccessing
    event.preventDefault();
    // Clear MessageBox from any errors cased by calls of ajax 
   
    //Collecting the data
    var dataToPost = $(this).serializeArray();

    //Make the ajax call
    $.ajax({
        url: "./ajax/contactUs.php",
        method: "POST",
        data: dataToPost,
        success: function(data){

        if(data === "success"){
            $("#ContactUsForm").trigger("reset");
             $('#ContactUsFormMessage').empty();
            $('#ContactUsFormMessage').html("<div class='alert alert-success'>We Recived Your Message</div>");
            $('#ContactUsFormMessage').css('color','green');
        }else{
            $('#ContactUsFormMessage').empty();
            $('#ContactUsFormMessage').html(data);
      
        }
    },
    error: function(){
        $("#ChangePasswordMessage").html("<div class='alert alert-danger'>there was an error with the AJAX call. Please try again later.</div>");
        }
    });// Ajax call
}); // UpdatingName
