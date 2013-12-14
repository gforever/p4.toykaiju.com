<?php 
	//form which we will use to upload the image
    include("connect.php");
	$_SESSION['username']="alex";
	
	$username = $_SESSION['username'];
	if ($_POST['submit']) {
	//get file attributes
	$name =$_FILES['myfile']['name'];
	//$size = $_FILES['myfile']['size'];	
	$tmp_name = $_FILES['myfile']['tmp_name'];
	
	if ($name)
	{
		//echo "...";	
		//start upload process
		$location = "avatars/$name";
		move_uploaded_file($tmp_name,"avatars/".$name,$location);
		$query = mysql_query("UPDATE users SET imagelocation='$location' WHERE username='$username'");
	}
	else
	die("Please select a file.");
	}
	
	echo "Welcome, ".$username."!<p>";
	
	echo "Upload your image: 
	<form action='upload.php' method='POST' enctype='multipart/form-data'>
	File:<input type='file' name='myfile'><input type='submit' name='submit' value='Upload!'>
	</form>
	
	";
?>