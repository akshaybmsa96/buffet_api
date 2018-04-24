
<?php
require "init.php";

$anyerror=true;
//$userid="9627819594";
$userid=$_POST['userid'];
$sql_query="SELECT * FROM `yp_users` WHERE user_phn_number='$userid'";

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
