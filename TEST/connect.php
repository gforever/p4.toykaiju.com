<?php 

	//Connect to database
    //	http://www.youtube.com/watch?v=o-0bfleqE2g
	//mysql_connect("localhost","root","") or die(mysql_error());
	//mysql_select_db("p4_toykaiu_com") or die(mysql_error());
	
	$error = "Unable to connect.";
	$connect = mysql_connect("localhost","root","") or die ($error);
	mysql_connect("p4_toykaiju_com") or die ($error);
	
	session_start();
?>