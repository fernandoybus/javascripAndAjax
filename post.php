<?php


$first_name="";
$last_name="";
$items="";
if($_POST)
{
	$first_name=$_POST['firstname'];
	$last_name=$_POST['lastname'];
	$items=$_POST['item'];


	$comma_separated = implode(",", $items);

	// foreach ($last_name as &$last) {
 //    $item = $item . $last;
	// }

	// $items = $item;

}


$server = "localhost";
$username = "lamp";
$password = "1";
$database = "javascript";

$con = mysql_connect($server, $username, $password) or die ("Could not connect: " . mysql_error());
mysql_select_db($database, $con);


	$con = mysql_connect($server, $username, $password) or die ("Could not connect: " . mysql_error());
	mysql_select_db($database, $con);
         $sql = "INSERT INTO names (first_name, last_name, items) VALUES('$first_name', '$last_name', '$comma_separated')";
         $result = mysql_query($sql) or die ("Query error: " . mysql_error());

mysql_close($con);




?>