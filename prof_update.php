﻿<?php
  require_once "upper.php";
?>
<div id="form_wrpper">
	<p>교수 정보를 입력하세요!</p>
	<?php
	if (isset($_POST)){
		$name = $content = $msg = ""; // 초기화
		//FORM 값 읽기
		if (isset($_POST['professor_id'])) $professor_id = escape_str($_POST['professor_id']);
		if (isset($_POST['name'])) $name = escape_str($_POST['name']);
		if (isset($_POST['content'])) $content = escape_str($_POST['content']);
		
		if($professor_id == ""){
			$msg = "ID를 입력해 주세요.";
		}
		if($name == ""){
			$msg = "이름을 입력해 주세요.";
		}
		if($msg == ""){
			//INSERT문 실행
			$query = "professor_infos SET professor_id=$professor_id name=$name"
			$query = "UPDATE professor_infos(professor_id, name, content)" .
					"VALUES('$professor_id','$name','$content')";
			if (!mysql_query($query)) {
				echo  "<div class='error'>INSERT failed: ".mysql_error()."</div>";
			} else {
				// INSERT 성공
				$msg = "교수정보가 등록되었습니다.";
			}
			$query = "INSERT INTO professors(id)" .
					"VALUES('$id')";
		}
	}
	?>
	<?php
	// 메시지가 있을 경우 메시지 출력
	if ($msg != "") 
		echo("<div class='message'>{$msg}</div>");
?>
	<form action="prof_update.php" method="post">
		<table id = "prof_form" width="100%">
			<tr>
				<th>ID</th>
				<td><input type="text" name="professor_id" size="20"></td>
			</tr>
			<tr>
				<th>이름</th>
				<td><input type="text" name="name" size="20"></td>
			</tr>
			<tr>
				<th>내용 입력</th>
				<td><textarea name="content" cols="93" row="5"></textarea>
				</td>
			</tr>
		</table>
		<input type="submit" value="INSERT">
	</form>
</div>
<?php
  require_once "beneath.php";
?>