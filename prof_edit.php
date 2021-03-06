<?php
require_once ('upper.php');
require_once ('professors.php');
?>
<div id = "form_wrapper">
<?php
	if(!isset($_SESSION['user_id'])){
        echo "	<script type = 'text/javascript'> alert ( '로그인이 필요한 페이지 입니다...' );";
        echo "location.replace('login.php');</script>";
    }
	
  $msg = "";
	if(isset($_GET) && $_GET["id"]){
	  $professor_id = $_GET["id"];
	  $professor_model = new Professors;
	  $professor_model->find_by_id($professor_id);
	  $professor_model->fetch_vote_list();
	  $professors = $professor_model->to_array();
	}

	// 메시지가 있을 경우 메시지 출력
	if ($msg != "") 
		echo"<div class='message'>{$msg}</div>";
?>
<script src="prof_edit_select_box.js" type="text/javascript"></script>
	<form action="prof_update.php" method="post">
		<table id = "prof_form" width="100%">
			<tr>
				<th>이름</th>
				<td><input type="text" name="name" size="20" value = "<?php echo $professors[0]["name"]; ?>"></td>
			</tr>
			<tr>
				<th>학교</th>
				<td><select name="university_id"/>
					<?php
						$pro_unv_id = $professors[0]['university_id'];
						$model = new Model;
						$model->fetch("universities", array("id", "name"));
						$whole_data = $model->to_array();
						foreach($whole_data as $each_data){
							echo "<option value='{$each_data["id"]}'>{$each_data["name"]}</option>";
						}
						$query = "SELECT name FROM universities WHERE id = $pro_unv_id";
						$query_result = mysql_query($query);
						$pro_univ_id_result = mysql_fetch_array($query_result);
					?>
						<option id="first_option" value="<?php echo $professors[0]["university_id"]; ?>" selected="selected"><?php echo $pro_univ_id_result[0]; ?></option>
					</select>
				</td>
			</tr>
			<tr>
				<th>학과</th>
				<td><select name="major_id" class="embedded_major">
					<?php
						$pro_maj_id = $professors[0]['major_id'];
						$option = "WHERE university_id=$pro_unv_id";
						$model = new Model;
						$model->fetch("majors", array("id", "name"), $option);
						$whole_data = $model->to_array();
						foreach($whole_data as $each_data){
							echo "<option value='{$each_data["id"]}'>{$each_data["name"]}</option>";
						}
						$query = "SELECT name FROM majors WHERE id = $pro_maj_id and university_id = $pro_unv_id";
						$query_result = mysql_query($query);
						$pro_major_id_result = mysql_fetch_array($query_result);
					?>
						<option id="second_option" value="<?php echo $professors[0]["major_id"]; ?>" selected="selected"><?php echo $pro_major_id_result[0]; ?></option>
					</select>
				</td>
			</tr>
<!--			<tr>
				<th>사진</th>
				<td><textarea name="content" cols="50" rows="10"></textarea></td>
				</tr> -->
			<tr>
				<th>Comment</th>
				<td><textarea style = "overflow : auto ; resize : none ;"  name="content" cols="50" rows="10"><?php echo $professors[0]["content"]; ?></textarea></td>
			</tr>
    </table>
    <input type="hidden" name="professor_id" value="<?php echo $professors[0]["id"] ?>">
		<input type="submit" value="수정">
	</form>
</div>

<?php
  require_once "beneath.php";
?>
