<?php
require_once "upper.php";
?>
<?php
	if(!isset($_SESSION['user_id'])){
        echo "<script type = 'text/javascript'> alert ( '관리자만 이용 가능한 페이지 입니다.' ); ";
        echo "location.replace('login.php');</script>";
    } else {	
		$query = "SELECT email FROM users WHERE id='$current_user'";
		$result = mysql_query($query);
		$row = mysql_fetch_array($result);
		if ( $row[0] != $db_admin ) {
			echo "<script type = 'text/javascript'> alert ( '어딜 감히 오시나요...' ); ";
			echo "alert ( '잘가.' ); ";
			echo "location.replace('index.php');</script>";
		}
	}
	//FORM 값 읽기
	if ($_SERVER['REQUEST_METHOD'] == 'POST')
	{		
		if (isset($_POST['delete_user'])) $user = escape_str($_POST['delete_user']);
		if (isset($_POST['delete_prof'])) $prof = escape_str($_POST['delete_prof']);
		if (isset($_POST['delete_univ'])) $univ = escape_str($_POST['delete_univ']);
		if (isset($_POST['delete_major'])) $major = escape_str($_POST['delete_major']);
		
		if($user != -1){
			$query="DELETE FROM users where email='$user'";
			if(!mysql_query($query)){
				echo  "<div class='error'>DELETE failed: ".mysql_error()."</div>";
			}else{
				?>
					<script type = "text/javascript"> alert ("회원 삭제 완료"); </script>
				<?php
			}
		}
		
		if($prof != -1){
			$query_search = "SELECT professor_id FROM professor_infos where name='$prof'";
			$search_array = mysql_query($query_search);
			$result = mysql_fetch_array($search_array);
			
			$query="DELETE FROM professors where id='$result[0]'";
			if(!mysql_query($query)){
				echo  "<div class='error'>DELETE failed: ".mysql_error()."</div>";
			}
			$query="DELETE FROM votes where professor_id='$result[0]'";
			if(!mysql_query($query)){
				echo  "<div class='error'>DELETE failed: ".mysql_error()."</div>";
			}
			$query="DELETE FROM professor_infos where name='$prof'";
			if(!mysql_query($query)){
				echo  "<div class='error'>DELETE failed: ".mysql_error()."</div>";
			}else{
				?>
					<script type = "text/javascript"> alert ("교수 삭제 완료") </script>
				<?php
			}
		}
		
		if($univ != -1){
			$query_search = "SELECT id FROM universities where name='$univ'";
			$search_array = mysql_query($query_search);
			$result = mysql_fetch_array($search_array);
			
			$delete_univ_model = new Model;
			$delete_univ_model->fetch("majors", array("id", "name", "university_id"));
			$delete_data = $delete_univ_model->to_array();
			foreach($delete_data as $each_data){
				$query="DELETE FROM majors where university_id='$result[0]'";
				mysql_query($query);
				if(!mysql_query($query)){
					echo  "<div class='error'>DELETE failed: ".mysql_error()."</div>";
				}
			}
			
			$delete_prof_model = new Model;
			$delete_prof_model->fetch("professor_infos", array("id", "name", "university_id", "professor_id"));
			$delete_data = $delete_prof_model->to_array();
			foreach($delete_data as $each_data){
				if ($each_data["university_id"] == $result[0] ){
					$query="DELETE FROM votes where professor_id='$each_data[professor_id]'";
					mysql_query($query);
					if(!mysql_query($query)){
						echo  "<div class='error'>DELETE failed: ".mysql_error()."</div>";
					}
				}
				
				$query="DELETE FROM professor_infos where university_id='$result[0]'";
				mysql_query($query);
				if(!mysql_query($query)){
					echo  "<div class='error'>DELETE failed: ".mysql_error()."</div>";
				}
			}
			
			$delete_profess_model = new Model;
			$delete_profess_model->fetch("professors", array("id", "university_id"));
			$delete_data = $delete_profess_model->to_array();
			foreach($delete_data as $each_data){
				$query="DELETE FROM professors where university_id='$result[0]'";
				mysql_query($query);
				if(!mysql_query($query)){
					echo  "<div class='error'>DELETE failed: ".mysql_error()."</div>";
				}
			}

			$query="DELETE FROM universities where name='$univ'";
			if(!mysql_query($query)){
				echo  "<div class='error'>DELETE failed: ".mysql_error()."</div>";
			}else{
				?>
					<script type = "text/javascript"> alert ("학교 삭제 완료") </script>
				<?php
			}
		}
		
		if($major != -1){
			$query="DELETE FROM majors where name='$major'";
			if(!mysql_query($query)){
				echo  "<div class='error'>DELETE failed: ".mysql_error()."</div>";
			}else{
				?>
					<script type = "text/javascript"> alert ("학과 삭제 완료") </script>
				<?php
			}
		}
		
		if( ($user + $prof + $univ + $major) != -4 ){
			?>
				<script type = "text/javascript"> location.replace('admin.php');</script>;
			<?php
		} else {
			?>
				<script type = "text/javascript"> alert ("선택된 내용이 없습니다.") </script>
				<script type = "text/javascript"> location.replace('user_del.php');</script>;
			<?php
		}
	}
