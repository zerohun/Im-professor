<?php
ob_start();
require_once ('upper.php');
require_once ('config.php');

	if ($loggedin) 
	{
		header("Location: index.php?message=".
			urlencode("Error: 이미 로그인되어 있는 상태입니다."));	
		die();
	}

	// GET 메소드인 경우 Form을 통하여 Submit된 Data처리
	if ($_SERVER['REQUEST_METHOD'] == 'GET')
	{
		$email = $password = ""; // 초기화

		//FORM 값을 읽는다.
		if (isset($_GET['email'])) $email = escape_str($_GET['email']);
		if (isset($_GET['password'])) $password = escape_str($_GET['password']);
		
		if ($email.value != "" && $password.value != "") {
			// SELECT문 실행
			$query = "SELECT email FROM users WHERE email='$email' and password='$password'";
			$result = mysql_query($query);
			if (!mysql_fetch_array($result)) {
			} else {
				// SELECT 성공
				?>
					<script type = "text/javascript"> alert ( "로그인 되었습니다." ); </script>
				<?php
				$_SESSION['user'] = $_GET['email'];
        header('Location: mypage.php');
//				echo '<meta http-equiv = "Refresh" content = "0 ; url = mypage.php">';
			}
		}
	}
	
	if ($_SERVER['REQUEST_METHOD'] == 'POST')
	{
		$email = $password = $msg = ""; // 초기화

		//FORM 값을 읽는다.
		if (isset($_POST['email'])) $email = escape_str($_POST['email']);
		if (isset($_POST['password'])) $password = escape_str($_POST['password']);
		
		if (isset($_GET['email'])) $email = escape_str($_GET['email']);
		if (isset($_GET['password'])) $password = escape_str($_GET['password']);
		
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
        echo "	<script type = 'text/javascript'> alert ( '로그인 되었습니다.' ); </script>";
        echo '<meta http-equiv = "Refresh" content = "0 ; url = mypage.php">';
      }
      else{
        echo "	<script type = 'text/javascript'> alert ( 'ID 혹은 비밀번호가 올바르지 않습니다.' ); </script>";
      }

      


		}
	}
	// post된 것이 없으면 Form을 출력함.
?>

	<form action="login.php" method="post">
		<table id="login" width="25%" border = "solid">
			<div class="login"> 
				<?php //print_message(); ?>
				<tr>
					<td> <span>Email(ID)</span> </td>
					<td> <input type="text" size="20" name="email"> </td>
				</tr>
				<tr>
					<td> <span>Password</span> </td>
					<td> <input type="password" size="20" name="password"> </td>
				</tr>
				<tr>
					<td colspan = "2" align = "center"> <input type="submit" value="Login" style="padding:5px 10px ; text-align:center ; "> </td>
				</tr>
			</div>
		</table>
	</form>
	<?php
		require_once ('beneath.php');
	?>
