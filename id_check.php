<?php
require_once ('config.php');
require_once ('common.php');
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" 
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
  <head>
	<title>id ¿¿¿¿</title>
	<meta http-equiv="content-type" content="text/html; charset=utf-8" />
  <script src="http://code.jquery.com/jquery-1.7.min.js" type="text/javascript"> </script>
  <script src="id_check.js" type="text/javascript"> </script>
  </head>

  <body>


<?php>
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
    echo 'enable_join();';
		echo '</script>';
	} else {
		echo '<script type = "text/javascript">';
    echo 'duplicated();';
		echo '</script>';
	}
?>
</body>
</html>

