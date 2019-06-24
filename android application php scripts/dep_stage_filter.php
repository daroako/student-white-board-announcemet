<?php 
require "conn.php";
$DEP = $_POST["dep"];
$STAGE = $_POST["stage"];
if($STAGE=='All stages')
{
$mysql_qry = "select S_name,S_id from student where Department = '$DEP';";
}
else
{
	$mysql_qry = "select S_name,S_id from student where Department = '$DEP' and S_stage = '$STAGE ';";
}
$result = mysqli_query($conn ,$mysql_qry);
while($row = mysqli_fetch_assoc($result))
  {
	$output[]=$row;
  }
print(json_encode($output));
mysqli_close($conn);

?>