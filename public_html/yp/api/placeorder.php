<?php
require "init.php";
$trans=0;
$orderitems=$_POST['orderitem'];
/*
$orderitems='{"delivery_centre":"","id":0,
  "items":[{"add_to_cart_at":"2017-11-14 20:24:31","extra_add_on":"",
"extra_price":"","id":"65","item_base_price":"69","item_name":"Cheese Bomb",
"item_quantity":"1","item_size":"Regular","item_toppings":"",
"total_base_price":"69","total_price":"69","user_phn_number":"1234"},
{"add_to_cart_at":"2017-11-14 17:31:31","extra_add_on":"Cheese ",
  "extra_price":"10","id":"66","item_base_price":"55","item_name":"Veggie Single"
  ,"item_quantity":"1","item_size":"Regular","item_toppings":"Corn",
  "total_base_price":"65","total_price":"65","user_phn_number":"1234"},
  {"add_to_cart_at":"2017-11-14 20:24:51","extra_add_on":"Cheese ",
    "extra_price":"10","id":"67","item_base_price":"65",
    "item_name":"Cheesy Single","item_quantity":"1","item_size":"Regular",
    "item_toppings":"","total_base_price":"75","total_price":"75",
    "user_phn_number":"1234"},{"add_to_cart_at":"2017-11-14 22:30:31",
      "extra_add_on":"Toppings Wheat Thin Crust ","extra_price":"50","id":"68",
      "item_base_price":"149","item_name":"Cheese Pizza","item_quantity":"1",
      "item_size":"Medium","item_toppings":"","total_base_price":"199",
      "total_price":"199","user_phn_number":"1234"}],"no_of_items":"4",
      "total_price":"408","user_address":"Defence Colony Muradnagar",
      "user_name":"xyz","user_phn_number":"1234","user_id":"1234"}
';
*/
$itemdetail=json_decode($orderitems,true);



//echo $itemdetail["extra_price"];
$userid=mysqli_real_escape_string($con,$itemdetail["user_id"]);
$userphn=mysqli_real_escape_string($con,$itemdetail["user_phn_number"]);
$userame=mysqli_real_escape_string($con,$itemdetail["user_name"]);
$noofitems=$itemdetail["no_of_items"];
$useralternatenumber=mysqli_real_escape_string($con,$itemdetail["user_alternate_phn_number"]);
$cookinginstructions=mysqli_real_escape_string($con,$itemdetail["cooking_instructions"]);
$useraddress=mysqli_real_escape_string($con,$itemdetail["user_address"]);
$deliverycentre=mysqli_real_escape_string($con,$itemdetail["delivery_centre"]);
$totalprice=mysqli_real_escape_string($con,$itemdetail["total_price"]);

$sql_query="SELECT (CURRENT_TIMESTAMP) AS x";
$result = $con->query($sql_query);
$row=$result->fetch_assoc();
//echo $row['x'];

if($result)
{

  $orderid=$row['x'].$userid;
$sql_query="INSERT INTO `yp_orders`(`user_id`,`order_id`,`user_phn_number`, `user_alternate_phn_number` ,`user_name`, `no_of_items`, `user_address`, `delivery_centre`, `cooking_instructions` ,`total_price`) VALUES ('$userid','$orderid','$userphn','$useralternatenumber','$userame','$noofitems','$useraddress','$deliverycentre','$cookinginstructions','$totalprice')";
$result = $con->query($sql_query);
if($result)
{
  foreach ($itemdetail["items"] as $item) {

    $itemname=mysqli_real_escape_string($con,$item["item_name"]);
    $itemsize=$item["item_size"];
    $itembaseprice=$item["item_base_price"];
    $offer=$item["offer_detail"];
    $itemtopping=$item["item_toppings"];
    $itemquantity=$item["item_quantity"];
    $extraaddon=$item["extra_add_on"];
    $extraprice=$item["extra_price"];
    $totalbaseprice=$item["total_base_price"];
    $totalprice=$item["total_price"];

    $sql_query="INSERT INTO `yp_order_items`(`user_id`,`order_id`,`user_phn_number`, `item_name`, `item_size`, `offer_detail`, `item_base_price`, `item_toppings`, `item_quantity`, `extra_add_on`, `extra_price`, `total_base_price`, `total_price`) VALUES ('$userid','$orderid','$userphn','$itemname','$itemsize','$offer','$itembaseprice','$itemtopping','$itemquantity','$extraaddon','$extraprice','$totalbaseprice','$totalprice')";
    $result = $con->query($sql_query);
    if($result)
    {
      $sql_query="UPDATE `yp_cart` SET `isConfirmed`='1' WHERE user_id=$userid";
      $result = $con->query($sql_query);
      if($result)
      {
        $trans=1;
      }
    }

    else {
    //  echo"Data Insertion error....".mysqli_error($con);
    $trans=0;
    mysqli_rollback($con);
    }
}
}

else {
  //echo"Data Insertion error....".mysqli_error($con);
  mysqli_rollback($con);
  $trans=0;
}
}

else {
  //echo"Data Insertion error....".mysqli_error($con);
  mysqli_rollback($con);
  $trans=0;
}

echo $trans;


?>
