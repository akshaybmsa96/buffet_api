
<?php
require "init.php";


$sql_query="SELECT `id`, `category_id`, `menu_name`, CEIL(price) as price,
`size`, `offer_id`, `topping_count`, `image`, `cat_id`, `category_name`,
`sub_category_name`, `topping_id`, `topping_name`, `offer_details`,
`discount_price`, `isCustomisation`, `isRecommended`, `extra_cheese_price`,
`extra_topping_price`, `extra_cheese_burst_price`, `extra_wheat_crust_price`,
`extra_italian_crust_price`, `extra_pan_crush_price` FROM `yp_menu`
ORDER BY category_id";

$result = $con->query($sql_query);
$anyerror=true;
$item1 = array();
$item2 = array();
$item3 = array();

$jsone;
if (!($result->num_rows > 0))
{
	//echo json_encode(array("name"=>"NEW CUSTOMER","alphno"=>"","address"=>""));
}

else if($result)
{
   $anyerror=false;
   while($row=$result->fetch_assoc())
{
  if($row["category_name"]=="Pizza")
  {
    $item1[]=$row;
  }

 if($row["category_name"]=="Sides")
{
  $item2[]=$row;
}

if($row["isRecommended"]=="1" || $row["offer_id"]=="1")
{
  $item3[]=$row;
}
//   array_push($item,array("name"=>$row["menu_name"]));
}
$message=array("Pizza"=>$item1,"Sides"=>$item2,"Recommended"=>$item3);
}

//$jsone=json_encode(array("Pizza"=>$message));
echo json_encode(array("message"=>$message,"error"=>$anyerror));

?>
