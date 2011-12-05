<?php
require_once('config.php'); 
require_once('common.php');
require_once('model.php');

	$query = "SELECT email FROM users WHERE id='$current_user'";
	$result = mysql_query($query);
	$row = mysql_fetch_array($result);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" 
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
  <head>
	<title>나는 교수다</title>
	<meta http-equiv="content-type" content="text/html; charset=utf-8" />
    <link href="style.css" rel="stylesheet" type="text/css" /> 
    <script src="http://code.jquery.com/jquery-1.7.min.js" type="text/javascript"> </script>
    <script src="select_box.js" type="text/javascript"></script>	
  </head>
  <body bgproperties="fixed" oncontextmenu="return false" ondragstart="return false" onselectstart="return false">
  <div id="container">
		<div id="header">
			<div id="header_logo">
				<a href = "index.php"><img src="image/logo.png" alt="나는교수다"/></a>
			</div>
			<div id="header_right">
			<?php
				if ($loggedin) {
			?>
				<?php
					if ( $row[0] == $db_admin ) {
				?>
						<a href = "logout.php">로그아웃</a>
						<a href = "admin.php">My Page</a>
				<?php
					} else {
				?>
						<a href = "logout.php">로그아웃</a>
						<a href = "mypage.php">My Page</a>
				<?php
					}
				?>
			<?php
				} else {
			?>
					<a href = "login.php">로그인</a>
					<a href = "join.php">회원가입</a>
					<a href = "admin.php">Admin</a>	
			<?php
				}
			?>
			</div>
		</div>
    <div id="search_bar">
      <ul>
        <li>학교선택:

          <select name="choose_school">
          <option class="first_option" value="-1" selected="selected">학교선택</option>

<?php
  $model = new Model;
  $model->fetch("universities", array("id", "name"));
  $whole_data = $model->to_array();
  foreach($whole_data as $each_data){
    echo "<option value='{$each_data["id"]}'>{$each_data["name"]}</option>";
  }
?>
          </select>
        </li>

        <li>학부/과선택:
          <select name="choose_major" class="major">
            <option value="0">학교를 먼저 선택해 주세요.</option>
          </select>
        </li>
        <li>교수선택:
          <select name="choose_professor" id="choose_professor" class="professor">
            <option value="0">학교 혹은 학과를 먼저 선택해 주세요.</option>
          </select>
        </li>
      </ul>
    </div>
	
	<div id="content" style = "overflow : auto ;">
		 	
