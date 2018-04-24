<?php
require "init.php";


$sql_query="SELECT `itemName`,`cost_per_unit`, `unit` FROM `yp_items`";

$result = $con->query($sql_query);
$anyerror=true;
$item = array();

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
    $item[]=$row;
//   array_push($item,array("name"=>$row["menu_name"]));
}
}

//$jsone=json_encode(array("Pizza"=>$message));
echo json_encode(array("items"=>$item,"error"=>$anyerror));

?>
