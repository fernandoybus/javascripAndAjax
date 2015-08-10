<?php


$usernameorder="";
$order = "";
$items = "";
$id="";



if($_POST)
{
	$usernameorder=$_POST['usernameorder'];
	$id = $_POST['id'];
	$order=$_POST['ordername'];
	$items=$_POST['item'];



	$comma_separated = implode(",", $items);

	//cleaning any , at the end
	$last = substr($comma_separated, -1); 
	while ($last == ","){
		if ($last == ","){
			$comma_separated = substr($comma_separated, 0, -1);
		}
		$last = substr($comma_separated, -1); 
	}

}


//hard code test
// $usernameorder="fernandoybus";
// $order = "ordem 34";
// $items = ["item 33", "item 33"];
// $id="19";




$server = "localhost";
$username = "lamp";
$password = "1";
$database = "javascript";

$con = mysql_connect($server, $username, $password) or die ("Could not connect: " . mysql_error());
mysql_select_db($database, $con);


	$con = mysql_connect($server, $username, $password) or die ("Could not connect: " . mysql_error());
	mysql_select_db($database, $con);
	     $sql = "UPDATE orders SET ordername='$order', items='$comma_separated' WHERE id='$id' AND user = '$usernameorder'";
         //$sql = "INSERT INTO orders (user, ordername, items) VALUES('$usernameorder', '$order', '$comma_separated')";
         echo $sql;
         $result = mysql_query($sql) or die ("Query error: " . mysql_error());

mysql_close($con);




?>