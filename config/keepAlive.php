<?php
// to update the last_action variable to keep the session alive 
session_start();

if(isset($_SESSION['keepAlive'])){
    $_SESSION['last_action'] = time();
}
?>