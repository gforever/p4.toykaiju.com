<?php 

	//Connect to database
    //	http://www.youtube.com/watch?v=o-0bfleqE2g
	mysql_connect("localhost","root","") or die(mysql_error());
	mysql_select_db("p4_toykaiu_com") or die(mysql_error());
	
	$id = addslashes($_REQUEST('id'));
	
	$image = mysql_query("SELECT * FROM users WHERE id=$id");
	$image = mysql_fetch_assoc($image);
	$image = $image['image'];
	
	
	header("Content-type: image/jpeg");
	
	echo $image;
?>