<?php
if (isset ( $_SESSION['user_id'])) {
 $current_user = $_SESSION['user_id'];
 $loggedin = TRUE;
} 
else {
 $loggedin = FALSE;
}

function escape_str($str) 
{
 return mysql_real_escape_string($str);
}
?>
