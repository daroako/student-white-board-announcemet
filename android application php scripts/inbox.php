 <?php 
require "conn.php";
$User_id =$_POST["User_id"];;

$sql_1 = "select S_id from student where User_id='$User_id';";  // to get the student id//that means convert User_idser_id to S_id
$result = mysqli_query($conn ,$sql_1);
while($row = mysqli_fetch_assoc($result))
  {
	$output1[]=$row;
	$S_id=$row['S_id'];
  }

$sql_2 = "select lecturer.L_name,M_addon,M_message_contenteat from message INNER JOIN lecturer ON message.L_id=lecturer.L_id WHERE S_id='$S_id' ORDER BY M_addon DESC;";  

$result2 = mysqli_query($conn ,$sql_2);
while($row = mysqli_fetch_assoc($result2))
  {
	$output[]=$row;
  }
print(json_encode($output));
  mysqli_close($conn);
  ?>