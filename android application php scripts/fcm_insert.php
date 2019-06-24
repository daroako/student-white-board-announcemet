<?php
require "conn.php";
$fcm_token =$_POST["token"];
$User_id =$_POST["user_id"];
$flag =$_POST["flag"];

$sql = "update login set fcm_token='$fcm_token' where User_id='$User_id';";
$sql2 = "update login set flag='$flag' where User_id='$User_id';";
mysqli_query($conn ,$sql2);
if (mysqli_query($conn, $sql)) {

    echo "Record updated successfully";
   } else {
      echo "Record not updated";
   }
   
   
mysqli_close($conn);


?>