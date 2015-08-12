<?php

include 'credentials.php';



$email="";
$token="";


if($_POST)
{
	$email=$_POST['email'];
	$token=$_POST['token'];

}





$con = mysql_connect($server, $username, $password) or die ("Could not connect: " . mysql_error());
mysql_select_db($database, $con);


	$con = mysql_connect($server, $username, $password) or die ("Could not connect: " . mysql_error());
	mysql_select_db($database, $con);

         $found =0;
         $sql = "SELECT username FROM users where email LIKE '" .  $emails . "' AND retrievepassword= '" . $token . "'";
         $result = mysql_query($sql) or die ("Query error: " . mysql_error());

         while($row = mysql_fetch_array($result)) {          
     
            $found = $row[0];
            //echo $found;
    
         }

         mysql_close($con);

          if ($found == 0){
            echo '{"response":"0", "msg": "' .  "error" . '"}';
         }

         if ($found != ""){



	 	 	$sql = "UPDATE users SET retrievepassword='1', WHERE email='$email'";

            $result = mysql_query($sql) or die ("Query error: " . mysql_error());



         	?>
         	<h1>Looks like you are ready to change your password</h1>

			<form class="resetpasswordform" style="display:none;" enctype="multipart/form-data" method="post">
				<input type="email" name="emailrecover" class="emailrecover" required hiddenvalue=" <?php echo $email ?>"><br><br>
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
            			   var obj = JSON.parse(html);
            			   var msg = obj[0].msg;

            			   if (msg == '1'){
			                     $( ".h1" ).append("Ok, password was reset.");			              
			          		}
			          		else{

			          			 $( ".h1" ).append("hummmm, something went wrong... or you are trying to bypass my security....");	

			          		}

						},
			            error:  function () {
			               $( ".h1" ).append("hummmm, something went wrong... or you are trying to bypass my security....");		
			            }
			          });

			       });

			</script>

         	<?php

          }






?>