?>
<script type = "text/javascript"> alert ("데이터 삭제 페이지 입니다. 복구가 불가능하니 주의해서 사용하기 바랍니다."); </script>

<div id="form_wraaper">
	<h1>데이터 삭제 페이지 입니다.</h1>
	<h3>삭제시 되돌릴 수 없으니 주의 바랍니다.</h3>
	<h4>학교 삭제시 해당 학교, 학과, 교수가 모두 삭제 되니 주의 바랍니다.</h4>
	<form action="user_del.php" method="post">
		<table id="Delete_List">
			<select name="delete_user">
				<option id="option" value="-1" selected="selected">회원 선택</option>
					<?php
						$model = new Model;
						$model->fetch("users", array("id", "name", "email"));
						$whole_data = $model->to_array();
						foreach($whole_data as $each_data){
							echo "<option value='{$each_data["email"]}'>{$each_data["name"]}  {$each_data["email"]}</option>";
						}
					?>
			</select>
			
			<select name="delete_prof">
				<option id="option" value="-1" selected="selected">교수 선택</option>
					<?php	   
						$model = new Model;
						$model->fetch("professor_infos", array("id", "name", "university_id"));
						$whole_data = $model->to_array();
						$model_univ = new Model;
						$model_univ->fetch("universities", array("id", "name"));
						$univ_whole_data = $model_univ->to_array();
						$whole_size = count($whole_data);
						$univ_whole_size = count($univ_whole_data);
						for ( $i = 0 ; $i < $whole_size ; $i++ ) {
							for ( $j = 0 ; $j < $univ_whole_size ; $j++ ) {
								if ( $whole_data[$i]["university_id"] == $univ_whole_data[$j]["id"] ) {
									echo "<option value='{$whole_data[$i]["name"]}'>{$whole_data[$i]["name"]} {$univ_whole_data[$j]["name"]}</option>";
								}
							}
						}
					?>
			</select>
		
			<select name="delete_univ">
				<option id="option" value="-1" selected="selected">학교 선택</option>
					<?php
						$model = new Model;
						$model->fetch("universities", array("id", "name"));
						$whole_data = $model->to_array();
						foreach($whole_data as $each_data){
							echo "<option value='{$each_data["name"]}'>{$each_data["name"]}</option>";
						}
					?>
			</select>
			
			<select name="delete_major">
				<option id="option" value="-1" selected="selected">학과 선택</option>
					<?php
						$model = new Model;
						$model->fetch("majors", array("id", "name", "university_id"));
						$whole_data = $model->to_array();
						$model_univ = new Model;
						$model_univ->fetch("universities", array("id", "name"));
						$univ_whole_data = $model_univ->to_array();
						$whole_size = count($whole_data);
						$univ_whole_size = count($univ_whole_data);
						for ( $i = 0 ; $i < $whole_size ; $i++ ) {
							for ( $j = 0 ; $j < $univ_whole_size ; $j++ ) {
								if ( $whole_data[$i]["university_id"] == $univ_whole_data[$j]["id"] ) {
									echo "<option value='{$whole_data[$i]["name"]}'>{$univ_whole_data[$j]["name"]} {$whole_data[$i]["name"]}</option>";
								}
							}
						}
					?>
			</select>
		</table>
		<p><input type="submit" value="선택된 데이터 삭제"/></p>
	</form>
</div>
<?php
  require_once "beneath.php";
?>