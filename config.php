<?php
$db_hostname = 'localhost';
$db_database = 'wpc32';
$db_username = 'wpc32';
$db_password = 'jy4726';

$db_con = mysql_connect($db_hostname, $db_username, $db_password);
if (!$db_con) die("Unable to connect to MySQL: " . mysql_error());

mysql_select_db($db_database, $db_con) or die("Unable to select database: " . mysql_error());
mysql_query("SET NAMES 'utf8'");

?>
