<?php
require_once ('upper.php');
require_once ('model.php');
?>
<?php		
	if ($_SERVER['REQUEST_METHOD'] == 'POST')
	{
		$univ = $msg = "";	//초기화
		//form 값 읽기
		if(isset($_POST['univ'])) $univ = escape_str($_POST['univ']);	
		
		if($univ == ""){
			$msg = "학교를 입력해 주세요.";
		}

		if ( ( substr ( $univ, -9 ) ) != "대학교" ) {
			$msg = "형식을 지켜주세요.";
		}
		
		if ( ( substr ( $univ, 0 ) ) == "대학교" ) {
			$msg = "장난하지 마시구요..";
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
					<script type = "text/javascript"> alert ("학교 등록 완료");
												location.replace('admin.php');</script>;
				<?php
				}
			}else{
				?>
					<script type = "text/javascript"> alert ( "이미 등록된 학교입니다." ); </script>
				<?php
			}
		}
	}
?>
<?php
// 메시지가 있을 경우 메시지 출력
	if ($msg != "") 
		echo"<div class='message'>{$msg}</div>";
?>
<div id="form_wraaper">
	<h1>학교 생성 페이지 입니다.</h1>
	<h3>학교명은 "ㅇㅇㅇ대학교" 형식으로 입력해 주시기 바랍니다.</h3>
	<form action="univ_create.php" method="post">
		<table id="create">
			<tr>
				<th>생성 학교 명</th>
				<td><input type="text" name="univ" size="20"/></td>
			</tr>
		</table>
		<input type="submit" value="학교 생성"/>
	</form>
</div>
<?php
  require_once "beneath.php";
?>
