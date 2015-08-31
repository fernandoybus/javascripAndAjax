<?php


include 'credentials.php';



$deleteid="";


if($_POST)
{
	$id=htmlspecialchars($_POST['deleteid']);
	$usernameorder=htmlspecialchars($_POST['username']);
	$hashnameorder = htmlspecialchars($_POST['hash']);

}











$con = mysql_connect($server, $username, $password) or die ("Could not connect: " . mysql_error());
mysql_select_db($database, $con);


	$con = mysql_connect($server, $username, $password) or die ("Could not connect: " . mysql_error());
	mysql_select_db($database, $con);
	     

        $sql0 = "SELECT * FROM users where cookie LIKE '" .  $user . "'";
        $result0 = mysql_query($sql0) or die ("Query error: " . mysql_error());
        while($row0 = mysql_fetch_array($result0)) {

		         $sql = "DELETE FROM orders WHERE id =" . $id;
		         echo $sql;
		         $result = mysql_query($sql) or die ("Query error: " . mysql_error());

        }


mysql_close($con);




?>