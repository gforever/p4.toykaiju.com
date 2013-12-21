<form method='post' action='/posts/p_edit/<?=$post['post_id']?>'>
<script>// Set up the options for ajax
	var options = { 
		type: 'POST',
		url: '/posts/p_edit/<?=$post['post_id']?>',
		beforeSubmit: function() {
			$('#results').html("Editing...");
		},
		success: function(response) {   
			$('#results').html(response);
		} 
	}; 
	
	// Using the above options, ajax'ify the form
	$('form').ajaxForm(options);
</script>

    <textarea rows="1" cols="80" name='task' title="Edit Task Title" required><?=$post['task']?></textarea><br />
    <textarea rows="5" cols="100" name='content' title="Edit Task Detail"><?=$post['content']?></textarea> 

    <?php if($post['priority'] == 'urgent')
		    echo "Urgent <input type='checkbox' name='priority' value='urgent' title='Edit Priority' checked>"; 
    ?> 
    <?php if($post['priority'] != 'urgent')
		    echo "Mark Urgent? <input type='checkbox' name='priority' value='urgent' title='Edit Priority'>";
    ?> 
    <?php if($post['crossout'] != '1')
		    echo "Cross off? <input type='checkbox' name='crossout' value='1' title='Cross off item '>";
		  else 
		    echo "Remove Crossout? <input type='checkbox' name='crossout' value='0' title='Cross off item '>";
    ?> 
    <input type='Submit' value='Edit Task' required>
</form>

<!-- Ajax results will go here -->
<div id='results'></div>