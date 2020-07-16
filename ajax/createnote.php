<?php
session_start();
// connect to the DataBase
include ("../config/connection.php");

$user_id = $_SESSION['user_id'];
$time = time();

$sql = "INSERT INTO `notes` (`user_id`, `text`, `time`, `lines`, `letters`, `words`) VALUES ('$user_id','','$time','0','0','0')";
$result = mysqli_query($link,$sql);
if(!$result){
    die('faild');
}
echo "done";

?>