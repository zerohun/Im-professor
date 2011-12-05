<?php
require_once ('upper.php');
?>
<?php  
  	if(!isset($_SESSION['user_id'])){
        echo "<script type = 'text/javascript'> alert ( '관리자만 이용 가능한 페이지 입니다.' ); ";
        echo "location.replace('login.php');</script>";
    } else {	
		$query = "SELECT email FROM users WHERE id='$current_user'";
		$result = mysql_query($query);
		$row = mysql_fetch_array($result);
		if ( $row[0] != $db_admin ) {
			echo "<script type = 'text/javascript'> alert ( '어딜 감히 오시나요...' ); ";
			echo "alert ( '잘가.' ); ";
			echo "location.replace('index.php');</script>";
		}
	}
?>
<div id="form_wraaper">
	<h1>관리자 페이지 입니다.</h1>
	<div id="select">
		<p><a href="univ_create.php">학교 생성</a></p>
		<p><a href="major_create.php">학과 생성</a></p>
		<p><a href="prof_create.php">교수 생성</a></p>
		<p><a href="user_del.php">데이터 삭제</a></p>
	</div>
</div>
<?php
  require_once "beneath.php";
?>
