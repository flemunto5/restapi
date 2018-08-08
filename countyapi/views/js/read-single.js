	$(document).ready(function(){
 
    // handle 'read one' button click
    $(document).on('click', '.read-one-county-button', function(){
        
        // county ID 
        var id = $(this).attr('data-id');

        $.getJSON("../api/county/read_single.php?id=" + id, function(json){
        $("div.edit-form").empty();
        $("#add-county").addClass("d-none");
        
	   
	   $("div.edit-form").append("<div id=\"edit-county\" class=\"card\"><div class=\"card-header  bg-secondary text-white\">Edit County</div><div class=\"card-body\"><form id='update-county-form' action='#' method='post'><input value=\"" + json.id + "\" name='id' type='hidden' /><div class=\"form-group\"><input type=\"text\" class=\"form-control\" id=\"countyName\" name=\"countyName\" placeholder=\"Enter county name\" value=\""+json.countyName+"\" required></div><button type=\"submit\"  class=\"btn btn-success\" style=\"width: 28%;margin-right: 10px;\" >UPDATE COUNTY</button><a href=\"\" style=\"width: 28%;\" class=\"btn btn-primary\">CANCEL</a></div></div>");
	   });
        

    });
 
});	