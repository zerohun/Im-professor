<?php
  require_once "upper.php";
?>
<div id="form_wraaper">
<?php
	$query="SELECT * FROM users";
	$result = mysql_query($query);		
	$row = mysql_fetch_array($result);	

	//FORM 값 읽기
	if(isset($_POST['check'])){
		$check = escape_str($_POST['check']);
	}
	
//	$query="DELETE FROM users where "
?>
	<p>회원 삭제하기</p>
	<form action="user_del.php" method="post">
		<table id="delete">
			<?php
  $model = new Model;
  $model->fetch("users", array("id", "name", "email"));
  $whole_data = $model->to_array();
  foreach($whole_data as $each_data){
    echo "<tr value='{$each_data["id"]}'> .
		<td>{$each_data["name"]}</td> .
		<td>{$each_data["email"]}</td>
		<td><input type='checkbox' name='check' value=''/></td>
		</tr>";
  }
?>
		</table>
		<input type="submit" value="DELETE"/>
	</form>
</div>
<?php
  require_once "beneath.php";
?>