<?php

include 'credentials.php';



$email="";


if($_POST)
{
	$email=$_POST['emailrecover'];



}





$con = mysql_connect($server, $username, $password) or die ("Could not connect: " . mysql_error());
mysql_select_db($database, $con);


	$con = mysql_connect($server, $username, $password) or die ("Could not connect: " . mysql_error());
	mysql_select_db($database, $con);

         $found =0;
         $sql = "SELECT password FROM users where email LIKE '" .  $emails . "'";
         $result = mysql_query($sql) or die ("Query error: " . mysql_error());

         while($row = mysql_fetch_array($result)) {
              
     
            $found = $row[0];
            //echo $found;
 

    
         }


          if ($found == 0){
            echo '{"response":"0", "msg": "' .  "email not found" . '"}';
         }

         if ($found != ""){

         	$custo = '08';
			$salt = 'Cf1213eParGlBJoOM0F6aJ';
			// Gera um hash baseado em bcrypt
			$hash = crypt($email . 'ybus', '$2a$' . $custo . '$' . $salt . '$');


	 	 	$sql = "UPDATE users SET retrievepassword='$hash', WHERE email='$email'";

            $result = mysql_query($sql) or die ("Query error: " . mysql_error());
            
          	mail($emails,"Password Recovery from Javascript/Ajax System by Y-bus","Click on link to create new password: http://localhost:8888/home/fernando/javascript/resetpassword.php?token=" . $pass . "&email=" . $email);


          }

mysql_close($con);




?>