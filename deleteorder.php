<?php





$deleteid="";


if($_POST)
{
	$deleteid=$_POST['deleteid'];

}






$server = "localhost";
$username = "lamp";
$password = "1";
$database = "javascript";

$con = mysql_connect($server, $username, $password) or die ("Could not connect: " . mysql_error());
mysql_select_db($database, $con);


	$con = mysql_connect($server, $username, $password) or die ("Could not connect: " . mysql_error());
	mysql_select_db($database, $con);
	     //$sql = "DELETE FROM MyGuests WHERE id=3";
         $sql = "DELETE FROM orders WHERE id =" . $deleteid;
         echo $sql;
         $result = mysql_query($sql) or die ("Query error: " . mysql_error());

mysql_close($con);




?>