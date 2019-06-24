<?php 
require "conn.php";
$Sender_id =$_POST["L_id"];
$un_message_con =$_POST["message_content"];
$Receiver_id =$_POST["S_id"];
$message_con = mysqli_real_escape_string($conn,$un_message_con);//changing it to sfae variable
foreach ($Receiver_id  as $Receiver_idss) {
$sql_1g = "select S_id from student where S_name='$Receiver_idss';";  // to get id of student
$resultg = mysqli_query($conn ,$sql_1g);
while($rowg = mysqli_fetch_assoc($resultg))
  {
	$outputg[]=$rowg;
	$S_id[]=$rowg['S_id'];
  }
 }
$ok=false;
$sql_1 = "select L_id from lecturer where User_id='$Sender_id';";  // to get info about sender
$result = mysqli_query($conn ,$sql_1);
while($row = mysqli_fetch_assoc($result))
  {
	$output[]=$row;
	$L_id=$row['L_id'];
  }
 foreach ($S_id as $ids) {
	  
$mysql_qryy = "select * from login where User_id = ' $ids';";//to check if user exist
$resultq = mysqli_query($conn ,$mysql_qryy);


if(mysqli_num_rows($resultq) > 0) {
mysqli_query($conn ,"SET time_zone='-03:00'");//server time was GMT
$sql = "INSERT INTO message 
VALUES (NULL, UTC_TIMESTAMP(), '$message_con','$L_id','$ids')";//utc_timestamp() to set the new time zone.
if (mysqli_query($conn, $sql)) {
$ok=true;
    
   } else {
	   $ok=false;
   }
$sql_2 = "select L_name from lecturer where User_id='$Sender_id';";
$resultt = mysqli_query($conn ,$sql_2);
while($row1 = mysqli_fetch_assoc($resultt))
  {
	$output1[]=$row1;
	$title=$row1['L_name'];
  }
  $path_to_fcm ='https://fcm.googleapis.com/fcm/send';
$server_key="AAAAOvyU8Vc:APA91bEJp3R5Ib5kt_00e1XzDWkgXuIAbdxBj5ISCLkw72JOAJWhJayzo
nk969H2tP2MjaldtQxM-6m6onVUMaDO7p4z57QJBg2G9R-ozbqgaBnOm0E2IT-xQdiWqby2gam5BmvfKLy1";

$sqls = "select User_id from student where S_id='$ids' ";
$results = mysqli_query($conn ,$sqls);
while($rows = mysqli_fetch_assoc($results))
  {
	$outputs[]=$rows;
	$ids1=$rows['User_id'];
  }

$sqlw = "select fcm_token from login where User_id='$ids1' ";

$resulttt = mysqli_query($conn,$sqlw);
$key=array();
while($row2 = mysqli_fetch_assoc($resulttt))
  {
	$output2[]=$row2;
	$key[]=$row2['fcm_token'];
  }
  

$headers =array(
'Authorization:key=' .$server_key,
'content-Type:application/json'
);

  foreach ($key as $keys) {
	  
$sqle = "select flag from login where fcm_token='$keys'";
$resulte = mysqli_query($conn,$sqle);
while($rowe = mysqli_fetch_assoc($resulte))
  {
	$outpute[]=$rowe;
	$flag=$rowe['flag'];
  }
if($flag=='yes')
{
$fields = array('to'=>$keys,
      'notification'=>array('title'=>$title,'body'=>$message_con,'sound'=> 'default','click_action' => 'abc'));
 $payload=json_encode($fields); 
 $curl_session=curl_init();
 
curl_setopt($curl_session, CURLOPT_URL, $path_to_fcm);
curl_setopt($curl_session, CURLOPT_POST, true);
curl_setopt($curl_session, CURLOPT_HTTPHEADER, $headers);
curl_setopt($curl_session, CURLOPT_RETURNTRANSFER, true);
curl_setopt($curl_session, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($curl_session, CURLOPT_IPRESOLVE, CURL_IPRESOLVE_V4);
curl_setopt($curl_session, CURLOPT_POSTFIELDS, $payload);

$result=curl_exec($curl_session);
    curl_close($curl_session);
 } } }}	  
 mysqli_close($conn);

  if($ok==true){
    echo "Message Sent successfully";
   } else {
      echo "Message Not Sent";
   }
   ?>
   
