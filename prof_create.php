<?php
  require_once "upper.php";
?>
<div id = "form_wrapper">
	<p>교수 정보를 입력하세요!</p>
	<?php
	require_once('config.php');
	
	if ($_SERVER['REQUEST_METHOD'] == 'POST'){
		$name = $content = $msg = ""; // 초기화
		//search_bar읽기
		if (isset($_POST['school'])) $school = escape_str($_POST['school']);
		if (isset($_POST['major'])) $major = escape_str($_POST['major']);
		if (isset($_POST['prof_name'])) $prof_name = escape_str($_POST['prof_name']);
		
		if($school == ""){
			$msg = "학교를 선택해 주세요.";
		}
		if($major == ""){
			$msg = "학과를 선택해 주세요.";
		}
		if($prof_name == ""){
			$msg = "교수를 선택해 주세요.";
		}
		if($msg == ""){
			//INSERT문 실행
			$query = "insert into professors)(school, major, prof_name)" .
					"value('$name','$major','$prof_name')";
			if (!mysql_query($query)) {
				echo  "<div class='error'>INSERT failed: ".mysql_error()."</div>";
			} else {
				// INSERT 성공
				$msg = "교수정보가 등록되었습니다.";
			}
		}
	}
	?>
	<form action="prof_create.php" method="post">
		<table id = "prof_form" width="100%">
			<tr>
				<th>학교</th>
				<td><input type="text" name="school" size="20"></td>
			</tr>
			<tr>
				<th>학과</th>
				<td><input type="text" name="major" size="20"></td>
			</tr>
			<tr>
				<th>이름</th>
				<td><input type="text" name="prof_name" size="20"></td>
			</tr>
		</table>
		<input type="submit" value="INSERT">
	</form>
</div>
<?php
  require_once "beneath.php";
?>
