<?php
  require_once "upper.php";
  require_once('model.php');
?>
<div id="form_wraaper">
<?php
if(isset($_POST)){
	$major = $msg = "";	//초기화
	//form 값 읽기
	if(isset($_POST['major'])){
		$major = escape_str($_POST['major']);
	}
	if(isset($_POST['choose_school'])){
		$univ = escape_str($_POST['choose_school']);
	}
		
	if($major == ""){
		$msg = "학과를 입력해 주세요.";
	}
	if($msg == ""){
		$query_major = "SELECT name FROM majors WHERE name='$major'";
		$result_major = mysql_query($query_major);
		if (!mysql_fetch_array($result_major)){
			//학교를 선택했는지 확인
			$query = "SELECT id FROM universities WHERE id='$univ'";
			$result = mysql_query($query);
			$row = mysql_fetch_array($result);
			
			$query="INSERT INTO majors(university_id, name)".
					"VALUES('$row[0]', '$major');";
			if(!mysql_query($query)){
				echo  "<div class='error'>INSERT failed: ".mysql_error()."</div>";
			} else {
				echo  "<div class='error'>학과 입력 성공!</div>";
			}
		}else{
			echo  "<div class='error'>이미 등록된 학과입니다</div>";
		}
	}
}
?>
<?php
// 메시지가 있을 경우 메시지 출력
	if ($msg != "") 
		echo"<div class='message'>{$msg}</div>";
?>
	<p>학과 생성 페이지</p>
	<form action="major_create.php" method="post">
		<table id="create">
			<tr>
				<th>학교</th>
				<td>
					<select name="choose_school">
						<option id="first_option" value="-1" selected="selected">
						학교선택</option>
<?php
  $model = new Model;
  $model->fetch("universities", array("id", "name"));
  $whole_data = $model->to_array();
  foreach($whole_data as $each_data){
    echo "<option value='{$each_data["id"]}'>{$each_data["name"]}</option>";
  }
?>
					</select>
				</td>
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