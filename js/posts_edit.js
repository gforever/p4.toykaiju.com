// JavaScript Document

// Set up the options for ajax
var postID = $("#edit-post").data("post_id");
var options = { 
    type: 'POST',
    url: '/posts/p_edit/'+ postID,
    beforeSubmit: function() {
        $('#results').html("Editing...");
    },
    success: function(response) {   
		$('#results').html(response);
    } 
}; 

// Using the above options, ajax'ify the form
$('form').ajaxForm(options);