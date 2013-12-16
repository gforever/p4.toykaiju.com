//Calls the jQuery tooltip function
$( document ).tooltip();

$('#kName').keyup(function(){
	//Find out what is in this field
	var value = $(this).val();
	
	var how_many_characters = value.length;
	//console.log(how_many_characters);

	var how_many_left = 20 - how_many_characters;
	
	if(how_many_left == 0){
		$('#kName-error').css('color','red');
	}	
	else if(how_many_left < 5) {
		$('#kName-error').css('color','purple');
	}
	
	$('#kName-error').html('You have ' + how_many_left + ' characters left.');
	/*
    if(how_many_characters == 14) {
		$('#recipient-error').html('You\'ve reached the max amount of characters');
	}
	else {
		$('#recipient-error').html('');
	} */
	
	//Place the Kaiju Name in the canvas
	$('#kName-output').html(value);
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

/*-------------------------------------------------------------------------------------------------
Bonus! Ability to drag over (rather than click-to-add) new stickers
revert: invalid will send the sticker back to it's original position, if it's not dropped in the canvas
-------------------------------------------------------------------------------------------------
$('.stickers').draggable(
	{ revert: "invalid" }
);

$( "#canvas" ).droppable(
	{ accept: '.stickers'},
	{ drop: function( event, ui ) {
		ui.draggable.draggable({containment:'#canvas'})
	}}
);

*/
	
/*------------------------------------------------------------------------------------------
Start over
------------------------------------------------------------------------------------------*/
$('#refresh-btn').click(function() {
	
	// Reset color and texture
	$('#canvas').css('background-color', 'white');
	$('#canvas').css('background-image', '');

	// Clear Kaiju Name divs
	$('#kName-output').html("");
	//$('#recipient-output').html("");
		
	// Remove any stickers (Kaiju Part)
	$('.stickers_on_canvas').remove();
});


/*------------------------------------------------------------------------------------------
Print
------------------------------------------------------------------------------------------*/
$('#print-btn').click(function() {
	
	// Goal: Open the card in a new tab
    //Remove trash bin icon from printing
    $('#can').addClass('hideDiv');

    // Take the existing card on the page (in the #canvas div) and clone it for the new tab
    var canvas_clone = $('#canvas').clone();
        
    /* 
    Next, we need to get the HTML code of the card element
    We can't just say canvas.html() because that will get us the stuff *inside* the #canvas:
    
    	<div id="message-output"></div>
		<div id="recipient-output"></div>
		
	Think of a turkey sandwich. The above gets us just the inside of the sandwich, the turkey... But we need the bread too.
		
    I.e., this is what we want:
    
   		<div id="canvas" style="background-image: url(images/texture-cloth.png);">
			<div id="message-output"></div>
			<div id="recipient-output"></div>
		</div> 
    
    To accomplish this we'll use a new method .prop (short for property) and request the "outerHTML" property of the canvas.
    In JavaScript land, "outerHTML" is both the bread and the meat of an element. 
    (Don't let it confuse you, the name outerHTML sounds kinda like it would just be the bread...it's not...it's the whole sammie).
    */
    var canvas = canvas_clone.prop('outerHTML'); // Give us the whole canvas, i.e the bread and the meat, i.e the complete card from our clone
    	    
    // Now that we have the entire canvas let's focus on creating our new tab
    
    // For the new tab, we need to basically construct all the pieces we need for any HTML page starting with a start <html> tag.
    var new_tab_contents  = '<html>';
    
    // (Note the += symbol is used to add content onto an existing variable, so basically we're just adding onto our new_tab_contents variable one line at a time)
	
    new_tab_contents += '<head>';
    new_tab_contents += '<link rel="stylesheet" href="css/main.css" type="text/css">'; // Don't forget your CSS so the card looks good in the new tab!
    new_tab_contents += '<link rel="stylesheet" href="css/features.css" type="text/css">';
    new_tab_contents += '</head>';
    new_tab_contents += '<body>'; 
    new_tab_contents += canvas; // Here's where we add the card to our HTML for the new tab
    new_tab_contents += '</body></html>';
    
	// Ok, our card is ready to go, we just need to work on opening the tab
    
    // Here's how we tell JavaScript to create a new tab (tabs are controlled by the "window" object).
    var new_tab =  window.open();

	// Now within that tab, we want to open access to the document so we can make changes
    new_tab.document.open();
    
    // Here's the change we'll make: we'll write our card (i.e., new_tab_contents) to the document of the tab
    new_tab.document.write(new_tab_contents);

	//NEED TO ADD THE TRASH BIN BACK TO THE APP///////////////////////////////////////////////////////////////
    $('#can').removeClass('hideDiv');    
	//$('.stickers_on_canvas').css('cursor', 'move');
    // Then close the tab. This isn't actually closing the tab, it's just closing JS's ability to talk to it.
    // It's kind of like when you're talking to a walkie-talkie and you say "over and out" to communicate you're done talking
    new_tab.document.close();


});


