<?php


include 'credentials.php';



$deleteid="";


if($_POST)
{
	$deleteid=($_POST['deleteid']);
	$user=($_POST['user']);

}


// echo $id;
// echo "<br>";


$pos = strpos($deleteid, '$');
// echo $pos;
// echo "<br>";

$user = substr($deleteid, $pos);
// echo $user;
// echo "<br>";
$deleteid = substr($deleteid, 0, $pos);
// echo $id;
// echo "<br>";

//echo $username; 





$con = mysql_connect($server, $username, $password) or die ("Could not connect: " . mysql_error());
mysql_select_db($database, $con);


	$con = mysql_connect($server, $username, $password) or die ("Could not connect: " . mysql_error());
	mysql_select_db($database, $con);
	     

        $sql0 = "SELECT * FROM users where cookie LIKE '" .  $user . "'";
        $result0 = mysql_query($sql0) or die ("Query error: " . mysql_error());
        while($row0 = mysql_fetch_array($result0)) {

		         $sql = "DELETE FROM orders WHERE id =" . $deleteid;
		         echo $sql;
		         $result = mysql_query($sql) or die ("Query error: " . mysql_error());

        }


mysql_close($con);




?>