<?php
require "init.php";
$anyerror=1;
$fromdate=$_POST['fromdate'];
$todate=$_POST['todate'];
$centre=$_POST['centre'];


$sale=null;
$item=array();

/*
$fromdate='25/01/2018';
$todate='25/01/2018';
$centre='RDC ghaziabad';
*/


$sql_query="SELECT sum(sale) as sale FROM `yp_sale` WHERE  date BETWEEN '$fromdate' and '$todate' and centre = '$centre';";
$result = $con->query($sql_query);
if($result)
{
  $row=$result->fetch_assoc();
  $sale=$row['sale'];

  $sql_query="SELECT itemname,sum(qty) as qty, sum(total_item_cost) as totalcost,unit FROM `yp_sale_items` where DATE BETWEEN '$fromdate' and '$todate' and centre = '$centre' Group By itemname;";
  $result = $con->query($sql_query);
  if($result)
  {
    while($row=$result->fetch_assoc())
    {
      $item[]=$row;
      }
        $anyerror=0;
      }
    }

      else {
        $anyerror=1;
        echo "Error....".mysqli_error($con);
      }


echo json_encode(array("sale"=>$sale,"items"=>$item,"error"=>$anyerror));


?>
