<form method='POST' action='/posts/p_add/'>
	Task: <input type='text' name='task' title="Enter Task" required><br />  <!-- new -->
    Details: <textarea rows="3" cols="30" name='content' title="Enter Task Detail"></textarea><br />
    <input type="checkbox" name="priority" value="urgent" title="Marks your task as urgent">Urgent     
    <input type='Submit' value = 'Add Task'>
</form> 


<!-- Ajax results will go here -->
<div id='results'></div>
   




