<?php
require "init.php";

$anyerror=true;
$dcentre=$_POST['dcentre'];
$sql_query="SELECT * FROM `yp_orders` WHERE (isConfirmed='0' and isCanceled='0') and delivery_centre='$dcentre' ORDER BY order_id DESC ";

$result = $con->query($sql_query);
$item = array();
if($result)
{
$anyerror=false;
while($row=$result->fetch_assoc())
{
$item[]=$row;
}
}

echo json_encode(array("items"=>$item,"error"=>$anyerror));
?>
