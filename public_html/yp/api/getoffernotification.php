<?php
require "init.php";
$id=$_POST['id'];

$anyerror=true;
$sql_query="SELECT * FROM `yp_notification` WHERE id='$id'";

$result = $con->query($sql_query);
$item ;
if($result)
{
$anyerror=false;
while($row=$result->fetch_assoc())
{
$item=$row;
}
}

else {
//echo "Data Insertion error....".mysqli_error($con);
}

echo json_encode(array("items"=>$item,"error"=>$anyerror));

?>
