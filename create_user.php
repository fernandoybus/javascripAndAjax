<?php


include 'credentials.php';

if($_POST)
{
	$user=$_POST['newusername'];
	$email = $_POST['newemail'];
	$pass=$_POST['newpassword'];




}


	// $user="test";
	// $email = "asdf@asdf.com";
	// $pass="asdfadsfasdf";




$custo = '08';
$salt = 'Cf1213eParGlBJoOM0F6aJ';
// Gera um hash baseado em bcrypt
$hash = crypt($pass, '$2a$' . $custo . '$' . $salt . '$');






$con = mysql_connect($server, $username, $password) or die ("Could not connect: " . mysql_error());
mysql_select_db($database, $con);


	$con = mysql_connect($server, $username, $password) or die ("Could not connect: " . mysql_error());
	mysql_select_db($database, $con);
	
         $found = 0;
		 // check uniqueness of username
         $sql = "SELECT * FROM users where username LIKE '" .  $user . "'";
         $result = mysql_query($sql) or die ("Query error: " . mysql_error());

         while($row = mysql_fetch_array($result)) {
             
            $found = $row[0];
    
         }

  
         if ($found != 0){
          	echo '{"response":"0", "user": "' .  "user already exist" . '"}';
          	$erro =1;
         }


         // check uniqueness of email
         if ($erro != 1){
		         
		         $sql = "SELECT * FROM users where email LIKE '" .  $email . "'";
		         $result = mysql_query($sql) or die ("Query error: " . mysql_error());

		         while($row = mysql_fetch_array($result)) {
		              
		     
		            $found = $row[0];

		    
		         }
		         if ($found != 0){
		          	echo '{"response":"-1", "user": "' .  "email already exist" . '"}';
		          	$erro =1;
		         }
     	 }

		 // insert new user
		 if ($erro != 1){
	         $sql = "INSERT INTO users (username, password, email) VALUES('$user', '$hash', '$email')";
	         $result = mysql_query($sql) or die ("Query error: " . mysql_error());

	      
	         echo '{"response":"1", "user": "' .  $user . '"}';

     	 }





mysql_close($con);




?>
