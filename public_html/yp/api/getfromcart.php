
<?php
require "init.php";

$anyerror=true;
//$userphn="1234";
$minOrder=100;
$userid=$_POST['userid'];
$sql_query="SELECT * FROM yp_cart where user_id='$userid' and isConfirmed='0'";

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

echo json_encode(array("items"=>$item,"error"=>$anyerror,"minOrder"=>$minOrder));

?>
