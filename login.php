<?php




if($_POST)
{
	$user=$_POST['username'];
	$pass=$_POST['password'];




}




//echo $username; 

$server = "localhost";
$username = "lamp";
$password = "1";
$database = "javascript";

$con = mysql_connect($server, $username, $password) or die ("Could not connect: " . mysql_error());
mysql_select_db($database, $con);


	$con = mysql_connect($server, $username, $password) or die ("Could not connect: " . mysql_error());
	mysql_select_db($database, $con);
	//SELECT * FROM `users` WHERE `username` LIKE 'fernandoybus' AND `password` LIKE 'test'
         $sql = "SELECT * FROM users where username LIKE '" .  $user . "' AND password LIKE '" . $pass . "'";
         $result = mysql_query($sql) or die ("Query error: " . mysql_error());

         while($row = mysql_fetch_array($result)) {
              
     
            $found = $row[0];
            //echo $found;
 
              
            if ($found <> ""){


             	echo '{"response":"1", "user": "' .  $user . '"}';

            }
    
         }
         if ($found == ""){
          	echo '{"response":"0"}';
          }

mysql_close($con);




?>
