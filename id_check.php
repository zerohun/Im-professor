﻿<?php
require_once ('config.php');

	$email_check = "";
	if (isset($_POST['email'])) $email_check = escape_str($_POST['email']);
	/*
	echo '<script type = "text/javascript">';
	echo 'var get_email = opener.parent.document.getElementById("email");';
	echo 'alert ( get_email.value );';
	echo '</script>';
	*/
	
	$query_email = "SELECT email FROM users WHERE email='$email_check'";
	$result_email = mysql_query($query_email);
	if (!mysql_fetch_array($result_email)) {
		echo '<script type = "text/javascript">';
		echo 'alert ( "사용해도 좋아요~" );';
		echo 'window.close ();';
		echo '</script>';
	} else {
		echo '<script type = "text/javascript">';
		echo 'alert ( "사용하면 안되요~" );';
		echo 'window.close ();';
		echo '</script>';
	}	
?>