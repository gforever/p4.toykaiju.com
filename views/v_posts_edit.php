<form method='post' action='/posts/p_edit/<?=$post['post_id']?>'>
    <textarea rows="1" cols="80" name='task' title="Edit Task Title" required><?=$post['task']?></textarea><br />
    <textarea rows="5" cols="100" name='content' title="Edit Task Detail"><?=$post['content']?></textarea> 

    <?php if($post['priority'] == 'urgent')
		    echo "Urgent <input type='checkbox' name='priority' value='urgent' title='Edit Priority' checked>"; 
    ?> 
    <?php if($post['priority'] != 'urgent')
		    echo "Mark Urgent? <input type='checkbox' name='priority' value='urgent' title='Edit Priority'>";
    ?> 

    <input type='Submit' value='Edit Task' required>
</form>