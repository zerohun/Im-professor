<?php
require_once ('upper.php');

if ($loggedin) {
	?>
		<script type = "text/javascript"> alert ( "로그아웃 되었습니다." ); </script>
	<?php
	
	// 세션 데이터를 없애고
	$_SESSION = array();

	// 세션이 쿠키를 이용할 경우 쿠키도 없애고
	if (ini_get("session.use_cookies")) {
		$params = session_get_cookie_params();
		setcookie(session_name(), '', time() - 42000,
			$params["path"], $params["domain"],
			$params["secure"], $params["httponly"]
		);
	}

	// 마지막으로 세션 자체를 파괴
	session_destroy();
	
	
	// 다시 세션을 만듬.
	session_start();
}
	echo "<script type = 'text/javascript'> location.replace('index.php'); </script>";
?>
