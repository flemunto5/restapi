 //handle 'update county'
	$(document).on('submit', '#update-county-form', function(){
     
    var form_data=JSON.stringify($(this).serializeObject());
    $.ajax({
    url: "../api/county/update.php",
    type : "POST",
    contentType : 'application/json',
    data : form_data,
    success : function(result) {
                // county was created
			    display_counties();
                $("#result").empty();
			    $('#result').fadeIn(5000);
				$('#result').append("<div class=\"alert alert-dark\">County updated successfully</div>");
				$('#result').fadeOut(5000);
    },
    error: function(xhr, resp, text) {
        // show error to console
        console.log(xhr, resp, text);
    }
});
     
    return false;
});