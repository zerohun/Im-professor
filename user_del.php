<?php
  require_once "upper.php";
?>
<div id="form_wraaper">
<?php
	//FORM 값 읽기
	if(isset($_POST['search'])){
		$search = escape_str($_POST['search']);
	}
	
	if($search == ""){
		$msg = "삭제하려는 유저의 이메일을 입력하세요";
	}
	if($msg == ""){
		$query_user = "SELECT email FROM users WHERE email='$search'";
		$result_user = mysql_query($query_user);
		if (!mysql_fetch_array($result_user)){
			$query="DELETE FROM users where email='$search'";
			if(mysql_query($query)){
				echo  "<div class='error'>DELETE failed: ".mysql_error()."</div>";
			}else{
			?>
				<script type = "text/javascript"> alert ("삭제 성공!"); </script>
				<?php
				echo '<meta http-equiv = "Refresh" content = "0 ; url = admin.php">';
			}
		}else{
			echo  "<div class='error'>이미 등록된 학교입니다</div>";
		}
		
	}
?>
	<p>회원 삭제하기</p>
	<form action="user_del.php" method="post">
		<table id="userList">
			<?php
	$model = new Model;
	$model->fetch("users", array("id", "name", "email"));
	$whole_data = $model->to_array();
	foreach($whole_data as $each_data){
		echo "<tr value='{$each_data["id"]}'> .
			<td>{$each_data["name"]}</td> .
			<td>{$each_data["email"]}</td>
			</tr>";
		}
?>
		</table>
		<p>삭제하려는 유저의 이메일을 입력하세요</p>
		<p><input type="text" name="search"/>
		<input type="submit" value="DELETE"/></p>
	</form>
</div>
<?php
  require_once "beneath.php";
?>