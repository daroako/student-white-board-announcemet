<?php 
require "conn.php";
$user_name = $_POST["user_name"];
$user_pass = $_POST["password"];
$mysql_qry = "select * from login where User_name = '$user_name' and User_password = '$user_pass';";
$result = mysqli_query($conn ,$mysql_qry);
while($row = mysqli_fetch_assoc($result))
  {
	$output[]=$row;
  }
print(json_encode($output));
mysqli_close($conn);

?>