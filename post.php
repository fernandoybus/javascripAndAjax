<?php

include 'credentials.php';



$usernameorder="";
$order=" ";
$items="";

if($_POST)
{
	$usernameorder=($_POST['usernameorder']);
	$order=($_POST['order']);
	$items=($_POST['item']);



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

}



foreach ($_FILES["images"]["error"] as $key => $error) {
  if ($error == UPLOAD_ERR_OK) {
    $name = $_FILES["images"]["name"][$key];
    move_uploaded_file( $_FILES["images"]["tmp_name"][$key], "uploads/" . $_FILES['images']['name'][$key]);
  }
}


//////////////////////////////////////////////////////


// $usernameorder="t";
// $order="t";
// $items="t";
// $image="t";


// Create connection
$conn = new mysqli($server, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// prepare and bind
$stmt = $conn->prepare("INSERT INTO orders (user, ordername, items, image) VALUES (?, ?, ?, ?)");
$stmt->bind_param("ssss", $usernameorder, $order, $comma_separated, $image);


$stmt->execute();


echo "New records created successfully";

$stmt->close();
$conn->close();

   ///////////////////////////////////


// $con = mysql_connect($server, $username, $password) or die ("Could not connect: " . mysql_error());
// mysql_select_db($database, $con);


// 	$con = mysql_connect($server, $username, $password) or die ("Could not connect: " . mysql_error());
// 	mysql_select_db($database, $con);
//          $sql = "INSERT INTO orders (user, ordername, items, image) VALUES('$usernameorder', '$order', '$comma_separated', '$image')";
// 		 //echo $sql;
//          $result = mysql_query($sql) or die ("Query error: " . mysql_error());
//          echo $result;

// mysql_close($con);




?>