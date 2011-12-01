<?php
require_once ('upper.php');
require_once ('config.php');
	
//	echo $current_user . "<br>";
		
// POST 메소드인 경우 Form을 통하여 Submit된 Data처리
	if ($_SERVER['REQUEST_METHOD'] == 'POST')
	{
		
		$professor_id = $interest = $favorite = $understand = $prepare = $benefit = $grade = $comment = $msg = ""; // 초기화

		//FORM 값을 읽는다.
		if (isset($_POST['interest'])) $interest = escape_str($_POST['interest']);
		if (isset($_POST['favorite'])) $favorite = escape_str($_POST['favorite']);
		if (isset($_POST['understand'])) $understand = escape_str($_POST['understand']);
		if (isset($_POST['prepare'])) $prepare = escape_str($_POST['prepare']);
		if (isset($_POST['benefit'])) $benefit = escape_str($_POST['benefit']);
		if (isset($_POST['grade'])) $grade = escape_str($_POST['grade']);
		if (isset($_POST['comment'])) $comment = escape_str($_POST['comment']);
		if (isset($_POST['professor_id'])) $professor_id = escape_str($_POST['professor_id']);
	
		if ( $interest == "" )
			$msg = "흥미도를 선택해 주세요~";
			
		if ( $favorite == "" )
			$msg = "호감도를 선택해 주세요~";

		if ( $understand == "" )
			$msg = "이해도를 선택해 주세요~";
			
		if ( $prepare == "" )
			$msg = "준비도를 선택해 주세요~";
			
		if ( $benefit == "" )
			$msg = "유익도를 선택해 주세요~";
			
		if ( $comment == "" )
			$msg = "귀찮아도 comment가 필수에요~";
				
		if ($msg == "") {
			// INSERT문 실행
			$query = "INSERT INTO votes(professor_id, user_id, prepare, understanding, interest, benefit, hot, comment_text) " .
					"VALUES('$professor_id', '$current_user', '$prepare', '$understand', '$interest', '$benefit', '$favorite', '$comment')";
			if (!mysql_query($query)) {
				echo  "<div class='error'>INSERT failed: ".mysql_error()."</div>";
			} else {
				// INSERT 성공
				?>
					<script type = "text/javascript"> alert ( "소중한 투표 감사합니다~" ); </script>
				<?php
				echo '<meta http-equiv = "Refresh" content = "0 ; url = index.php">';
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
			( 1 : 정말 별로 , 2 : 별로 , 3 : 보통 , 4 : 좋다 , 5 : 정말 좋다 ) <br><br><br>
			<div class = "not_comment">
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
