<?php
session_start();
// connect to the DataBase
include ("../config/connection.php");

$user_id = $_SESSION['user_id'];

$sql = "SELECT * FROM `notes` ORDER BY id DESC LIMIT 1";
$result = mysqli_query($link,$sql);
if(!$result){
    die('faild with the query');
}
$row = mysqli_fetch_assoc($result);
$id = $row['id'];
    $sql = "DELETE FROM `notes` WHERE id = '$id' ";
    $result = mysqli_query($link,$sql);
        if(!$result){echo('faild with the query');exit();}
  echo "done";

?>