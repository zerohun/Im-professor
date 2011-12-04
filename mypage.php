<?php
require_once "common.php";
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
  $univ_professors_model = new Professors;



  $users->fetch("users", array("name", "major_id"), "WHERE id='{$current_user}'");
  $users = $users->to_array();
  $majors->fetch("majors", array("id", "name", "university_id"), "WHERE id='{$users[0]["major_id"]}'");
  $majors = $majors->to_array();
  $universities->fetch("universities", array("id","name"), "WHERE id='{$majors[0]["university_id"]}'");
  $universities = $universities->to_array();
  $professors->find_professor_by_major_id($majors[0]["id"]);
  $professors->fetch_vote_list();
  $major_professors = $professors->to_array();

  $univ_professors_model->find_professor_by_university_id($universities[0]["id"]);
  $univ_professors_model->fetch_vote_list();
  $university_professors = $univ_professors_model->to_array();
}

else{
  echo "이 페이지는 로그인을 하셔야만 접근할 수 있습니다.";
}

?>
	<div class="list_title">개인정보</div>
	<table id="my_info" width="40%">
		<tr>
			<th>이름 </th><td><?php echo $users[0]["name"] ?></td>
		</tr>
		<tr>
			<th>학과 </th><td><?php echo $majors[0]["name"] ?></td>
		</tr>
		<tr>
			<th>학교 </th><td><?php echo $universities[0]["name"] ?></td>
		</tr>
	</table>
	
<div class="major_professors">
<div class="list_title">
  <?php echo $majors[0]["name"]?> 교수 순위 
</div>
<table class="professor_rank" width="40%" border = "none">
<?php
if(count($major_professors) > 0){

  foreach($major_professors as $professor){
    $vote_number = count($professor["vote"]);
    echo <<<EOT
      <tr>
	  <th><a href='professor.php?id={$professor["id"]}'>{$professor["name"]}</a></th>
	  <td>평점 : {$professor["vote_average"]["total_average"]}</td></tr>
      
EOT;
  }
}
?>
</table>
</div>

<div class="university_professors">
<div class="list_title">
  <?php echo $universities[0]["name"]?> 교수 순위
</div>
<table class="professor_rank" width="40%" border = "none">
<?php
  foreach($university_professors as $professor){
    $vote_number = count($professor["vote"]);
    echo <<<EOT
      <tr>
	  <th><a href='professor.php?id={$professor["id"]}'>{$professor["name"]}</a></th> 
	  <td>평점 : {$professor["vote_average"]["total_average"]}</td></tr>
EOT;
  }
?>
</table>
</div>
<a id = "pro_create" class ="link_button" href = "prof_create.php">교수등록</a>
<?php
require_once "beneath.php";
?>
