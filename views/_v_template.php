<!DOCTYPE html>
<html>
<head>
	<title><?php if(isset($title)) echo $title; ?></title>

	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />	
					
	<!-- JS/CSS File we want on every page -->
	<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>				
	<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.10.3/jquery-ui.min.js"></script>
										
	<!-- Controller Specific JS/CSS -->
	<link rel="stylesheet" href="/css/mi2du.css" type="text/css">  
    <link rel="stylesheet" href="/js/mi2du.js" type="text/css">  
    <link rel="stylesheet" href="http://code.jquery.com/ui/1.10.3/themes/smoothness/jquery-ui.css">

    
	<?php if(isset($client_files_head)) echo $client_files_head; ?>
		
</head>

<body>	
	 
	<div class="navigation">
		<nav>
			<menu> 
            	<!--<img src="/imgs/th_mi2du.png" width="25" height="25" class="minilogo" alt="Mi2Du_mini_logo" /> -->
			<?php if($user): ?>
             <ul>
				<li><a href='/posts/add'>New Task</a></li> 
				<li><a href='/posts/'>View Task</a></li>
				<li><a href='/posts/users'>Follow(Will Disable)</a></li>
				<li><a href='/users/logout'>Logout</a></li>
             </ul>
			<?php else: ?>
            <ul>
				<li><a href='/users/signup'>Sign up</a></li>
				<li><a href='/users/login'>Log in</a></li>         
            </ul>
			<?php endif; ?>
			</menu>
		</nav>
    </div>
<?php if(isset($content)) echo $content; ?> 
<?php if(isset($client_files_body)) echo $client_files_body; ?> 

<p class="footnote">Mi2Du is an application project for CSCI E-15 at Harvard University Extension School. <br/>
Created by: Andrew Wong</p>
</body>
</html>