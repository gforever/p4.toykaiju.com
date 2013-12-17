//Calls the jQuery tooltip function
$( document ).tooltip();

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

$('.colors').click(function(){
	//console.log("You clicked one of the colors");
	var color_that_was_clicked = $(this).css('background-color');
	console.log(color_that_was_clicked);
	$('#canvas').css('background-color', color_that_was_clicked);
});

$('.textures').click(function(){
	var texture_that_was_clicked = $(this).css('background-image');
	console.log(texture_that_was_clicked);
	$('#canvas').css('background-image', texture_that_was_clicked);
	
});

$(function() {
    $( "#sortable" ).sortable();
    $( "#sortable" ).disableSelection();
  });

$('.stickers').click(function() {

	//var new_image = "<img src='"++"'></img>";
	//$('#canvas').html(new_image);

	// Clone whatever sticker was clicked
	var new_image = $(this).clone();

	//Creates the class and only allow the stickers on the right to be draggable 
	new_image.addClass('stickers_on_canvas'); 
	new_image.removeClass('kParts'); 
	
	// Place the clone in the canvas
	$('#canvas').append(new_image);

	$('.stickers_on_canvas').draggable().resizable();
  /*$('.stickers_on_canvas').draggable(/*{containment: "#canvas"}* /  ); DRAGGBLE WORKS BUT CANNOT DUE RESIZE*/

	//Allows item to be dropped when on top of trash can. 
    $('.trash').droppable({
		drop: function(event, ui){
			$(ui.draggable).remove()
			}  
	});
	
	/*TRYING TO HIGHLIGHT WHEN sticker over trash 	
	$('.trash').droppable({
		 activeClass: "ui-state-highlight" 
	});
	$('.trash').droppable( "option", "activeClass", "ui-state-highlight" );  */

}); 