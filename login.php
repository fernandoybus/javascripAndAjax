<?php


include 'credentials.php';

if($_POST)
{
	$user=sanitize($_POST['username']);
	$pass=sanitize($_POST['password']);




}


//     $user="test";
//     $email = "asdf@asdf.com";
//     $pass="test";

// $x = "$2a$08$Cf1213eParGlBJoOM0F6a.03Adz4it.qyY.iPFdO.A2bJCIDmBdXC";



// echo $x;
// echo "<br>";

$custo = '08';
$salt = 'Cf1213eParGlBJoOM0F6aJ';
// Gera um hash baseado em bcrypt
$hash = crypt($pass, '$2a$' . $custo . '$' . $salt . '$');

// echo "<br>";
// echo $hash;

// if ($x == $hash){
//     echo "eguals";
// }




$con = mysql_connect($server, $username, $password) or die ("Could not connect: " . mysql_error());
mysql_select_db($database, $con);


	$con = mysql_connect($server, $username, $password) or die ("Could not connect: " . mysql_error());
	mysql_select_db($database, $con);
	//SELECT * FROM `users` WHERE `username` LIKE 'fernandoybus' AND `password` LIKE 'test'
         $sql = "SELECT * FROM users where username LIKE '" .  $user . "' AND password LIKE '" . $hash . "'";
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
