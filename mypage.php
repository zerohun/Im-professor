<?php
require_once "config.php";
require_once "upper.php";
require_once "model.php";

if ($current_user){
  echo $current_user;
  $users = new Model;
  $schools = new Model;
  $majors = new Model;

  $users->fetch("users", array("name", "major_id"), "WHERE id='{$current_user}'");
  $users = $users->to_array();
  $majors->fetch("majors", array("name", "university_id"), "WHERE id='{$users[0]["major_id"]}'");
  $majors = $majors->to_array();
  $schools->fetch("schools", array("name"), "WHERE id='{$majors[0]["university_id"]}'");
  $schools = $schools->to_array();

  
}

else{
  echo "이 페이지는 로그인을 하셔야만 접근할 수 있습니다.";
}

?>
<ul>
<li>학과 : <?php echo $majors[0]["name"] ?></li>
<li>학교 : <?php echo $schools[0]["name"] ?></li>
</ul>



<?php
require_once "beneath.php";
?>
