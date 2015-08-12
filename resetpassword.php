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

<div class="container">
<?php

include 'credentials.php';



$email="";
$token="";


if($_GET['email'])
{
	$email=$_GET['email'];
	$token=$_GET['token'];

}

//echo $email;
//echo "<br>";
//echo $token;


$con = mysql_connect($server, $username, $password) or die ("Could not connect: " . mysql_error());
mysql_select_db($database, $con);


	$con = mysql_connect($server, $username, $password) or die ("Could not connect: " . mysql_error());
	mysql_select_db($database, $con);

         $found =0;
         $sql = "SELECT username FROM users where email LIKE '" .  $email . "' AND retrievepassword= '" . $token . "'";
         $result = mysql_query($sql) or die ("Query error: " . mysql_error());

         while($row = mysql_fetch_array($result)) {          
     
            $found = $row[0];

    
         }


          

          if ($found === 0){
            echo '{"response":"0", "msg": "' .  "looks like the link has expired, do another password reset...... (OR you may be trying to break into my system....)" . '"}';
         }

         if ($found != "0"){



	    $sql = "UPDATE users SET retrievepassword='1' WHERE email='$email'";

            $result = mysql_query($sql) or die ("Query error: " . mysql_error());



         	?>
         	<h1>Looks like you are ready to change your password</h1>

			<form class="resetpasswordform" enctype="multipart/form-data" method="post">
				<input type="email" name="emailrecover" class="emailrecover" required hidden value="<?php echo $email ?>"><br><br>
				New Password:<br>
				<input type="password" name="passwordnew" class="passwordnew" required value=""><br><br>
				<input name="submit" type="submit" value="Recover Password" class="btn btn-primary">
			</form>

			<script>

			      //Reset new password//////////////////////////////////////////////////////////////////////////////////////
			       $('.resetpasswordform').on('submit', function (e) {

			       	    console.log("changing password....");
			        	console.log($(new FormData(this)));


			             e.preventDefault();

			          $.ajax({
			            type: 'post',
			            url: 'changepassword.php',
			            data: new FormData(this),
			            contentType: false,
						cache: false,
						processData:false,
            			success: function (html) {
                                   console.log(html);
            	
            			   if (html == '1'){
                                             console.log("appending ok message");
                                             $( "h1" ).empty();
			                     $( "h1" ).append("   ...Ok, password was reset.");			              
			          		}
			          		else{
                                                         $( "h1" ).empty();
			          			 $( "h1" ).append(" ....hummmm, something went wrong... or you are trying to bypass my security....");	

			          		}

						},
			            error:  function () {
                                       $( "h1" ).empty();
			               $( "h1" ).append("hummmm, something went wrong... or you are trying to bypass my security....");		
			            }
			          });

			       });

			</script>

         	<?php


                mysql_close($con);
          }






?>
</div>
</body>
</html>