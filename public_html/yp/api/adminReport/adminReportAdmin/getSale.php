<?php
require "init.php";
$anyerror=1;
$fromdate=$_POST['fromdate'];
$todate=$_POST['todate'];

$item=array();

/*
$fromdate='23/01/2018';
$todate='23/01/2018';

*/

$sql_query="SELECT `centre`, sum(sale) as sale, sum(orders) as orders,sum(material_cost) as material_cost FROM `yp_sale` Where date BETWEEN '$fromdate' And '$todate' Group By centre";
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


echo json_encode(array("items"=>$item,"error"=>$anyerror));

?>
