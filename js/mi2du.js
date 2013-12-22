//Calls the jQuery tooltip function
$( document ).tooltip();

/*$(function() {
    $( "#sortable" ).sortable();
    $( "#sortable" ).disableSelection();
});*/

$(document).ready(function() {
	$("#sortable").sortable({
		handle : '.handle',
		update : function () {
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
		$('#pError').css('color','red');
	}	
	else if(how_many_left < 5) {
		$('#pError').css('color','purple');
	}
	
	$('#pError').html('You have ' + how_many_left + ' characters left.');

	//Place the User Name on the page
	$('#pass-output').html(value);
});

