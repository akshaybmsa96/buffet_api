<?php
require "init.php";

$anyerror=true;
//$skip=0;
$skip=$_POST['skip'];
$dcentre=$_POST['dcentre'];
$sql_query="SELECT * FROM yp_orders WHERE (isConfirmed='1' or isCanceled='1') and delivery_centre='$dcentre' ORDER BY order_id DESC LIMIT 10 OFFSET $skip";

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

else {
//echo "Data Insertion error....".mysqli_error($con);
}

echo json_encode(array("items"=>$item,"error"=>$anyerror));

?>
