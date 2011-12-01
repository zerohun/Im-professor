<?php
require_once ('upper.php');
require_once ('professors.php');
?>

<div id = "form_wrapper">
<?php
	if(isset($_GET) && $_GET["id"]){
	  $professor_id = $_GET["id"];
	  $professor_model = new Professors;
	  $professor_model->find_by_id($professor_id);
	  $professor_model->fetch_vote_list();
	  $professors = $professor_model->to_array();
	}
	
/*
	if (isset($_POST)){
		$name = $content = $msg = ""; // 초기화
		//FORM 값 읽기
		if (isset($_POST['major_id'])) $major_id = escape_str($_POST['major_id']);
		if (isset($_POST['name'])) $name = escape_str($_POST['name']);
		if (isset($_POST['content'])) $content = escape_str($_POST['content']);
		
		if($major_id == ""){
			$msg = "학과를 입력해 주세요.";
		}
		if($name == ""){
			$msg = "이름을 입력해 주세요.";
		}
		if($msg == ""){
			//INSERT문 실행
			$query ="INSERT INTO professors() values();";
			$query = "INSERT INTO professor_infos(major_id, name, photo, content)" .
					"VALUES('$major_id','$name','0','$content');";
			if (!mysql_query($query)) {
				echo  "<div class='error'>INSERT failed: ".mysql_error()."</div>";
			} else {
				// INSERT 성공
				$query="INSERT INTO professors(id)". "values('$professor_id');";
				$msg = "교수정보가 등록되었습니다.";
			}
		}
	}
*/

	// 메시지가 있을 경우 메시지 출력
	if ($msg != "") 
		echo"<div class='message'>{$msg}</div>";
?>
<script src="prof_edit_select_box.js" type="text/javascript"></script>
	<form action="prof_create.php" method="post">
		<table id = "prof_form" width="100%">
			<tr>
				<th>이름</th>
				<td><input type="text" name="name" size="20" value = "<?php echo $professors[0]["name"]; ?>"></td>
			</tr>
			<tr>
				<th>학교</th>
				<td><select name="school"/>
			<!--		<option id="first_option" value="<?php echo $professors[0]["major_id"]; ?>" selected="selected">학교 선택</option> -->
					<option id="first_option" value="0" selected="selected">학교 선택</option> 
					<?php
						$model = new Model;
						$model->fetch("universities", array("id", "name"));
						$whole_data = $model->to_array();
						foreach($whole_data as $each_data){
							echo "<option value='{$each_data["id"]}'>{$each_data["name"]}</option>";
							echo "<input type = 'hidden' name = 'option_university_value' id = 'option_university_value' value = '{$each_data["id"]}'>"; 	// 학교를 join.php로 보냄
						}
					?>
					</select>
				</td>
			</tr>
			<tr>
				<th>학과</th>
				<td><select name="major" class="major">
			<!--		<option value="<?php echo $professors[0]["major_id"]; ?>">학교를 먼저 선택해 주세요.</option> -->
					<option value="2" selected = "selected" >학교를 먼저 선택해 주세요.</option>
					</select>
				</td>
			</tr>
<!--			<tr>
				<th>사진</th>
				<td><textarea name="content" cols="50" rows="10"></textarea></td>
			</tr> -->
			<tr>
				<th>Comment</th>
				<td><textarea name="content" cols="50" rows="10"><?php echo $professors[0]["content"]; ?></textarea></td>
			</tr>
		</table>
		<input type="submit" value="수정">
	</form>
</div>

<?php
  require_once "beneath.php";
?>
