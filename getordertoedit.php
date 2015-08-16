<?php


include 'credentials.php';


if($_POST)
{
	//$id=sanitize($_POST['editid']);
  $id=htmlspecialchars($_POST['editid']);
  $usernameorder =htmlspecialchars($_POST['username']);
  $hashnameorder =htmlspecialchars($_POST['hash']);



}



//editid=121?username=fernandoybus&hash=$2a$08$Cf1213eParGlBJoOM0F6a.XPqr/NknPkWhdlowQMBjkfg9tmpZl1i

// $id = 119;
// $usernameorder = 'fernandoybus';
// $hashnameorder = '$2a$08$Cf1213eParGlBJoOM0F6a.PZwcyJRprWNC5/6zgTDFnhLwFJnRa9y';

// echo $id . "-" . $usernameorder. "-" . $hashnameorder;

$found = "";

$mysqli = new mysqli($server, $username, $password, $database);

/* check connection */
if (mysqli_connect_errno()) {
    printf("Connect failed: %s\n", mysqli_connect_error());
    exit();
}


/* create a prepared statement */
if ($stmt = $mysqli->prepare("SELECT id FROM users WHERE username=? AND cookie=?")) {

    /* bind parameters for markers */
    $stmt->bind_param("ss", $usernameorder, $hashnameorder);

    /* execute query */
    $stmt->execute();

    $result = $stmt->get_result();



    /* now you can fetch the results into an array - NICE */
     while ($myrow = $result->fetch_assoc()) {

    //     // use your $myrow array as you would with any other fetch
    //     //printf("%s is in district %s\n", $city, $myrow['id']);


         if ($stmt2 = $mysqli->prepare("SELECT id, user, ordername, items, image FROM orders where id=? AND user=?")) {


                 $stmt2->bind_param("ss", $id, $usernameorder);

    //     //       // /* execute query */
                 $stmt2->execute();

                 $result2 = $stmt2->get_result();


                   while($row = $result2->fetch_assoc()) {
                        
                       $rows[] = $row;
                       $found = 1;
              
                    }

                    $table2 = json_encode($rows);



    //     // }






         }


     }

    /* close statement */
    $stmt->close();
}

/* close connection */
$mysqli->close();


              //echo $table;
              if ($found == ""){
                 echo '{"response":"0", "table":"0"}';
              }else{
                  echo $table2;
              }







// $con = mysql_connect($server, $username, $password) or die ("Could not connect: " . mysql_error());
// mysql_select_db($database, $con);

//   $found = "";
//   $rows = "";

// 	$con = mysql_connect($server, $username, $password) or die ("Could not connect: " . mysql_error());
// 	mysql_select_db($database, $con);
// 	//SELECT * FROM `users` WHERE `username` LIKE 'fernandoybus' AND `password` LIKE 'test'

//         $sql0 = "SELECT * FROM users where cookie LIKE '" .  $user . "'";
//         $result0 = mysql_query($sql0) or die ("Query error: " . mysql_error());
//         while($row0 = mysql_fetch_array($result0)) {
              
//                       //echo "achou user<br>";
//                       $sql = "SELECT * FROM orders where id LIKE '" .  $id . "'";
//                      //echo $sql;
//                      $result = mysql_query($sql) or die ("Query error: " . mysql_error());

//                      //$table= "<table><th>User</th><th>Order no</th>";
//                      while($row = mysql_fetch_array($result)) {
                          
//                          $rows[] = $row;
//                          $found = 1;
//                      //    $table = $table . "<tr><td>" .  $row[1] .  "</td>" .  "<td>" .  $row[2] .  "</td></tr>";
//                      //    //echo $found;
             
                          

                
//                       }
              

    
//           }




//          $table2 = json_encode($rows);

//          //$table =  $table . "</table>";
//          //echo $table;
//          if ($found == ""){
//           	echo '{"response":"0", "table":"0"}';
//           }else{
//           	echo $table2;
//           }


// mysql_close($con);




?>
