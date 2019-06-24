 <?php 
require "conn.php";

$User_id =$_POST["User_id"];

$sql_1 = "select L_id from lecturer where User_id='$User_id';";  // to get info about teachers

$result = mysqli_query($conn ,$sql_1);
while($row1 = mysqli_fetch_assoc($result))
  {
$outpu1t[]=$row1;
	$L_id=$row1['L_id'];
 }




$sql_2 = "select student.S_name,M_addon,M_message_contenteat from message INNER JOIN student ON message.S_id=student.S_id WHERE L_id='$L_id' Order by M_addon DESC ;";  

$result2 = mysqli_query($conn ,$sql_2);
while($row = mysqli_fetch_assoc($result2))
  {
	$output[]=$row;
  }
print(json_encode($output));
  mysqli_close($conn);
  ?>