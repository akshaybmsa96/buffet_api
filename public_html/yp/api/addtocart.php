<?php
require "init.php";
$trans=false;
$cartitems=$_POST['cartitem'];

/*
$cartitems='{"category_name":"Pizza","extra_add_on":"","extra_price":"0",
"item_base_price":"55","item_name":"Veggie Single","item_size":"Regular",
"item_toppings":"Onion","offer_detail":"Buy 1 Get 1",
"sub_category_name":"Veg Singles","total_base_price":"55","total_price":"55",
"user_id":"9627819594","user_phn_number":"9627819594"}';
*/


$itemdetail=json_decode($cartitems,true);

//echo $itemdetail["item_name"];
$userid=$itemdetail["user_id"];
$userphn=$itemdetail["user_phn_number"];
$itemname=mysqli_real_escape_string($con,$itemdetail["item_name"]);
$itemsize=$itemdetail["item_size"];
$itembaseprice=$itemdetail["item_base_price"];
$category=$itemdetail["category_name"];
$subcategory=$itemdetail["sub_category_name"];
$offer=$itemdetail["offer_detail"];
$itemtopping=$itemdetail["item_toppings"];
$extraaddon=$itemdetail["extra_add_on"];
$extraprice=$itemdetail["extra_price"];
$totalbaseprice=$itemdetail["total_base_price"];
$totalprice=$itemdetail["total_price"];
$sql_query="INSERT INTO `yp_cart`(`user_id`, `user_phn_number`, `item_name`,`item_size`, `item_base_price`, `category_name`, `sub_category_name`, `offer_detail`, `item_toppings`, `extra_add_on`, `extra_price`, `total_base_price` ,`total_price`) VALUES ('$userphn','$userphn','$itemname','$itemsize','$itembaseprice','$category','$subcategory','$offer','$itemtopping','$extraaddon','$extraprice','$totalprice','$totalprice')";

$result = $con->query($sql_query);
if($result)
{
  $trans=true;
  echo $trans;
}
else
{
echo $trans;
echo"Data Insertion error....".mysqli_error($con);
}

?>
