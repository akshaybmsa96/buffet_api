<?php
require "init.php";

$anyerror=true;
//$adminid="312568";
$adminid=$_POST['adminid'];
$sql_query="SELECT centre_name FROM `yp_delivery_centres` WHERE centre_id='$adminid';";

$result = $con->query($sql_query);
$item ;
if($result)
{
$anyerror=false;
while($row=$result->fetch_assoc())
{
$item=$row;
}
}

else {
//echo "Data Insertion error....".mysqli_error($con);
}

echo json_encode(array("items"=>$item,"error"=>$anyerror));

?>
