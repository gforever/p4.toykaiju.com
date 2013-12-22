//Calls the jQuery tooltip function
$( document ).tooltip();

//Does the sortable and makes the handle icon draggable
$(document).ready(function() {
	$("#sortable").sortable({
		handle : '.handle',
		update : function () {
			//serialize the data
			var order = $('#sortable').sortable('serialize');
			$("#info").load("processsortable?"+order);
		}
	});
}); 

$('#password').keyup(function(){
	//Find out what is in this field
	var value = $(this).val();
	
	var how_many_characters = value.length;
	//console.log(how_many_characters);

	var how_many_left = 20 - how_many_characters;
	
	if(how_many_left == 0){
		$('#password-error').css('color','red');
	}	
	else if(how_many_left < 5) {
		$('#password-error').css('color','purple');
	}
	
	$('#password-error').html('You have ' + how_many_left + ' characters left.');

});

