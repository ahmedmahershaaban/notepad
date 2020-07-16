<?php
session_start();
// connect to the DataBase
include ("../config/connection.php");

$user_id = $_SESSION['user_id'];
$id = $_POST['id'];

    $sql = "DELETE FROM `notes` WHERE id = '$id' ";
    $result = mysqli_query($link,$sql);
        if(!$result){echo('faild with the query');exit();}
  echo "done";

?>