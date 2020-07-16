<?php
session_start();
// connect to the DataBase
include ("../config/connection.php");


$user_id = $_SESSION['user_id'];
// delete the empty notes first 
$sql = "DELETE FROM `notes` WHERE text = ''";
$result = mysqli_query($link,$sql);
if(!$result){
    echo('faild with the query');
    die();
}

$sql = "SELECT * FROM `notes` WHERE user_id = '$user_id' ORDER BY time DESC";
$result = mysqli_query($link,$sql);
if(!$result){
    echo('faild with the query');
    die();
}
$arrayOfNotes = array();
while($row = mysqli_fetch_assoc($result)){
     $time =  date("D M Y , g:i a",$row['time']);
    $arr = array($row['id'],$row['text'],$row['lines'],$row['letters'],$row['words'],$time);
 
    array_push($arrayOfNotes,$arr);
}
 echo json_encode($arrayOfNotes);

?>