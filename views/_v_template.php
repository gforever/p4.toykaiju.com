<!DOCTYPE html>
<html>
<head>
	<title><?php if(isset($title)) echo $title; ?></title>

	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />	
					
	<!-- JS/CSS File we want on every page -->
	<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
	<!--<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.10.3/jquery-ui.min-.js"></script>-->
    <script src="http://code.jquery.com/jquery-1.9.1.js"></script>
    <script src="http://code.jquery.com/ui/1.10.3/jquery-ui.js"></script>  
	<script type="text/javascript" src="/js/mi2du.js"></script>										
	<!-- Controller Specific JS/CSS -->
	<link rel="stylesheet" href="/css/mi2du.css" type="text/css">  
    <!--<link rel="stylesheet" href="http://code.jquery.com/ui/1.10.3/themes/smoothness/jquery-ui.css">-->
  	<!--using local copy of jquery-ui to modify tooltip style-->
    <link rel="stylesheet" href="/css/jquery-ui.css" type="text/css">  
    
	<?php if(isset($client_files_head)) echo $client_files_head; ?>
		
</head>

<body>	
	 
	<div class="navigation">
		<nav>
			<menu> 
			<?php if($user): ?>
             <ul class="menu">
				<li class="menu"><a href='/posts/add'>New Task</a></li> 
				<li class="menu"><a href='/posts/'>View Tasks</a></li>
		   <!-- <li class="menu"><a href='/posts/users'>Follow(Will Disable)</a></li> -->
                <li class="menu"><a href='/users/logout'>Logout</a></li>
             </ul>
			<?php else: ?>
            <ul class="menu">
				<li class="menu"><a href='/users/signup'>Sign up</a></li>
				<li class="menu"><a href='/users/login'>Log in</a></li>         
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