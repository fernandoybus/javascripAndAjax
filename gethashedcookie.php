<?php


include 'credentials.php';

if($_POST)
{
	$name=$_POST['name'];

}


// echo $name;
// echo "<br>";



$custo = '08';
$salt = 'Cf1213eParGlBJoOM0F6aJ';
// Gera um hash baseado em bcrypt
$hash = crypt($name . time(), '$2a$' . $custo . '$' . $salt . '$');

// echo $hash;




$con = mysql_connect($server, $username, $password) or die ("Could not connect: " . mysql_error());
mysql_select_db($database, $con);


	$con = mysql_connect($server, $username, $password) or die ("Could not connect: " . mysql_error());
	mysql_select_db($database, $con);
	

	         $sql = "UPDATE users SET cookie= '" . $hash ."' WHERE username LIKE '" . $name . "'";
	         //echo $sql;
             //echo "<br>";
	         $result = mysql_query($sql) or die ("Query error: " . mysql_error());
	         //echo $result;

	      
	         echo '{"response":"1", "cookie": "' .  $hash . '"}';





mysql_close($con);




?>
