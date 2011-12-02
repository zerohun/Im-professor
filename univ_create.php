<?php
require_once "upper.php";
require_once('model.php');
?>
<div id="form_wraaper">
<?php
if(isset($_POST)){
	$univ = $msg = "";	//초기화
	//form 값 읽기
	if(isset($_POST['univ'])){
		$univ = escape_str($_POST['univ']);
	}	
	
	if($univ == ""){
		$msg = "학교를 입력해 주세요.";
	}
	
	if($msg == ""){
		$query_univ = "SELECT name FROM universities WHERE name='$univ'";
		$result_univ = mysql_query($query_univ);
		if (!mysql_fetch_array($result_univ)){
			//INSERT문 실행
			$query="INSERT INTO universities(name)" . 
				"VALUES('$univ');";
			if(!mysql_query($query)){
				echo  "<div class='error'>INSERT failed: ".mysql_error()."</div>";
			}else{
			?>
				<script type = "text/javascript"> alert ("학교 등록 완료"); </script>
				<?php
				echo '<meta http-equiv = "Refresh" content = "0 ; url = major.php">';
			}
		}else{
			echo  "<div class='error'>이미 등록된 학교입니다</div>";
		}
		
	}
}
?>
<?php
// 메시지가 있을 경우 메시지 출력
	if ($msg != "") 
		echo"<div class='message'>{$msg}</div>";
?>
	<p>학교 생성 페이지</p>
	<form action="univ_create.php" method="post">
		<table id="create">
			<tr>
				<th>이름</th>
				<td><input type="text" name="univ" size="20"></td>
			</tr>
		</table>
		<input type="submit" value="INSERT">
	</form>
</div>
<?php
  require_once "beneath.php";
?>