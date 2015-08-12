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



          if ($found === 0){
            echo '{"response":"0", "msg": "' .  "error" . '"}';
         }

         if ($found == 1){



                    $custo = '08';
            $salt = 'Cf1213eParGlBJoOM0F6aJ';
            // Gera um hash baseado em bcrypt
            $hash = crypt($passwordnew , '$2a$' . $custo . '$' . $salt . '$');


            $sql = "UPDATE users SET password='" . $hash . "' WHERE email LIKE '" .$emailrecover . "'";
            //echo $sql;

            $result = mysql_query($sql) or die ("Query error: " . mysql_error());

            echo '1';
          }



         mysql_close($con);


?>