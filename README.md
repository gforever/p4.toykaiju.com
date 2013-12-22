p4.toykaiju.com	
=====================

Project 4

My project 4 application is a simple todo list. I have created a new database toykaiju_p4 and added additional columns to the posts table. These columns include the priority, crossout, and ranking. Users have the ability to add or edit a task via Ajax and delete strictly through php. 
Each task contains a title(required) and a detail section (optional). Users have the ability to flag a task as urgent or crossing it off through a Javascript call which changes the color to red and/or adds a strikethrough line with css. 
Users also have the ability to sort their task with the jQuery sortable function. After the user finishes dragging a task, Ajax will then modify and save the order of the tasks to the MySQL database (currently working on).
I have edited the MySQL statements so that only the logged in user can only see his/her tasks. 




