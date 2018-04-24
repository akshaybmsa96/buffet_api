<?php
require "init.php";
$trans=0;
$userinfo=$_POST['userinfo'];
$isexists=$_POST['isexists'];

//$isexists=1;
//$userinfo='{"address":"Defence Colony Muradnagar","email_id":"akshaybmsa","user_alternate_phn_number":"9431824984","user_gender":"Male","user_name":"Akshay Sharma","user_phn_number":"9627819594"}';

$itemdetail=json_decode($userinfo,true);

//echo $itemdetail["user_name"];
$userphn=$itemdetail["user_phn_number"];
$username=mysqli_real_escape_string($con,$itemdetail["user_name"]);
$useralternatephnnumber=$itemdetail["user_alternate_phn_number"];
$emailid=mysqli_real_escape_string($con,$itemdetail["email_id"]);
$address=$itemdetail["address"];
$usergender=$itemdetail["user_gender"];


if($isexists==0)
{
$sql_query="INSERT INTO `yp_users`(`user_phn_number`,`user_alternate_phn_number`,`user_name`,`email_id`,`address`,`user_gender`) VALUES ('$userphn','$useralternatephnnumber','$username','$emailid','$address','$usergender')";
$result = $con->query($sql_query);
if($result)
{
  $trans=1;
}
else {
//echo "Data Insertion error....".mysqli_error($con);
mysqli_rollback($con);
}
}

else if($isexists==1)
{
  $sql_query="UPDATE `yp_users` SET `user_alternate_phn_number`='$useralternatephnnumber',`user_name`='$username',`email_id`='$emailid',`address`='$address',`user_gender`='$usergender' WHERE user_phn_number ='$userphn'";
  $result = $con->query($sql_query);
  if($result)
  {
    $trans=1;
  }
  else {
//  echo "Data Insertion error....".mysqli_error($con);
mysqli_rollback($con);
  }
}

echo $trans;

?>
