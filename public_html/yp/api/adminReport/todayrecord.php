<?php
require "init.php";
$anyerror=1;
$date=$_POST['date'];
$centre=$_POST['centre'];


$sale=null;
$orders=null;
$item=array();

/*
$date='25/01/2018';
$centre='RDC ghaziabad';
*/

$sql_query="SELECT sum(sale) as sale,sum(orders) as orders FROM `yp_sale` WHERE  date = '$date' and centre = '$centre';";
$result = $con->query($sql_query);
if($result)
{
  $row=$result->fetch_assoc();
  $sale=$row['sale'];
  $orders=$row['orders'];

  $sql_query="SELECT itemname,sum(qty) as qty,sum(total_item_cost) as totalcost, cost_per_unit, unit FROM `yp_sale_items` where DATE = '$date' and centre = '$centre' Group By itemname;";
  $result = $con->query($sql_query);
  if($result)
  {
    while($row=$result->fetch_assoc())
    {
      $item[]=$row;
      }
        $anyerror=0;
      }

      else {
        $anyerror=1;
      }

}


else {
  echo"Data Insertion error....".mysqli_error($con);
  $trans=0;
}

echo json_encode(array("sale"=>$sale,"orders"=>$orders,"items"=>$item,"error"=>$anyerror));


?>
