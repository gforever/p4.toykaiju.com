<?php if($user): ?>
  	<!-- This is used to print out the user array for debugging
    <pre>
     < ?php 
	  print_r($user);
	  ?>
    </pre> -->
    Hello <?=$user->first_name; ?>
<?php else: ?>
  <h1> Welcome to Sqeaker</h1> <br /> 
  <img src="/imgs/sqeaker.jpg" width="300" height="203" alt="SqeakerLogo" /> <br />
  <p>Please sign up or log in and have fun posting your sqeaks! <br />
  +1 features include: Edit a Post and Delete a Post. </p>
<?php endif; ?>