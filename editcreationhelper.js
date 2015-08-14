		

		// ADD ITEM ON EDITION OF ORDER VIA JS
		$( ".additemonedition" ).click(function() {
		  $( ".item" ).append( '<div class="singleitem">Item:<br><input type="text" name="item[]"> <span class="canceladditem glyphicon glyphicon-minus"></span></div>');


		 $.getScript( "canceladditem.js", function( data, textStatus, jqxhr ) {

								  console.log( "Load canceladditem was performed." );
		  });
		});




    // CANCEL ORDER EDITION ////////////////////////////////////////////////////////
    $( ".cancelorderedition" ).click(function() {
      console.log("cancel order edition");
    $(".editingorder").empty();
      
      
    });


		//////////////////////////////////////////////////////////////////////////////////////////////////////////////
		//PREPARE SCRIPT to SAVE CHANGES ON ORDER THAT IS BEING ON EDITION
       $('.editingorder').on('submit', function (e) {


       		 console.log("Saving Changes on existing order....");
           e.preventDefault();


           var fu1 = document.getElementById("fileToUpload");
           console.log("You selected " + fu1.value);

             // clearing results display
            $( ".result_delete" ).empty();
        	  $( ".result_edit" ).empty();
			      $( ".result" ).empty();
			      $( ".result_creation" ).empty();

             console.log($('form').serialize());
             var userfromform = $(".usernameorder").val();
             //console.log(userfromform);
             var idfromform = $(".id").val();
             // console.log(idfromform);
             var orderfromform = $(".order").val();
             // console.log(orderfromform);
             var items = $(".items").val();
             console.log(items);



          $.ajax({
            type: 'post',
            url: 'savechanges.php',
            data: new FormData(this),
            contentType: false,
            cache: false,
            processData:false,
            success: function () {
              $( ".result_edit" ).empty();
              $( ".result_edit" ).append("<strong>Changes on Order Saved</strong>");
              // REDO TABLE TO VIEW RESULTS
                     $( ".table" ).empty();
                     $.ajax({
            			type: 'post',
            			url: 'table.php',
            			data: "username=" + userfromform,
            			success: function (html) {
            			   console.log(html);
            			   var obj = JSON.parse(html);
            			   var table = "<table class='table table-striped'><th>User</th><th>Order no</th><th>Items</th><th>View</th><th>Edit</th><th>Delete</th>";
            			   for(var i in obj)
							{
								 var id = obj[i].id;
							     var order = obj[i].ordername;
							     //console.log(order);
							     var user = obj[i].user;
							     var items = obj[i].items;
							     console.log(items);
							     table = table + "<tr><td>" + user +  "</td>" +  "<td>" +  order +  "</td>" +  "<td>" +  items  +  "</td><td><div class='view'><button type='button' class='btn btn-primary viewitem' id='" + id + readCookie("hashjaybus")  + "'>View</button></div></td>" +  "<td><div class='edit'><button type='button' class='btn btn-warning edititem' id='" + id  + readCookie("hashjaybus")  + "'>Edit</button></div>" +  "</td>" +  "<td>" + "<div class='delete'><button type='button' class='btn btn-danger deleteitem' id='" + id + readCookie("hashjaybus")  + "'>Delete</button></div>" +  "</td></tr>";
							}



							$.getScript( "tableoperations.js", function( data, textStatus, jqxhr ) {
	
								  console.log( "Load was performed." );
								});



							$( ".table" ).show();
							$( ".table" ).append(table);
							$( ".neworder" ).show();
							$( ".editingorder" ).empty();

            			}
            		});
          

			},
            error:  function () {
              $( ".result_creation" ).empty();
              $( ".result_creation" ).append("<strong>That was an error</strong>");
            }
          });

       });