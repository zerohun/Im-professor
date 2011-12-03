<?php
require_once "upper.php";
?>
<?php
	//FORM 값 읽기
	if ($_SERVER['REQUEST_METHOD'] == 'POST')
	{		
		if (isset($_POST['choose_user'])) $user = escape_str($_POST['choose_user']);
	
		if($user == ""){
			$msg = "삭제하려는 유저를 선택하세요";
		}
		
		if($msg == ""){
			$query="DELETE FROM users where email='$user'";
			if(!mysql_query($query)){
				echo  "<div class='error'>DELETE failed: ".mysql_error()."</div>";
			}else{
				?>
					<script type = "text/javascript"> alert ("삭제 완료");
										location.replace('admin.php');</script>;
				<?php
			}
		}
	}
?>
<div id="form_wraaper">
	<h1>회원 삭제 페이지 입니다.</h1>
	<h3>삭제시 되돌릴 수 없으니 주의 바랍니다.</h3>
	<form action="user_del.php" method="post">
		<table id="userList">
			<select name="choose_user">
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
		</table>
		<input type="submit" value="회원 삭제"/></p>
	</form>
</div>
<?php
  require_once "beneath.php";
?>