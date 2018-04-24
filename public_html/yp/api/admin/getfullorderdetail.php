<?php
require "init.php";

$anyerror=true;
//$orderid="2017-12-18 14:24:059627819594";
$orderid=$_POST["orderid"];
$sql_query="SELECT * FROM yp_order_items where order_id='$orderid' ORDER BY order_id DESC";

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
