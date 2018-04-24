<?php
require "init.php";
$anyerror=1;
$fromdate=$_POST['fromdate'];
$todate=$_POST['todate'];
$centre=$_POST['centre'];


$sale=null;
$orders=null;
$item=array();

/*
$fromdate='09/01/2018';
$todate='21/01/2018';
$centre='RDC ghaziabad';
*/

$sql_query="SELECT sum(sale) as sale,sum(orders) as orders FROM `yp_sale` WHERE  date BETWEEN '$fromdate' and '$todate' and centre = '$centre';";
$result = $con->query($sql_query);
if($result)
{
  $row=$result->fetch_assoc();
  $sale=$row['sale'];
  $orders=$row['orders'];

  $sql_query="SELECT itemname,sum(qty) as qty,sum(total_item_cost) as totalcost,unit FROM `yp_sale_items` where DATE BETWEEN '$fromdate' and '$todate' and centre = '$centre' Group By itemname;";
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
