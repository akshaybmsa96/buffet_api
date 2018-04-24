<?php
$db_name="u695383935_yprep";
$mysql_user="u695383935_root2";
$mysql_pass="root12345";
$server_name="mysql.hostinger.in";

$con=mysqli_connect($server_name,$mysql_user,$mysql_pass,$db_name);

if(!$con)
{
//echo"Connection Error....".mysqli_connect_error();
}

else
{
//echo"<h3>Database Connection Success....</h3>";
}


?>