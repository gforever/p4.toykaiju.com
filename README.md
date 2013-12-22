p4.toykaiju.com	
=====================

Project 4

My project 4 application is a simple to do list. I have created a new database toykaiju_p4 and added additional columns to the posts table. These columns include the priority, crossout, and ranking. Users have the ability to add or edit a task via Ajax and delete a task with php. 
Each task contains a title(required) and a detail section (optional). Users have the ability to flag a task as urgent. When editing, the user can mark the task urgent and or cross it off. These 2 items send a Javascript call which changes the color to red and/or adds a strikethrough line with css. 
Users also have the ability to re-arrange their tasks with the jQuery sortable function. After the user finishes dragging a task, Ajax will then save the rank order of the tasks to the MySQL database.
I have also edited the MySQL statements so that only the logged in user can only see his/her tasks. 


Features include: 
Add a Task (Ajax)
Edit a task (Ajax)
Delete a task
Mark task urgent(JS)
Cross off task (JS)
Sort Tasks (jQuery, Ajax)
jQuery Tooltip.




