
        //DELETE ORDER
       $( ".deleteitem" ).click(function() {
       


             console.log("Deleting item...");

             var userfromform = $(".usernameorder").val();
             console.log(userfromform);


             var deleteid = "deleteid=" + $(this).attr('id') + '&user=' + userfromform;
             console.log(deleteid);
             // console.log("The user is: " userfromform);

          $.ajax({
          	 // var deleteid = $(this).attr('id');
            //  console.log(deleteid);
            type: 'post',
            url: 'deleteorder.php',
            data: deleteid,
            success: function (html) {
              var $html = html;
              console.log(html); 
              console.log(deleteid);
              $( ".result_delete" ).empty();
              $( ".result_delete" ).append("<strong>Order Deleted</strong>");

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
							          //console.log(user);
							          table = table + "<tr><td>" + user +  "</td>" +  "<td>" +  order +  "</td>" +  "<td>" +  items +  "</td>" + "<td><div class='view'><button type='button' class='btn btn-primary viewitem' id='" + id + readCookie("hashjaybus") +  "'>View</button></div></td>" +  "<td>" + "<div class='edit'><button type='button' class='btn btn-warning edititem' id='" + id + readCookie("hashjaybus") + "'>Edit</button></div>" +  "</td>" +  "<td>" + "<div class='delete'><button type='button' class='btn btn-danger deleteitem' id='" + id + readCookie("hashjaybus") + "'>Delete</button></div>" +  "</td></tr>";
							     }



							$.getScript( "tableoperations.js", function( data, textStatus, jqxhr ) {

								  console.log( "Load tableoperations was performed." );
								});





							$( ".table" ).show();
							$( ".table" ).append(table);
							$( ".neworder" ).show();
							$( ".form_neworder" ).hide();


              // clearing results display
      
              $( ".result_edit" ).empty();
              $( ".result" ).empty();
              $( ".result_creation" ).empty();

            			}
            		});


              },
            error:  function () {
              $( ".result_delete" ).empty();
              $( ".result_delete" ).append("<strong>That was an error</strong>");
            }
          });


       });





      ////////////////////////////////////////////////////////////////////////////////////////////////
      ////////////////////////////////////////////////////////////////////////////////////////////////
      ////////////////////////////////////////////////////////////////////////////////////////////////
      ////////////////////////////////////////////////////////////////////////////////////////////////
      ////////////////////////////////////////////////////////////////////////////////////////////////
      ////////////////////////////////////////////////////////////////////////////////////////////////
      ////////////////////////////////////////////////////////////////////////////////////////////////

      //EDIT ORDER
       $( ".edititem" ).click(function() {

             console.log("Editing item...");


             // cleaning any other items from the past
             $( ".singleitem" ).remove();

             var userfromform = $(".usernameorder").val();
             console.log(userfromform);


             var editid = "editid=" + $(this).attr('id');
             console.log(editid);



          $.ajax({
          	 // var deleteid = $(this).attr('id');
            //  console.log(deleteid);
            type: 'post',
            url: 'getordertoedit.php',
            data: editid,
            success: function (html) {
              var $html = html;
              console.log(html); 
              console.log(editid);
   

              // Create Form to edit order
              var obj = JSON.parse(html);
              var form = "<form enctype='multipart/form-data' class='editingorder' style='border:1px solid #ccc;padding:5px;';width:100px; padding: 10px 10px; margin:10px 10px;>";
              for(var i in obj)
                     {
                        var id = obj[i].id;
                        var order = obj[i].ordername;
                        //console.log(order);
                        var user = obj[i].user;
                        var items = obj[i].items;
                        console.log(order);
                        form = form + 'EDITING EXISTING ORDER:<br><input type="text" value="' +  readCookie("hashjaybus") + '" class="usernameorder" name="usernameorder"  required >' + '<input type="text" value="' + id + '" class="id" name="id" hidden required >' + 'Order:<br><input type="text" value="' + order + '" class="ordername" name="ordername" required ><br><div class="item">';
                        var array = items.split(',');

                        var arrayLength = array.length;
                        var items ="";
                        for (var i = 0; i < arrayLength; i++) {
                            items =  items + '<div class="singleitem">Item:<br><input type="text" value="' + array[i] + '" name="item[]" class="items" required > <span class="canceladditem glyphicon glyphicon-minus"></span></div>';
                            //Do something
                        }

                        form = form + items; 

                        form = form + '</div><div class="additemonedition" style="cursor: pointer"><p>Add an Item</p></div>' +'<br><input type="file" name="fileToUpload" id="fileToUpload"/><br><br><input name="submit" type="submit" value="Save Changes" class="btn btn-primary">  <button type="button" class="btn btn-warning cancelorderedition">Cancel Order Edit</button></form>';

                                
                   }
              console.log(form);
              $( ".formtoeditorders" ).empty();
              $( ".formtoeditorders" ).append(form);


              $.getScript( "editcreationhelper.js", function( data, textStatus, jqxhr ) {
  
                  console.log( "Load editcreationhelper was performed." );
              });

              $.getScript( "canceladditem.js", function( data, textStatus, jqxhr ) {

                  console.log( "Load canceladditem was performed." );
               });




              // clearing results display
              $( ".result_delete" ).empty();
          
              $( ".result" ).empty();
              $( ".result_creation" ).empty();
              
              },
            error:  function () {
              $( ".result_edit" ).empty();
              $( ".result_edit" ).append("<strong>That was an error getting the order to be edited</strong>");
            }
          });


       });



      ////////////////////////////////////////////////////////////////////////////////////////////////
      ////////////////////////////////////////////////////////////////////////////////////////////////
      ////////////////////////////////////////////////////////////////////////////////////////////////
      ////////////////////////////////////////////////////////////////////////////////////////////////
      ////////////////////////////////////////////////////////////////////////////////////////////////
      ////////////////////////////////////////////////////////////////////////////////////////////////
      ////////////////////////////////////////////////////////////////////////////////////////////////

      //VIEW Details Operation
       $( ".viewitem" ).click(function() {

             console.log("viewing details...");


             // cleaning any other items from the past
             $( ".singleitem" ).remove();

             var userfromform = $(".usernameorder").val();
             console.log(userfromform);


             var viewid = "editid=" + $(this).attr('id');
             console.log(viewid);



          $.ajax({
             // var deleteid = $(this).attr('id');
            //  console.log(deleteid);
            type: 'post',
            url: 'getordertoedit.php',
            data: viewid,
            success: function (html) {
              var $html = html;
              console.log(html); 
              console.log(viewid);
   

              // Create Form to edit order
              var obj = JSON.parse(html);
              console.log("OBJ: " + obj);
              var detail = "<div class='' style='margin:10px; padding:10px;float:left;positon:relative'><h1>Details on order</h1><br>";
              for(var i in obj)
                     {
                        var id = obj[i].id;
                        var order = obj[i].ordername;
                        //console.log(order);
                        var user = obj[i].user;
                        var items = obj[i].items;
                        var create = obj[i].timestamp;
                        var image = obj[i].image;
                        console.log("image: " + image);
                        console.log(order);
                        detail = detail + 'Order id: ' + id + "<br>Created by: " + user + '<br>Date: ' + create +'<br>Order Name: ' + order + "<br><ul>";
                        var array = items.split(',');

                        var arrayLength = array.length;
                        var items ="";
                        for (var i = 0; i < arrayLength; i++) {
                            items =  items + '<li>' + array[i] +  '</li>' ;
                            //Do something
                        }

                        detail = detail + items; 



                        if (image == ""){

                        detail = detail + '</ul></div><div style="float:left;position:relative;max-height:200px;max-width:200px;margin-top:30px;margin-left: 80px;"></div>';

                        }
                        else{

                        detail = detail + '</ul></div><div style="float:left;position:relative;max-height:200px;max-width:200px;margin-top:40px;margin-left: 80px;"><img style="float:left;position:relative;max-height:200px;max-width:200px;" src="uploads/' + image + '"></img></div>';


                        }

                                
                   }
              console.log(detail);
              $( ".modal-content" ).empty();
              $( ".modal-content" ).append(detail);
              $('#myModal').modal('show');
          

              // clearing results display
              $( ".result_delete" ).empty();
              $( ".result_edit" ).empty();
              $( ".result" ).empty();
              $( ".result_creation" ).empty();
              


              
              },
            error:  function () {
              console.log("Error");
            }
          });


       });


