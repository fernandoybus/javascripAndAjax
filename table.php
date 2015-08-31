<?php

include 'credentials.php';


if($_POST)
{
	//$user=sanitize($_POST['username']);

  $user=htmlspecialchars($_POST['username']);
  $hash=htmlspecialchars($_POST['hash']);



}


// $user = 'fernandoybus';
// $hash ='$2a$08$Cf1213eParGlBJoOM0F6a.Nn5Jf40xwp3cx4nVmbrfIojNgKmGYza';
//echo $user; 



// $found = "";

// $mysqli = new mysqli($server, $username, $password, $database);

// /* check connection */
// if (mysqli_connect_errno()) {
//     printf("Connect failed: %s\n", mysqli_connect_error());
//     exit();
// }


// /* create a prepared statement */
// if ($stmt = $mysqli->prepare("SELECT id FROM users WHERE username=? AND cookie=?")) {

//     /* bind parameters for markers */
//     $stmt->bind_param("ss", $user, $hash);

//     /* execute query */
//     $stmt->execute();

//     $result = $stmt->get_result();



//     /* now you can fetch the results into an array - NICE */
//     while ($myrow = $result->fetch_assoc()) {

//         // use your $myrow array as you would with any other fetch
//         //printf("%s is in district %s\n", $city, $myrow['id']);

//         if ($stmt2 = $mysqli->prepare("SELECT * FROM orders where user=?")) {


//               $stmt2->bind_param("s", $user);

//               // /* execute query */
//               $stmt2->execute();

//               $result2 = $stmt2->get_result();


//                    while($row = $result2->fetch_assoc()) {
                        
//                        $rows[] = $row;
//                        $found = 1;
              
//                     }

//               $table2 = json_encode($rows);



//         }


//     }

//     /* close statement */
//     $stmt->close();
// }

// /* close connection */
// $mysqli->close();


//               //echo $table;
//               if ($found == ""){
//                  echo '{"response":"0", "table":"0"}';
//               }else{
//                  echo $table2;
//               }


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
