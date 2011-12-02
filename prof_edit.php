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
					<?php
						$adsf = $professors[0]["university_id"];
						echo $adsf;
					?>
						<option id="first_option" value="<?php echo $professors[0]["university_id"]; ?>" selected="selected"><?php echo $whole_data[$adsf]["name"]; ?></option>
					<?php
						$model = new Model;
						$model->fetch("universities", array("id", "name"));
						$whole_data = $model->to_array();
						foreach($whole_data as $each_data){
							echo "<option value='{$each_data["id"]}'>{$each_data["name"]}</option>";
						}
						$pro_university_id = $professors[0]["university_id"];
					?>
					</select>
					<?php
					echo "university = " . $adsf;
					?>
				</td>
			</tr>
			<tr>
				<th>학과</th>
				<td><select name="major" class="major">
					<?php
						$query = "SELECT * FROM majors WHERE university_id = $pro_university_id";
						$query_result = mysql_query($query);
						$pro_major_id_result = mysql_fetch_array($query_result);
						$pro_name_query = "SELECT name FROM majors WHERE id = $pro_major_id_result[0]";
						$pro_name_result = mysql_query($pro_name_query);
						$pro_name = mysql_fetch_array($pro_name_result);
						$pro_majorid_query = "SELECT id FROM majors WHERE university_id = $pro_university_id and name = '$pro_name[0]'";
						$pro_majorid_result = mysql_query($pro_majorid_query);
						$pro_majorid = mysql_fetch_array($pro_majorid_result);
					?>
						<option value="<?php echo $pro_majorid[0]; ?>"></option>
					</select>
						<?php echo $pro_majorid[0]; ?>
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
