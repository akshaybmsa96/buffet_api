<?php
require "init.php";

$anyerror=0;
$orderid=$_POST['orderid'];
$sql_query="UPDATE `yp_orders` SET `isConfirmed`='1', order_date=order_date WHERE order_id='$orderid'";

$result = $con->query($sql_query);

if($result)
{
  $sql_query="UPDATE `yp_order_items` SET `isConfirmed`='1' WHERE order_id='$orderid'";
  $result = $con->query($sql_query);

  if($result)
  {
    $anyerror=1;
  }

}

else {
//echo "Data Insertion error....".mysqli_error($con);
}

echo $anyerror;

?>
