<?php
  require_once "upper.php";
?>
<div id="form_wraaper">
<?php
if(isset($_POST)){
	$univ = $major = $msg="";	//초기화
	//FORM 값 읽기
	if(isset($_POST['univ']))	$univ = escape_str($_POST['univ']);
	if(isset($_POST['major']))	$major = escape_str($_POST['major']);
	
	if($univ == ""){
		$msg = "학교를 입력해 주세요.";
	}
	if($major == ""){
		$msg = "학과를 입력해 주세요.";
	}
	if($msg == ""){
		//INSERT문 실행
		$query="INSERT INTO universities(name)" . 
				"VALUES('$univ');";
		if(!mysql_query($query)){
			echo  "<div class='error'>INSERT failed: ".mysql_error()."</div>";
		}else{
			// INSERT 성공
			$query = "SELECT id FROM universities WHERE name='$univ'";
			$result = mysql_query($query);
			$row = mysql_fetch_array($result);
			
			echo  "<div class='error'>학교 입력 성공!</div>";
			$query="INSERT INTO majors(university_id, name)".
					"VALUES('$row[0]', '$major');";
			if(!mysql_query($query)){
				echo  "<div class='error'>INSERT failed: ".mysql_error()."</div>";
			} else {
				echo  "<div class='error'>학과 입력 성공!</div>";
			}
		}
	}
}
?>
<?php
// 메시지가 있을 경우 메시지 출력
	if ($msg != "") 
		echo"<div class='message'>{$msg}</div>";
?>
	<p>관리자 페이지</p>
	<form action="admin.php" method="post">
		<table id="create">
			<tr>
				<th>학교</th>
				<td><input type="text" name="univ" size="20"></td>
			</tr>
			<tr>
				<th>학과</th>
				<td><input type="text" name="major" size="20"></td>
			</tr>
		</table>
		<input type="submit" value="INSERT">
	</form>
</div>
<?php
  require_once "beneath.php";
?>