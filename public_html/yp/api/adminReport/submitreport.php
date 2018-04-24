<?php
require "init.php";
$trans=0;
$itempojo=$_POST['itempojo'];
$date=$_POST['date'];
$sale=$_POST['sale'];
$orders=$_POST['orders'];
$materialcost=$_POST['materialcost'];
$centre=$_POST['centre'];

/*
$itempojo='[{"costPerUnit":"10.5","id":2,"itemName":"Mushroom","qty":"67","totalItemCost":"703.5","unit":"KG"},
{"costPerUnit":"10.5","id":1,"itemName":"Mozzrella","qty":"67","totalItemCost":"703.5","unit":"KG"}]';

$date='12/04/2017';
$sale='20124';
$orders='15';
$materialcost='4508';
$centre='RDC Ghaziabad';
*/

$itemdetail=json_decode($itempojo,true);

$sql_query="DELETE FROM `yp_sale` WHERE date ='$date' and centre='$centre'";
$result =$con->query($sql_query);

$sql_query="DELETE FROM `yp_sale_items` WHERE date ='$date' and centre='$centre'";
$result =$con->query($sql_query);

$sql_query="INSERT INTO `yp_sale`(`date`, `centre` ,`sale`, `orders`, `material_cost`) VALUES ('$date','$centre','$sale','$orders','$materialcost')";
$result = $con->query($sql_query);
if($result)
{
  foreach ($itemdetail as $item) {

    $itemname=mysql_real_escape_string($item["itemName"]);
    $qty=mysql_real_escape_string($item["qty"]);
    $costperunit=mysql_real_escape_string($item["costPerUnit"]);
    $totalitemcost=mysql_real_escape_string($item["totalItemCost"]);
    $unit=mysql_real_escape_string($item["unit"]);

    $sql_query="INSERT INTO `yp_sale_items`(`date`, `centre` ,`itemname`, `qty`, `cost_per_unit`, `total_item_cost`, `unit`) VALUES ('$date','$centre','$itemname','$qty','$costperunit','$totalitemcost','$unit')";
    $result = $con->query($sql_query);
    if($result)
    {
        $trans=1;
    }

    else {
      echo"Data Insertion error....".mysqli_error($con);
       $trans=0;
    }
}
}

else {
  echo"Data Insertion error....".mysqli_error($con);
  $trans=0;
}

echo $trans;


?>
