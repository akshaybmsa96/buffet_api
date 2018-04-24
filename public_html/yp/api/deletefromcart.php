<?php
require "init.php";

$anyerror=true;
//$itemid="39";
$itemid=$_POST['itemid'];

$sql_query="DELETE FROM `yp_cart` WHERE id='$itemid'";

$result = $con->query($sql_query);
if($result)
{
  $trans=true;
  echo $trans;
}


else
{
echo $trans;
//echo"Data Insertion error....".mysqli_error($con);
}

?>
