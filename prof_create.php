<?php
require_once ('upper.php');
?>
<?php
	if ($_SERVER['REQUEST_METHOD'] == 'POST')
	{		
		$name = $content = $msg = ""; // 초기화
		//FORM 값 읽기
		if (isset($_POST['major'])) $major_id = escape_str($_POST['major']);
		if (isset($_POST['school'])) $university_id = escape_str($_POST['school']);
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
			$query = "INSERT INTO professors(major_id, university_id) values('$major_id','$university_id');";
			if (!mysql_query($query)) {
				echo "<div class='error'>INSERT failed: ".mysql_error()."</div>";
			} else {
				// INSERT 성공
				$query = "SELECT id FROM `professors` where 1 order by id desc limit 1";
				$proid = mysql_query($query);
				$professor_id = mysql_fetch_array($proid); 
				$query = "INSERT INTO professor_infos(professor_id, user_id, major_id, university_id, name, photo, content)" .
					"VALUES('$professor_id[0]','$current_user','$major_id','$university_id','$name','0','$content');";
				if (!mysql_query($query)) {
					echo "<div class='error'>INSERT failed: ".mysql_error()."</div>";
				} else {
					?>
						<script type = "text/javascript"> alert ( "교수가 등록되었습니다." ); 
												location.replace('mypage.php');</script>;
					<?php
				}
			}
		}
	}
?>

<?php
	// 메시지가 있을 경우 메시지 출력
  if(isset($_GET["msg"])){
    $msg = $_GET["msg"];
  }
  else{
    $msg = "";

  }
	if ($msg != "") 
		echo"<div class='message'>{$msg}</div>";
?>
<div id = "form_wrapper">
	<h1>교수 등록 페이지 입니다.</h1>
	<form action="prof_create.php" method="post">
		<table id = "create">
			<tr>
				<th>교수 성함</th>
				<td><input type="text" name="name" size="20"/></td>
			</tr>
			<tr>
				<th>선택 학교 &amp; 학과</th>
				<td><?php require_once ('major_select_box.php');?></td>
			</tr>
			<tr>
				<th>교수 설명</th>
				<td><textarea style = "overflow : auto ; resize : none ;" cols = "50" rows = "5" name = "content" maxlength = "400byte"></textarea></td>
			</tr>
		</table>
		<input type="submit" value="교수 등록"/>
	</form>
</div>

<?php
  require_once "beneath.php";
?>
