<?php

include 'credentials.php';



$passwordnew="";
$emailrecover="";


if($_POST)
{
	$emailrecover=$_POST['emailrecover'];
	$passwordnew=$_POST['passwordnew'];

}





$con = mysql_connect($server, $username, $password) or die ("Could not connect: " . mysql_error());
mysql_select_db($database, $con);


	$con = mysql_connect($server, $username, $password) or die ("Could not connect: " . mysql_error());
	mysql_select_db($database, $con);

         $found =0;
         $sql = "SELECT retrievepassword FROM users where email LIKE '" .  $emailrecover . "'";
         $result = mysql_query($sql) or die ("Query error: " . mysql_error());

         while($row = mysql_fetch_array($result)) {
              
     
            $found = $row[0];
            //echo $found;
 

    
         }

         mysql_close($con);

          if ($found == 0){
            echo '{"response":"0", "msg": "' .  "error" . '"}';
         }

         if ($found != ""){



         	$custo = '08';
			$salt = 'Cf1213eParGlBJoOM0F6aJ';
			// Gera um hash baseado em bcrypt
			$hash = crypt($passwordnew , '$2a$' . $custo . '$' . $salt . '$');


	 	 	$sql = "UPDATE users SET password='$hash', WHERE email='$emailrecover'";

            $result = mysql_query($sql) or die ("Query error: " . mysql_error());

            echo '{"response":"0", "msg": "' .  "1" . '"}';
          }






?>
