<?php
require_once ('upper.php');
require_once ('config.php');
	
	if ($loggedin) 
	{
		header("Location: index.php?message=".
			urlencode("Error: 이미 로그인되어 있는 상태입니다."));		
		die();
	}
	
	// POST 메소드인 경우 Form을 통하여 Submit된 Data처리
	if ($_SERVER['REQUEST_METHOD'] == 'POST')
	{
		$name = $email = $password = $msg = ""; // 초기화

		//FORM 값을 읽는다.
		if (isset($_POST['email'])) $email = escape_str($_POST['email']);
		if (isset($_POST['password'])) $password = escape_str($_POST['password']);
		if (isset($_POST['name'])) $name = escape_str($_POST['name']);
		if (isset($_POST['age'])) $age = escape_str($_POST['age']);
		
		if ($email == "")
			$msg = "이메일을 입력하여 주세요.";
			
		if ($password == "")
			$msg = "비밀번호를 입력하여 주세요.";

		if ($name == "")
			$msg = "이름을 입력하여 주세요.";
			
		if ($msg == "") {
			// INSERT문 실행
			$query = "INSERT INTO users(email, password, name, age) " .
					"VALUES('$email', '$password', '$name', '$age')";
			if (!mysql_query($query)) {
				echo  "<div class='error'>INSERT failed: ".mysql_error()."</div>";
			} else {
				// INSERT 성공
				?>
					<script type = "text/javascript"> alert ( "회원가입 됐거든??" ); </script>
				<?php
				echo '<meta http-equiv = "Refresh" content = "0 ; url = http://localhost/index.php">';
			}
		}
	}

?>

<?php
	// 메시지가 있을 경우 메시지 출력
	if ($msg != "") 
		echo("<div class='message'>{$msg}</div>");
?>

<script type = "text/javascript">
	function form_id_check () {
		var form = document . join_form;
		if ( form . email . value == "" ) {
			alert ( "이메일을 입력하여 주세요." );
			form . email . focus();
		} else {
			form . method = "post";
			form . action = "id_check.php";
			form . target = "hidden_frame";
			form . submit();
		}
		
	/*	var get_email = document.getElementById("email");		// getElementById로 받을땐 id로 받는다.
		
		if ( get_email.value == "" ) {
			alert ( '이메일을 입력하여 주세요.' );
		} else {
			window.open ( 'id_check.php?$email_check+=get_email.value', 'EmailCheckWindow', 'width = 400 height = 400' );
		}
	*/
	}
</script>

	<div id="form_wrapper">
		<form action="join.php" method="post" name = "join_form">
			<table id="join" width="100%" border = "solid">
				<tr>
					<td>E-mail(ID)</td>
					<td><input type="text" id = "email" name="email" size="20"/>
					<input type = "button" name = "email_check" value = "중복체크" onclick="form_id_check ()"/></td>
				</tr>
				<tr>
					<td>Password</td>
					<td><input type="password" name="password" size="20"></td>	
				</tr>
				<tr>		
					<td>Name</td>
					<td><input type="text" name="name" size="20"></td>	
				</tr>
				<tr>	
					<td>Age</td>
					<td><input type="text" name="age" size="20"></td>						
				</tr>
				<tr>
					<td colspan="6" align="right">
					<input type="submit" value="회원가입" style="padding:5px 10px ; text-align:center ;">
					</td>
				</tr>
			</table>
		</form>
	</div>
	<?php
		require_once ('beneath.php');
	?>