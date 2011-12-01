<?php
  require_once "upper.php";
  
  	if(!isset($_SESSION['user_id'])){
        echo "<script type = 'text/javascript'> alert ( '관리자만 이용 가능한 페이지 입니다.' ); ";
        echo "location.replace('login.php');</script>";
    } else {	
		$query = "SELECT email FROM users WHERE id='$current_user'";
		$result = mysql_query($query);
		$row = mysql_fetch_array($result);
		if ( $row[0] != "sedo@sedo.com" ) {
			echo "<script type = 'text/javascript'> alert ( '어딜 감히 오시나요...' ); ";
			echo "alert ( '잘가.' ); ";
			echo "location.replace('logout.php');</script>";
		}
	}
?>
<div id="form_wraaper">
	<p>관리자 페이지</p>
	<div id="select">
		<p><a href="univ_create.php">학교 입력하기</a></p>
		<p><a href="major_create.php">학과 입력하기</a></p>
		<p><a href="user_del.php">회원 삭제</a></p>
	</div>
</div>
<?php
  require_once "beneath.php";
?>
