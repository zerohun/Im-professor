<?php
  require_once('config.php'); 
  require_once('model.php');
?>
<!DOCTYPE html 
PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<meta http-equiv="content-type" content="text/html; charset=utf-8" />
<html>
  <head>

    <link href="style.css" rel="stylesheet" type="text/css" /> 
    <script src="http://code.jquery.com/jquery-1.7.min.js" type="text/javascript"> </script>
    <script src="select_box.js" type="text/javascript"></script>
  </head>
  <body>
  <div id="container">
		<div id="header">
			<div id="header_center">
				<img src="image/logo.png" alt="나는교수다">
			</div>
			<div id="header_right">
			<?php
				if ($loggedin) {
			?>
					<a href = "logout.php">로그아웃</a>
			<?php
				} else {
			?>
					<a href="login.php">로그인</a>
					<a href="join.php">회원가입</a>
			<?php
				}
			?>	
			</div>
		</div>
    <div id="search_bar">
      <ul>
        <li>학교선택:

          <select name="choose_school"/>
          <option id="first_option" value="-1" selected="selected">학교선택</option>

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
	
	
	<!--content-->
	  <div id="content">
		 	<div class="section" id="rank">
				<h1><img src="image/best5.png"></h1>
				<div class="list">
				
				</div>
			</div>
