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
  $universities->fetch("universities", array("id","name"), "WHERE id='{$majors[0]["university_id"]}'");
  $universities = $universities->to_array();
  $professors->find_professor_by_major_id($majors[0]["id"]);
  $professors->fetch_vote_list();
  $major_professors = $professors->to_array();

  $professors->find_professor_by_university_id($universities[0]["id"]);
  $professors->fetch_vote_list();
  $university_professors = $professors->to_array();
}

else{
  echo "이 페이지는 로그인을 하셔야만 접근할 수 있습니다.";
}

?>
	<h2>개인정보</h2>
	<table id="my_info" width="60%" border = "none">
		<tr>
			<th>이름 : </th><td><?php echo $users[0]["name"] ?></td>
		</tr>
		<tr>
			<th>학과 : </th><td><?php echo $majors[0]["name"] ?></td>
		</tr>
		<tr>
			<th>학교 : </th><td><?php echo $universities[0]["name"] ?></td>
		</tr>
	</table>

<div class="major_professors">
<div class="list_title">
  <?php echo $majors[0]["name"]?> 교수 순위 
</div>
<ul>
<?php
  foreach($major_professors as $professor){
    $vote_number = count($professor["vote"]);
    echo <<<EOT
      <li><a href='professor.php?id={$professor["id"]}'>{$professor["name"]}</a> 평점 : {$professor["vote_average"]["total_average"]}</li>
      
EOT;
  }
?>
</ol>
</div>
<div class="university_professors">
<div class="list_title">
  <?php echo $universities[0]["name"]?> 교수 순위
</div>
<ol>
<?php
  foreach($university_professors as $professor){
    $vote_number = count($professor["vote"]);
    echo <<<EOT
      <li>
        <a href='professor.php?id={$professor["id"]}'>{$professor["name"]}</a> 평점 : {$professor["vote_average"]["total_average"]}
      </li>
EOT;
  }
?>
</ol>
</div>

<?php
require_once "beneath.php";
?>
