<?php
session_start();
// connect to the DataBase
include ("../config/connection.php");


$user_id = $_SESSION['user_id'];
$text = $_POST['Val'];
$text = ltrim($text);
$time = time();
$line = $_POST['Line'];
$length = $_POST['Length'];
$words = $_POST['Words'];

$sql = "SELECT * FROM `notes` ORDER BY id DESC LIMIT 1";
$result = mysqli_query($link,$sql);
if(!$result){
    echo('faild with the query');
    die();
}
$row = mysqli_fetch_assoc($result);
$id = $row['id'];

if($text == ''){
    
    $sql = "DELETE FROM `notes` WHERE id = '$id' ";
    $result = mysqli_query($link,$sql);
        if(!$result){echo('faild with the query');die();}
    
}else{

$sql = "UPDATE `notes` SET `text`='$text',`time`='$time',`lines`='$line',`letters`='$length',`words`='$words' WHERE `id`='$id'";

$result = mysqli_query($link,$sql);
if(!$result){    echo('faild with the query');die();}
echo "done";
}
?>