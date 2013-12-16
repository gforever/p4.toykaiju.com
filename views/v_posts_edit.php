<form method='post' action='/posts/p_edit/<?=$post['post_id']?>'>
    <textarea rows="1" cols="10" name='task' title="Edit Task Title" required><?=$post['task']?></textarea><br />
    <textarea rows="5" cols="100" name='content' title="Edit Task Detail"><?=$post['content']?></textarea> 

    <?php if($post['priority'] == 'urgent')
		    echo "Urgent <input type='checkbox' name='priority' value='urgent' title='Edit Priority' checked>"; 
    ?> 
    <?php if($post['priority'] != 'urgent')
		    echo "Normal <input type='checkbox' name='priority' value='normal' title='Edit Priority' checked>";
    ?> 

    <input type='Submit' value='Edit Task' required>
</form>