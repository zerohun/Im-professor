<?php
require_once ('upper.php');
/*
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
		if (isset($_POST['option_university_value'])) $option_univ = escape_str($_POST['option_university_value']);
		if (isset($_POST['option_major_value'])) $option_major = escape_str($_POST['option_major_value']);
		
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
			$query = "INSERT INTO users(email, password, name, age, univ_id, major_id) " .
					"VALUES('$email', '$password', '$name', '$age', '$option_univ', '$option_major')";
			if (!mysql_query($query)) {
				echo  "<div class='error'>INSERT failed: ".mysql_error()."</div>";
			} else {
				// INSERT 성공
				?>
					<script type = "text/javascript"> alert ( "회원가입 완료~" ); </script>
				<?php
				echo '<meta http-equiv = "Refresh" content = "0 ; url = login.php?email='.$email.'&password='.$password.'">';
			}
		}
	}

?>

<?php
	// 메시지가 있을 경우 메시지 출력
	if ($msg != "") 
		echo("<div class='message'>{$msg}</div>");
*/
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
		<form action="vote.php" method="post" name = "vote_form" id = "vote" width = "50%">
			( 1 : 정말 별로 , 2 : 별로 , 3 : 보통 , 4 : 좋다 , 5 : 정말 좋다 ) <br><br><br>
			<div class = "not_comment">
				<ul class = "vote_title">
					<li> 흥미도 </li>
					<li> 호감도 </li>
					<li> 이해도 </li>
					<li> 수업준비도 </li>
					<li> 수업 성적 </li>
				</ul>
				
				<ul class = "vote_content">
					<li>
						1<input type = "radio" id = "interest" name = "interest" value = "1"/>
						2<input type = "radio" id = "interest" name = "interest" value = "2"/>
						3<input type = "radio" id = "interest" name = "interest" value = "3"/>
						4<input type = "radio" id = "interest" name = "interest" value = "4"/>
						5<input type = "radio" id = "interest" name = "interest" value = "5"/>
					</li>
					<li>
						1<input type = "radio" id = "favorite" name = "favorite" value = "1"/>
						2<input type = "radio" id = "favorite" name = "favorite" value = "2"/>
						3<input type = "radio" id = "favorite" name = "favorite" value = "3"/>
						4<input type = "radio" id = "favorite" name = "favorite" value = "4"/>
						5<input type = "radio" id = "favorite" name = "favorite" value = "5"/>
					</li>
					<li>
						1<input type = "radio" id = "understand" name = "understand" value = "1"/>
						2<input type = "radio" id = "understand" name = "understand" value = "2"/>
						3<input type = "radio" id = "understand" name = "understand" value = "3"/>
						4<input type = "radio" id = "understand" name = "understand" value = "4"/>
						5<input type = "radio" id = "understand" name = "understand" value = "5"/>
					</li>
					<li>
						1<input type = "radio" id = "prepare" name = "prepare" value = "1"/>
						2<input type = "radio" id = "prepare" name = "prepare" value = "2"/>
						3<input type = "radio" id = "prepare" name = "prepare" value = "3"/>
						4<input type = "radio" id = "prepare" name = "prepare" value = "4"/>
						5<input type = "radio" id = "prepare" name = "prepare" value = "5"/>
					</li>
					<li>
						<input type = "text" id = "grade" name = "grade" size = "1"/>
					</li>
				</ul>
			</div>
			<div class = "comment">
				<p> 하고싶은 말 ( 200자 미만 ) </p> <br>
				<textarea style = "overflow : auto ; resize : none ;" cols = "50" rows = "10" name = "comment" maxlength = "400byte"></textarea>
			</div>
			<input type="submit" id="submitbutton" value="투표하기" style="padding:5px 10px ; text-align:center ;" >
		</form>
	</div>
</div>
	<?php
		require_once ('beneath.php');
	?>