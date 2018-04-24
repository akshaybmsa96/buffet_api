
<?php
require "init.php";

$anyerror=true;
//$userid="1234";
//$skip=0;
$userid=$_POST['userid'];
$skip=$_POST['skip'];
$sql_query="SELECT * FROM yp_order_items where user_id='$userid' ORDER BY order_id DESC LIMIT 10 OFFSET $skip";

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

else {
//echo "Data Insertion error....".mysqli_error($con);
}

echo json_encode(array("items"=>$item,"error"=>$anyerror));

?>
