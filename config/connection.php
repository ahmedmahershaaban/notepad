<?php

$link = @mysqli_connect('den1.mysql6.gear.host','notepad','Dq30529~~hB4','notepad');

if(mysqli_connect_errno()){
        die("<p style='color:red;'>WE Couldn't Connect to the database table . MYSQL Number: " . mysqli_connect_errno() . " Description : " . mysqli_connect_error() . "</p>");
    exit();
}
?>
