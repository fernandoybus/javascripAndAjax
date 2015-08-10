<?php




if($_POST)
{
	$id=$_POST['editid'];



}







//echo $username; 

$server = "localhost";
$username = "lamp";
$password = "1";
$database = "javascript";

$con = mysql_connect($server, $username, $password) or die ("Could not connect: " . mysql_error());
mysql_select_db($database, $con);

    $found = "";

	$con = mysql_connect($server, $username, $password) or die ("Could not connect: " . mysql_error());
	mysql_select_db($database, $con);
	//SELECT * FROM `users` WHERE `username` LIKE 'fernandoybus' AND `password` LIKE 'test'
         $sql = "SELECT * FROM orders where id LIKE '" .  $id . "'";
         //echo $sql;
         $result = mysql_query($sql) or die ("Query error: " . mysql_error());

         //$table= "<table><th>User</th><th>Order no</th>";
         while($row = mysql_fetch_array($result)) {
              
             $rows[] = $row;
             $found = 1;
         //    $table = $table . "<tr><td>" .  $row[1] .  "</td>" .  "<td>" .  $row[2] .  "</td></tr>";
         //    //echo $found;
 
              

    
          }

         $table2 = json_encode($rows);

         //$table =  $table . "</table>";
         //echo $table;
         if ($found == ""){
          	echo '{"response":"0", "table":"0"}';
          }else{
          	echo $table2;
          }


mysql_close($con);




?>
