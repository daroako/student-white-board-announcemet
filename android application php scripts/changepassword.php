<?php 
require "conn.php";
$un_user_id =$_POST["usid"];
$un_user_pass =$_POST["finalpassword"];
$user_id = mysqli_real_escape_string($conn,$un_user_id);//changing it to sfae variable
$user_pass = mysqli_real_escape_string($conn,$un_user_pass);//changing it to sfae variable

$sql = "UPDATE login SET User_password='$user_pass' WHERE User_id='$user_id';";
if (mysqli_query($conn, $sql)) {
      echo "Record updated successfully";
   } else {
      echo "Error updating record: " . mysqli_error($conn);
   }
   mysqli_close($conn);