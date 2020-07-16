<?php
session_start();


if($_GET['logout'] == 1){
    session_destroy();
    setcookie("rememberme", "", time()-604800,'/');
    header("location: http://notepad-github.gearhostpreview.com/MyNote.php");
    
}
?>
