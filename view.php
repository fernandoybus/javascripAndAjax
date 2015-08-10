<?php

include 'credentials.php';

$first_name="";
$last_name="";
$items="";




$con = mysql_connect($server, $username, $password) or die ("Could not connect: " . mysql_error());
mysql_select_db($database, $con);


	$con = mysql_connect($server, $username, $password) or die ("Could not connect: " . mysql_error());
	mysql_select_db($database, $con);
         $sql = "SELECT * FROM names";
         $result = mysql_query($sql) or die ("Query error: " . mysql_error());

        while($row = mysql_fetch_array($result)) {
				
				//var_dump ($row[4]);
				//echo $row[4][1];
        		echo $row[4];
        		echo "<br>";
        		echo "<br>";
        		$array = explode(",", $row[4]);
    

			    foreach ($array as &$item) {
 					echo $item;
 					echo "<br>";
				 }
				 echo "<br>";

	
		 }

mysql_close($con);








?>