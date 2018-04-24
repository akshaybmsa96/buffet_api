
<?php
require "init.php";

$anyerror=true;
$sql_query="SELECT centre_name FROM yp_delivery_centres";

$result = $con->query($sql_query);
$item = array();
if($result)
{
$anyerror=false;
while($row=$result->fetch_assoc())
{
$item[]=$row;
}
}

echo json_encode(array("items"=>$item,"error"=>$anyerror));
?>
