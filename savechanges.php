<?php


include 'credentials.php';

$usernameorder="";
$hashnameorder="";
$ordername = "";
$items = "";
$id="";



if($_POST)
{
	//$usernameorder=sanitize($_POST['usernameorder']);
	$usernameorder=htmlspecialchars($_POST['usernameorder']);
	$hashnameorder=htmlspecialchars($_POST['hashnameorder']);
	$id = htmlspecialchars($_POST['id']);
	$ordername=htmlspecialchars($_POST['ordername']);
	$items=($_POST['item']);


echo '{"response":"' . $usernameorder . " - " . $hashnameorder . " - " . $id . " - " . $ordername . " - " . $items . '"}';

	$comma_separated = implode(",", $items);

	//cleaning any , at the end
	$last = substr($comma_separated, -1); 
	while ($last == ","){
		if ($last == ","){
			$comma_separated = substr($comma_separated, 0, -1);
		}
		$last = substr($comma_separated, -1); 
	}

	$ok = 0;
	while ($ok ==0){
		    $pos = strpos($comma_separated, ",,");
		    if ($pos === false) {
		    	$ok =1;
		    }
		    else{
				$comma_separated = str_replace(",,", ",", $comma_separated);
		    }
	}





	// image upload


		$target_dir = "uploads/";
		$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);

		//echo $_FILES["fileToUpload"]["name"];
		$image = $_FILES["fileToUpload"]["name"];
		$uploadOk = 1;
		$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
		// Check if image file is a actual image or fake image
		if(isset($_POST["submit"])) {
		    $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
		    if($check !== false) {
		        //echo "File is an image - " . $check["mime"] . ".";
		        $uploadOk = 1;
		    } else {
		        //echo "File is not an image.";
		        $uploadOk = 0;
		    }
		}
		// Check if file already exists
		if (file_exists($target_file)) {
		    //echo "Sorry, file already exists.";
		    $uploadOk = 0;
		}
		// Check file size
		if ($_FILES["fileToUpload"]["size"] > 500000) {
		    //echo "Sorry, your file is too large.";
		    $uploadOk = 0;
		}
		// Allow certain file formats
		if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
		&& $imageFileType != "gif" ) {
		    //echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
		    $uploadOk = 0;
		}
		// Check if $uploadOk is set to 0 by an error
		if ($uploadOk == 0) {
		    //echo "Sorry, your file was not uploaded.";
		// if everything is ok, try to upload file
		} else {
		    if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
		        //echo "The file ". basename( $_FILES["fileToUpload"]["name"]). " has been uploaded.";
		    } else {
		        //echo "Sorry, there was an error uploading your file.";
		    }
		}





foreach ($_FILES["images"]["error"] as $key => $error) {
  if ($error == UPLOAD_ERR_OK) {
    $name = $_FILES["images"]["name"][$key];
    move_uploaded_file( $_FILES["images"]["tmp_name"][$key], "uploads/" . $_FILES['images']['name'][$key]);
  }
}


}


//////////////////////////////////////////////////////////////////////////////////////////////////////////////
//MSQLI & PREPARE


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


         if ($image != null || $image != ""){

	     	//$sql = "UPDATE orders SET ordername='$order', items='$comma_separated', image='$image' WHERE id='$id' AND user = '$usernameorder'";
	     	//$sql = "UPDATE orders SET ordername=?, items=?, image=? WHERE id=? AND user =?";
	        if ($stmt2 = $mysqli->prepare("UPDATE orders SET ordername=?, items=?, image=? WHERE id=? AND user =?")) {
	              $stmt2->bind_param("sssss", $ordername, $comma_separated,  $image, $id ,$usernameorder);
	              $stmt2->execute();
	              $found =1;
	        }
	 	 }
	 	 else{

	 	 	//$sql = "UPDATE orders SET ordername='$order', items='$comma_separated' WHERE id='$id' AND user = '$usernameorder'";
	 	 	//$sql = "UPDATE orders SET ordername=?, items=? WHERE id=? AND user = ?";
	        if ($stmt2 = $mysqli->prepare("UPDATE orders SET ordername=?, items=? WHERE id=? AND user = ?")) {
		              $stmt2->bind_param("ssss", $ordername, $comma_separated, $id ,$usernameorder);
		              $stmt2->execute();
		              $found =1;
		        }
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
                  echo "1";
              }




// $con = mysql_connect($server, $username, $password) or die ("Could not connect: " . mysql_error());
// mysql_select_db($database, $con);


// 	$con = mysql_connect($server, $username, $password) or die ("Could not connect: " . mysql_error());
// 	mysql_select_db($database, $con);


// 	    $sql0 = "SELECT username FROM users where cookie LIKE '" .  $usernameorder . "'";
//         $result0 = mysql_query($sql0) or die ("Query error: " . mysql_error());
//         while($row0 = mysql_fetch_array($result0)) {
//             $usernameorder = $row0[0];

// 		}

// 		 if ($image != null || $image != ""){
// 	     	$sql = "UPDATE orders SET ordername='$order', items='$comma_separated', image='$image' WHERE id='$id' AND user = '$usernameorder'";
// 	 	 }
// 	 	 else{
// 	 	 	$sql = "UPDATE orders SET ordername='$order', items='$comma_separated' WHERE id='$id' AND user = '$usernameorder'";
// 	 	 }
//          //echo $sql;
//          $result = mysql_query($sql) or die ("Query error: " . mysql_error());

// mysql_close($con);




?>