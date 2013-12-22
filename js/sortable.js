//Sets up jQuery sortable
$(function() {
  $( "#sortable" ).sortable({
	  update: function(event, ui){
			var postData = $(this).sortable('serialize');  
			console.log(postData);
			
			$.post('c_save.php, {list: postData},function(o){
			 console.log(o);
			}, 'json');
	  }
  });
  $( "#sortable" ).disableSelection();
});