<?php

include 'credentials.php';


if($_POST)
{
	$user=$_POST['username'];



}



//echo $user; 


$con = mysql_connect($server, $username, $password) or die ("Could not connect: " . mysql_error());
mysql_select_db($database, $con);

    $found = "";

	$con = mysql_connect($server, $username, $password) or die ("Could not connect: " . mysql_error());
	mysql_select_db($database, $con);

        $sql = "SELECT username FROM users where cookie LIKE '" .  $user . "'";
        $result = mysql_query($sql) or die ("Query error: " . mysql_error());
         while($row = mysql_fetch_array($result)) {
              
             $user = $row[0];

          }



	
         $sql = "SELECT * FROM orders where user LIKE '" .  $user . "'";
         //echo $sql;
         $result = mysql_query($sql) or die ("Query error: " . mysql_error());
         while($row = mysql_fetch_array($result)) {
              
             $rows[] = $row;
             $found = 1;
         //    $table = $table . "<tr><td>" .  $row[1] .  "</td>" .  "<td>" .  $row[2] .  "</td></tr>";
         //    //echo $found;
 
              

    
          }

         $table2 = json_encode($rows);

         //echo $table;
         if ($found == ""){
          	echo '{"response":"0", "table":"0"}';
          }else{
          	echo $table2;
          }


mysql_close($con);




?>
