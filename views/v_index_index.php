<?php if($user): ?>
  	<!-- This is used to print out the user array for debugging
    <pre>
     < ?php 
	  print_r($user);
	  ?>
    </pre> -->
    <p>Hello <?=$user->first_name; ?></p>
<?php else: ?>
  <h1> Welcome to Mi2Du</h1> <br /> 
  <img src="/imgs/mi2du.png" width="300" height="300" alt="Mi2DuLogo" /> <br />
  <p>Please sign up or log in for your to do list! <br />
  Features include: Add a Task (Ajax), Edit a task, Delete a task, Mark task urgent (JS). jQuery Tooltip, jQuery to sort tasks. </p>
<?php endif; ?>