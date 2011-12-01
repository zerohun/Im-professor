<?php
require_once ('upper.php');
require_once ('config.php');
	
	if(!isset($_SESSION['user_id'])){
        echo "<script type = 'text/javascript'> alert ( '로그인하고왘ㅋㅋㅋㅋ' ); ";
        echo "location.replace('login.php');</script>";
    }
//	echo $current_user . "<br>";
		
// POST 메소드인 경우 Form을 통하여 Submit된 Data처리
	if ($_SERVER['REQUEST_METHOD'] == 'POST')
	{
		
		$professor_id = $interest = $hot = $understanding = $prepare = $benefit = $grade = $comment_text = $msg = ""; // 초기화

		//FORM 값을 읽는다.
		if (isset($_POST['interest'])) $interest = escape_str($_POST['interest']);
		if (isset($_POST['hot'])) $hot = escape_str($_POST['hot']);
		if (isset($_POST['understanding'])) $understanding = escape_str($_POST['understanding']);
		if (isset($_POST['prepare'])) $prepare = escape_str($_POST['prepare']);
		if (isset($_POST['benefit'])) $benefit = escape_str($_POST['benefit']);
		if (isset($_POST['grade'])) $grade = escape_str($_POST['grade']);
		if (isset($_POST['comment_text'])) $comment_text = escape_str($_POST['comment_text']);
		if (isset($_POST['professor_id'])) $professor_id = escape_str($_POST['professor_id']);
	
		if ( $interest == "" )
			$msg = "흥미도를 선택해 주세요~";
			
		if ( $hot == "" )
			$msg = "호감도를 선택해 주세요~";

		if ( $understanding == "" )
			$msg = "이해도를 선택해 주세요~";
			
		if ( $prepare == "" )
			$msg = "준비도를 선택해 주세요~";
			
		if ( $benefit == "" )
			$msg = "유익도를 선택해 주세요~";
			
		if ( $comment_text == "" )
			$msg = "귀찮아도 comment_text가 필수에요~";
				
		if ($msg == "") {
			// INSERT문 실행
			$query = "INSERT INTO votes(professor_id, user_id, prepare, understanding, interest, benefit, hot, comment_text)" .
					"VALUES('$professor_id', '$current_user', '$prepare', '$understanding', '$interest', '$benefit', '$hot', '$comment_text')";
			if (!mysql_query($query)) {
				echo  "<div class='error'>INSERT failed: ".mysql_error()."</div>";
			} else {
				// INSERT 성공
				?>
					<script type = "text/javascript"> alert ( "소중한 투표 감사합니다~" ); </script>
				<?php
				    echo "<script type = 'text/javascript'> location.replace('index.php');</script>";
			}
		}
	}
?>

<?php
	// 메시지가 있을 경우 메시지 출력
	if ($msg != "") {
		echo("<div class='message'>{$msg}</div>");
	}
?>

<div id="form_wrapper">
		<form action="vote.php" method="post" name = "vote_form" id = "vote" width = "50%">
			<input type = "hidden" id = "professor_id" name = "professor_id" value = "<?php echo escape_str($_GET['professor_id']); ?>" >
			현재 평가중인 교수님 : 
			<?php
				$pro_id = escape_str($_GET['professor_id']);
				$query_email = "SELECT name FROM professor_infos WHERE professor_id='$pro_id'";
				$result_email = mysql_query($query_email);
				$pro_id_result = mysql_fetch_array($result_email);
				echo $pro_id_result[0] . "교수님";
			?>
			<br>
			( 1 : 정말 별로 , 2 : 별로 , 3 : 보통 , 4 : 좋다 , 5 : 정말 좋다 ) <br><br><br>
			<div class = "not_comment_text">
				<ul class = "vote_title">
					<li> 흥미도 </li>
					<li> 호감도 </li>
					<li> 이해도 </li>
					<li> 유익도 </li>
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
						1<input type = "radio" id = "hot" name = "hot" value = "1"/>
						2<input type = "radio" id = "hot" name = "hot" value = "2"/>
						3<input type = "radio" id = "hot" name = "hot" value = "3"/>
						4<input type = "radio" id = "hot" name = "hot" value = "4"/>
						5<input type = "radio" id = "hot" name = "hot" value = "5"/>
					</li>
					<li>
						1<input type = "radio" id = "understanding" name = "understanding" value = "1"/>
						2<input type = "radio" id = "understanding" name = "understanding" value = "2"/>
						3<input type = "radio" id = "understanding" name = "understanding" value = "3"/>
						4<input type = "radio" id = "understanding" name = "understanding" value = "4"/>
						5<input type = "radio" id = "understanding" name = "understanding" value = "5"/>
					</li>
					<li>
						1<input type = "radio" id = "benefit" name = "benefit" value = "1"/>
						2<input type = "radio" id = "benefit" name = "benefit" value = "2"/>
						3<input type = "radio" id = "benefit" name = "benefit" value = "3"/>
						4<input type = "radio" id = "benefit" name = "benefit" value = "4"/>
						5<input type = "radio" id = "benefit" name = "benefit" value = "5"/>
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
			<div class = "comment_text">
				<p> 하고싶은 말 ( 200자 미만 ) </p> <br>
				<textarea style = "overflow : auto ; resize : none ;" cols = "50" rows = "10" name = "comment_text" maxlength = "400byte"></textarea>
			</div>
			<input type="submit" id="submitbutton" value="투표하기" style="padding:5px 10px ; text-align:center ;" >
		</form>
	</div>
</div>
	<?php
		require_once ('beneath.php');
	?>
