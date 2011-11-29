<?php
require_once "config.php";
require_once "upper.php";
require_once "model.php";
require_once "professors.php";

if ($current_user){
  $users = new Model;
  $universities = new Model;
  $majors = new Model;
  $prof_infos = new Model;
  $professors = new Professors;


  $users->fetch("users", array("name", "major_id"), "WHERE id='{$current_user}'");
  $users = $users->to_array();
  $majors->fetch("majors", array("id", "name", "university_id"), "WHERE id='{$users[0]["major_id"]}'");
  $majors = $majors->to_array();
  $universities->fetch("universities", array("name"), "WHERE id='{$majors[0]["university_id"]}'");
  $universities = $universities->to_array();
  $professors->find_professor_by_major_id($majors[0]["id"]);
  $professors = $professors->to_array();
  




  
}

else{
  echo "이 페이지는 로그인을 하셔야만 접근할 수 있습니다.";
}

?>
<ul>
<li>학과 : <?php echo $majors[0]["name"] ?></li>
<li>학교 : <?php echo $universities[0]["name"] ?></li>
</ul>

<ul>
<?php
  foreach($professors as $professor){
    echo "<a href='professor.php?id={$professor["id"]}'>{$professor["name"]}</a>";
  }
?>
</ul>

<?php

?>

<?php
require_once "beneath.php";
?>
