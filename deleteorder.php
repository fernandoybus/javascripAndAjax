<?php


include 'credentials.php';



$deleteid="";


if($_POST)
{
	$id=htmlspecialchars($_POST['deleteid']);
	$usernameorder=htmlspecialchars($_POST['username']);
	$hashnameorder = htmlspecialchars($_POST['hash']);

}


// echo $id;
// echo "<br>";


// $pos = strpos($deleteid, '$');
// // echo $pos;
// // echo "<br>";

// $user = substr($deleteid, $pos);
// // echo $user;
// // echo "<br>";
// $deleteid = substr($deleteid, 0, $pos);
// // echo $id;
// echo "<br>";

//echo $username; 


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


         if ($stmt2 = $mysqli->prepare("DELETE FROM orders WHERE id=? AND user=?")) {

              $stmt2->bind_param("ss", $id, $usernameorder );

              // /* execute query */
              $stmt2->execute();

             
              $found =1;

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
                  echo $found;
              }






// $con = mysql_connect($server, $username, $password) or die ("Could not connect: " . mysql_error());
// mysql_select_db($database, $con);


// 	$con = mysql_connect($server, $username, $password) or die ("Could not connect: " . mysql_error());
// 	mysql_select_db($database, $con);
	     

//         $sql0 = "SELECT * FROM users where cookie LIKE '" .  $user . "'";
//         $result0 = mysql_query($sql0) or die ("Query error: " . mysql_error());
//         while($row0 = mysql_fetch_array($result0)) {

// 		         $sql = "DELETE FROM orders WHERE id =" . $deleteid;
// 		         echo $sql;
// 		         $result = mysql_query($sql) or die ("Query error: " . mysql_error());

//         }


// mysql_close($con);




?>