<?php 
require "conn.php";

$un_user_name = $_POST["user_name"];//un safe variable
$un_user_pass = $_POST["password"];//un safe variable
$user_name = mysqli_real_escape_string($conn,$un_user_name);//changing it to sfae variable
$user_pass = mysqli_real_escape_string($conn,$un_user_pass);//changing it to sfae variable

$mysql_qry = "select * from login where User_name = '$user_name' and User_password = '$user_pass';";
$result = mysqli_query($conn ,$mysql_qry);
if(mysqli_num_rows($result) > 0) {
echo "login success";
}
else {
echo "login not success";
}

?>
