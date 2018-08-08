$(document).on('submit', '#create-county-form', function(){
		 
		    // get form data
			var form_data=JSON.stringify($(this).serializeObject());
			// submit form data to api
			$.ajax({
			    url: "../api/county/create.php",
			    type : "POST",
			    contentType : 'application/json',
			    data : form_data,
			    success : function(result) {
			        // county was created
			    display_counties();
			    $("#result").empty();
			    $('#result').fadeIn(5000);
				$('#result').append("<div class=\"alert alert-dark\">County added successfully</div>");
				$('#result').fadeOut(5000);
			    $("#countyName").val('');
			    },
			    error: function(xhr, resp, text) {
			        // show error to console
			        console.log(xhr, resp, text);
			    }
			});
			 
			return false;
					});	