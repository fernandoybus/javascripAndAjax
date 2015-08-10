<!DOCTYPE html>
<html>
<head>
		<meta charset="UTF-8">
		<title>Javascript Framework with AJAX: All CRUD operations available</title>


		<script src="//code.jquery.com/jquery-1.11.3.min.js"></script>
		<script src="//code.jquery.com/jquery-migrate-1.2.1.min.js"></script>

		<!-- Latest compiled and minified CSS -->
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">

		<!-- Optional theme -->
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap-theme.min.css">

		<!-- Latest compiled and minified JavaScript -->
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>



</head>

<body>


<?php
$target_dir = "uploads/";
$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);

echo $_FILES["fileToUpload"]["name"];
$uploadOk = 1;
$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
// Check if image file is a actual image or fake image
if(isset($_POST["submit"])) {
    $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
    if($check !== false) {
        echo "File is an image - " . $check["mime"] . ".";
        $uploadOk = 1;
    } else {
        echo "File is not an image.";
        $uploadOk = 0;
    }
}
// Check if file already exists
if (file_exists($target_file)) {
    echo "Sorry, file already exists.";
    $uploadOk = 0;
}
// Check file size
if ($_FILES["fileToUpload"]["size"] > 500000) {
    echo "Sorry, your file is too large.";
    $uploadOk = 0;
}
// Allow certain file formats
if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
&& $imageFileType != "gif" ) {
    echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
    $uploadOk = 0;
}
// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
    echo "Sorry, your file was not uploaded.";
// if everything is ok, try to upload file
} else {
    if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
        echo "The file ". basename( $_FILES["fileToUpload"]["name"]). " has been uploaded.";
    } else {
        echo "Sorry, there was an error uploading your file.";
    }
}
?>




		<!-- CREATE FORM-->

		<form class="form_neworder" action="fileupload.php" method="post" enctype="multipart/form-data">
			CREATE NEW ORDER:
			<br>
			<input type="text" name="usernameorder" class="usernameorder" value="fernandoybus" hidden required >
			Order:<br>
			<input type="text" name="order" class="order" required value=""><br>
			Item:<br>
			<div class="item">
				<input type="text" name="item[]" class="item" required>
		    </div>
		    <br>
			<input type="file" name="fileToUpload" id="fileToUpload">
			<input name="submit" type="submit" value="Save new Order" class="btn btn-primary">
			<button type='button' class='btn btn-warning cancelordercreation'>Cancel Order Creation</button>
		</form>

</body>

<script>
     //WRITE NEW ORDER
       $('.form_neworder').on('submit', function (e) {

       	    console.log("saving new order....");
        	console.log($('.form_neworder').serialize());

             //e.preventDefault();

        });

</script>
</html>