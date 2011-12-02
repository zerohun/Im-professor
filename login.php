<?php
require_once ('upper.php');
require_once ('config.php');

	if(isset($_SESSION['user_id'])){
        echo "<script type = 'text/javascript'> alert ( '이미 로긴 했어...' ); ";
        echo "location.replace('index.php');</script>";
    }

	// GET 메소드인 경우 Submit된 Data처리	
	if ($_SERVER['REQUEST_METHOD'] == 'GET')
	{
		$email = $password = ""; // 초기화

		if (isset($_GET['email'])) $email = escape_str($_GET['email']);
		if (isset($_GET['password'])) $password = escape_str($_GET['password']);
	
		if ($email != "" && $password != "") {
			// SELECT문 실행
			$query = "SELECT id FROM users WHERE email='$email' and password='$password'";
			$result = mysql_query($query);
			while ($row = mysql_fetch_array($result)) {
				$_SESSION['user_id'] = $row['id'];
			} 
				// SELECT 성공
		if(isset($_SESSION['user_id'])){
			echo "<script type = 'text/javascript'> alert ( '로그인 되었습니다.' ); ";
			echo "location.replace('mypage.php');</script>";
		}else{
			echo "<script type = 'text/javascript'> alert ( 'ID 혹은 비밀번호가 올바르지 않습니다.' ); </script>";
		}


		}
	}
	
	// POST 메소드인 경우 Form을 통하여 Submit된 Data처리
	if ($_SERVER['REQUEST_METHOD'] == 'POST')
	{
		$email = $password = $msg = ""; // 초기화

		//FORM 값을 읽는다.
		if (isset($_POST['email'])) $email = escape_str($_POST['email']);
		if (isset($_POST['password'])) $password = escape_str($_POST['password']);
		
		if ( $email == $db_admin ) {
			echo "<script type = 'text/javascript'> alert ( '어서오십시오 관리자님.' ); ";
			echo "location.replace('admin.php');</script>";
		}
		
		if ($email == "") {
			?>
				<script type = "text/javascript"> alert ( "Email을 입력하세요." ); </script>
			<?php
			$msg = "Email을 입력하세요.";
		}
			
		if ($password == "") {
			?>
				<script type = "text/javascript"> alert ( "암호를 입력하세요." ); </script>
			<?php
			$msg = "암호를 입력하세요.";
		}

		if ($msg == "") {
			// SELECT문 실행
			$query = "SELECT id FROM users WHERE email='$email' and password='$password'";
			$result = mysql_query($query);
			while ($row = mysql_fetch_array($result)) {
				$_SESSION['user_id'] = $row['id'];
			} 
				// SELECT 성공
			if(isset($_SESSION['user_id'])){
				echo "	<script type = 'text/javascript'> alert ( '로그인 되었습니다.' ); ";
				echo "location.replace('mypage.php');</script>";
			}else{
				echo "	<script type = 'text/javascript'> alert ( 'ID 혹은 비밀번호가 올바르지 않습니다.' ); </script>";
			}
		}
	}
	// post된 것이 없으면 Form을 출력함.
?>

	<form action="login.php" method="post">
	<div style="padding: 100px 0 0 250px;">
		<div id="login-box">
		<?php //print_message(); ?>
		<br />
		<br />
		<br />
		<br />
		<br />
		<br />
    <div id="login-box-name" style="margin-top:20px;">Email:</div>
      <div id="login-box-field" style="margin-top:20px;">
        <input name="email" class="form-login" title="Username" value="" size="30" maxlength="2048" />
      </div>
		  <div id="login-box-name">Password:</div>
        <div id="login-box-field">
          <input name="password" type="password" class="form-login" title="Password" value="" size="30" maxlength="2048" />
      </div>
		<br />
		<br />
		<input type="image" src="image/enter.png" width="103" height="42" style="margin-left:90px;" alt="submit button"/></input>
		</div>
	</div>
</form>
	<?php
		require_once ('beneath.php');
	?>
