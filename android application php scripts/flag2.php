<?php
require "conn.php";
//$fcm_token =$_POST["token"];
$User_id =$_POST["user_id"];
$flag =$_POST["flag"];

$sql2 = "update login set flag='$flag' where User_id='$User_id';";

mysqli_query($conn ,$sql2);

   
mysqli_close($conn);


?>