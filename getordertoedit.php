<?php


include 'credentials.php';


if($_POST)
{
	
  $id=htmlspecialchars($_POST['editid']);
  $usernameorder =htmlspecialchars($_POST['username']);
  $hashnameorder =htmlspecialchars($_POST['hash']);



}



//editid=121?username=fernandoybus&hash=$2a$08$Cf1213eParGlBJoOM0F6a.XPqr/NknPkWhdlowQMBjkfg9tmpZl1i

// $id = 119;
// $usernameorder = 'fernandoybus';
// $hashnameorder = '$2a$08$Cf1213eParGlBJoOM0F6a.PZwcyJRprWNC5/6zgTDFnhLwFJnRa9y';

//echo $id . "-" . $usernameorder. "-" . $hashnameorder;


$con = mysql_connect($server, $username, $password) or die ("Could not connect: " . mysql_error());
mysql_select_db($database, $con);

  $found = "";
  $rows = "";

	$con = mysql_connect($server, $username, $password) or die ("Could not connect: " . mysql_error());
	mysql_select_db($database, $con);
	//SELECT * FROM `users` WHERE `username` LIKE 'fernandoybus' AND `password` LIKE 'test'

        $sql0 = "SELECT * FROM users where cookie LIKE '" .  $hashnameorder . "'";
        $result0 = mysql_query($sql0) or die ("Query error: " . mysql_error());
        while($row0 = mysql_fetch_array($result0)) {
              
                      //echo "achou user<br>";
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
