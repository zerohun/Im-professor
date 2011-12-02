<?php
require_once ('upper.php');
require_once ('config.php');
	
	if(isset($_SESSION['user_id'])){
        echo "	<script type = 'text/javascript'> alert ( '이미 로긴 했어...' ); </script>";
        echo '<meta http-equiv = "Refresh" content = "0 ; url = index.php">';
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
		if (isset($_POST['school'])) $option_univ = escape_str($_POST['school']);
		if (isset($_POST['major'])) $option_major = escape_str($_POST['major']);
		
		if ($email == "")
			$msg = "이메일을 입력하여 주세요.";
		else if ( strlen ( $email ) > 30 )
			$msg = "이메일 길이가 너무 기네요~";
			
		if ($password == "")
			$msg = "비밀번호를 입력하여 주세요.";
		else if ( strlen ( $password ) > 10 )
			$msg = "비밀번호 길이가 너무 기네요~";

		if ($name == "")
			$msg = "이름을 입력하여 주세요.";
		else if ( strlen ( $name ) > 20 )
			$msg = "넌 무슨 외국인이냐?";
			
		if ( strlen ( $age ) > 4 )
			$msg = "거북이 납셨네...";
			
		if ( $option_univ == "" )
			$msg = "대학교를 선택하여 주세요.";
			
		if ( $option_major == "" )
			$msg = "학과를 선택하여 주세요.";
				
		if ($msg == "") {
			// INSERT문 실행
			$query = "INSERT INTO users(email, password, name, age, major_id) " .
					"VALUES('$email', '$password', '$name', '$age', '$option_major')";
			if (!mysql_query($query)) {
				echo  "<div class='error'>INSERT failed: ".mysql_error()."</div>";
			} else {
				// INSERT 성공
				?>
					<script type = "text/javascript"> alert ( "회원가입 완료~" ); </script>
					<script type = "text/javascript"> window.location = "login.php?email=<?php echo $email;?>&password=<?php echo $password;?>"; </script>
				<?php
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
	/*	var form = document . join_form;
		if ( form . email . value == "" ) {
			alert ( "이메일을 입력하여 주세요." );
			form . email . focus();
		} else {
			form . method = "post";
			form . action = "id_check.php";
			form . target = "hidden_frame";
			form . submit();
		}
		*/
		var get_email = document.getElementById("email");		// getElementById로 받을땐 id로 받는다.
		
		if ( get_email.value == "" ) {
			alert ( "이메일을 입력하여 주세요." );
		} else {
			window.open ( 'id_check.php?email='+get_email.value, 'EmailCheckWindow', 'width = 0 height = 0' );
		}	

	}
	
	function email_form_check(){
		var mail = document.getElementById("email");
		var filter=/^[0-9a-zA-Z]([-_\.]?[0-9a-zA-Z])*@[0-9a-zA-Z]([-_\.]?[0-9a-zA-Z])*\.[a-zA-Z]{2,3}$/i;
		if ( filter.test ( mail.value ) ) {
			form_id_check ();
		} else {
			alert ( "올바르지 않은 메일 형식 이에요~" );
		}
			window.open ( 'id_check.php?email='+get_email.value, 'EmailCheckWindow', 'width = 400 height = 400' );
	}	
</script>

	<div id="form_wrapper">
	<script src="embedded_select_box.js" type="text/javascript"></script>
		<form action="join.php" method="post" name = "join_form">
			<table id="join" width="50%" border = "none" >
			<tr>
				<td colspan=3>
				<h1> 회원가입 </h1>
				<h3> "나는 교수다"의 원활한 이용을 위해서는 회원등록이 필요합니다.<br>
					이하의 항목에 빠짐없이 입력해주세요.<br><br>
				<hr color="ff0033">
				</td>
				<tr>
					<th>E-mail(ID)</th>
					<td><input type="text" id = "email" name="email" size="20"/></td>
					<td><input type = "button" name = "email_check" value = "중복체크" onclick="email_form_check ()"/></td>
				</tr>
				<tr>
					<th>Password</th>
					<td><input type="password" name="password" size="20"></td>	
				</tr>
				<tr>		
					<th>Name</th>
					<td><input type="text" name="name" size="20"></td>	
				</tr>
				<tr>	
					<th>Age</th>
					<td><input type="text" name="age" size="20"></td>						
				</tr>
				<tr>
					<th>University & Major</th>
					<td><?php require_once ('major_select_box.php'); ?></td>		
				</tr>
				<tr>
					<td colspan="3" align="right">
					<hr color="ff0033"><br>
					<input type="button" id="submitbutton" value="회원가입" style="text-align:center;" onclick = "alert ( '야 중복체크해' )" >
					</td>
				</tr>
			</table>
		</form>
	</div>
	<?php
		require_once ('beneath.php');
	?>
