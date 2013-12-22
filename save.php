<?php
    $list = $_POST['list'];
	$output = array();
	$list = parse_str($list, $output);
	print_r($output);
	
    echo $list;