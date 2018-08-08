<!DOCTYPE html>
<html>
<head>
	<title>REST API IN PHP</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
  <link rel="stylesheet" type="text/css" href="style.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
  <script src="js/bootbox.min.js"></script>
  <script src="app.js"></script>
  <script src="js/create-county.js"></script>
  <script src="js/read-single.js"></script>
  <script src="js/update-county.js"></script>
  <script type="text/javascript">
		 
	$(document).ready(function(){
 
    // will run if the delete button was clicked
    $(document).on('click', '.delete-county-button', function(){
        // get the county id
        var county_id = $(this).attr('data-id');
		// bootbox for good looking 'confirm pop up'
		bootbox.confirm({
		 
		    message: "<h4>Are you sure?</h4>",
		    buttons: {
		        confirm: {
		            label: '<span class="glyphicon glyphicon-ok"></span> Yes',
		            className: 'btn-danger'
		        },
		        cancel: {
		            label: '<span class="glyphicon glyphicon-remove"></span> No',
		            className: 'btn-primary'
		        }
		    },
		    callback: function (result) {
		         // send delete request to api / remote server
			        $.ajax({
			        url: "../api/county/delete.php",
			        type : "POST",
			        dataType : 'json',
			        data : JSON.stringify({id:county_id}),
			        success : function(result) {
			 
			                // county was deleted
						    display_counties();
						    $("#result").empty();
						    $('#result').fadeIn(5000);
							$('#result').append("<div class=\"alert alert-dark\">County deleted successfully</div>");
							$('#result').fadeOut(5000);
			        },
			        error: function(xhr, resp, text) {
			            console.log(xhr, resp, text);
			        }
			    });
		    }
		});
       
    });
});

  </script>
</head>
<body>
<div class="jumbotron text-center">
  <h1>REST API IN PHP</h1>
  <h3>Kenya County Listings</h3>
</div>
	<div class="container">
		
	<div class="row">
		<div class="col-lg-12">
			<div id="result"></div>
			<div class="edit-form"></div>
			<div id="add-county" class="card">
            <div class="card-header  bg-secondary text-white">Add County</div>
            <div class="card-body">
			<form id="create-county-form" method="POST" action="#">
				<div class="form-group">
				<input type="text" class="form-control" id="countyName" name="countyName" placeholder="Enter county name" required>
		        </div>
				<button type="submit"  class="btn btn-success" style="width: 100%;" >ADD COUNTY</button>
			</form>
			</div>
		    </div>
			<br>
			<table class="table table-dark table-striped table-hover">
				<thead>
					<tr>
						<th>County Name</th>
						<th>Action</th>
					</tr>
				</thead>

				<tbody class="county-list"></tbody>
			</table>
		</div>
	</div>

	</div>
<script type="text/javascript">

	//call function
	$(document).ready(function() {
	     display_counties();    
	      
	});

    function display_counties(){
       $.getJSON('../api/county/read.php', function(json) {
       $("tbody.county-list").empty();
        
	   $.each(json.data, function(){
	   $("tbody.county-list").append("<tr><td>"+this['countyName']+"</td><td><button type=\"button\" class=\"btn btn-outline-success btn-sm read-one-county-button\" style=\"min-width: 63px;\" data-id=\""+this['id']+"\">EDIT</button> <button type=\"button\" class=\"btn btn-outline-danger btn-sm delete-county-button\" data-id=\""+this['id']+"\">DELETE</button></td></tr>");
	   });

    });

} 
 
</script>
</body>
</html>