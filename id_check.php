<?php
require_once ('config.php');
require_once ('common.php');

	$email_check = "";
	if ( isset ($_GET['email'])) $email_check = escape_str($_GET['email']);
	
/*	echo '<script type = "text/javascript">';
	echo 'var get_email = opener.parent.document.getElementById("email");';
	echo 'alert ( get_email.value );';
	echo '</script>';
*/	

	$query_email = "SELECT email FROM users WHERE email='$email_check'";
	$result_email = mysql_query($query_email);
	if (!mysql_fetch_array($result_email)) {
		echo '<script type = "text/javascript">';
		echo 'alert ( "����ص� ���ƿ�~" );';
		echo 'opener.document.getElementById("email").readOnly = "true";';
		echo 'opener.document.getElementById("submitbutton").type = "submit";';
		echo 'opener.document.getElementById("submitbutton").onclick = "";';
		echo 'window.close ();';
		echo '</script>';
	} else {
		echo '<script type = "text/javascript">';
		echo 'alert ( "�̹� ���Ե� �̸��� �ּ��Դϴ�." );';
		echo 'opener.document.getElementById("email").value="";';	
		echo 'opener.document.getElementById("submitbutton").type = "button";';
		echo 'window.close ();';
		echo '</script>';
	}
?>
