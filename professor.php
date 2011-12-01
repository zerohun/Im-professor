<?php
require_once "config.php";
require_once "common.php";
require_once "upper.php";
require_once "model.php";
require_once "professors.php";

$number_for_page = 5;
$max_page_for_each_page = 10;


if(isset($_GET) && $_GET["id"]){
  $professor_id = $_GET["id"];

  $professor_model = new Professors;
  $professor_model->find_by_id($professor_id);
  $professor_model->fetch_vote_list();
  $professors = $professor_model->to_array();

  $major_model = new Model;
  $major_model->fetch("majors", array("university_id", "name"), "WHERE id = {$professors[0]["major_id"]}");
  $majors = $major_model->to_array();

  $school_model = new Model;
  $school_model->fetch("universities", array("name"), "WHERE id = {$majors[0]["university_id"]}");
  $schools = $school_model->to_array();
}
$page = 0;
if(isset($_GET["page"])){
  $page = (int)$_GET["page"];
}
else{
}
?>
<div id="form_wrapper">
	<table>
		<tr>
			<th>이름</th>
			<td><?php echo $professors[0]["name"];?></td>
		</tr>
		<tr>
			<th>학교</th>	
			<td><?php echo $schools[0]["name"];?></td>
		</tr>
		<tr>
			<th>학과</th>
			<td><?php echo $majors[0]["name"];?></td>
		</tr>
    <tr>
      <th>소개</th>
      <th colspan="2"><?php echo $professors[0]["content"] ?></th>
    </tr>
    <tr>
      <td><a href="prof_edit.php?id=<?php echo $professor_id ?>">교수정보 수정</a></td>
      <td><a href="professor_infos.php?professor_id=<?php echo $professor_id ?>">Show history</a></td> 
    </tr>

		<tr>
			<th>흥미도</th>
			<td><?php echo $professors[0]["vote_average"]["interest_average"];?></td>
		</tr>


		<tr>
			<th>호감도</th>
			<td><?php echo $professors[0]["vote_average"]["hot_average"];?></td>
		</tr>

		<tr>
			<th>이해도</th>
			<td><?php echo $professors[0]["vote_average"]["understanding_average"];?></td>
		</tr>

		<tr>
			<th>얼마나 유익했는가?</th>
			<td><?php echo $professors[0]["vote_average"]["benefit_average"];?></td>
		</tr>

		<tr>
			<th>수업준비</th>
			<td><?php echo $professors[0]["vote_average"]["prepare_average"];?></td>
		</tr>
    
		<tr>
			<th>평점</th>
			<td><?php echo $professors[0]["vote_average"]["total_average"];?></td>
		</tr>
  

	</table>
  <a href="vote.php?professor_id=<?php echo  $professors[0]["id"] ?>">투표하기</a>
</div>
<div class="vote_list">
<?php
  $votes_pagination = paginate_array($professors[0]["vote"], $page, $number_for_page);
  $votes = $votes_pagination["data"];
  $total_page = $votes_pagination["total_page"];


  foreach($votes as $vote){
    $user_model = new Model;
    $user_model->fetch("users", array("name"), "WHERE id={$vote["user_id"]}");
    $user = $user_model->to_array();
    $user_name = $user[0]["name"];

    echo <<<EOT
    <div id="{$vote["id"]}" class="vote_element">
      <div class="user_name">{$user_name}</div>
      <ul class="scores_list">
        <li class="score_element">
          흥미도: {$vote["interest"]}
        </li>

        <li class="score_element">
          호감도: {$vote["hot"]}
        </li>
        <li class="score_element">
          이해도: {$vote["understanding"]}
        </li>
        <li class="score_element">
          얼마나 유익했는가?: {$vote["benefit"]}
        </li>
        <li class="score_element">
          수업준비: {$vote["prepare"]}
        </li>
      </ul>
      
    </div>


EOT;

  }
?>
</div>

<div class="pagiation">
<ul class="page_list">
<?php
  $page_range = page_selection_range($page, $total_page, $max_page_for_each_page);
  $start_index = $page_range["start_index"];
  $last_index = $page_range["last_index"];
  $prev_number = $page_range["prev_number"];
  $next_number = $page_range["next_number"];
      echo <<<EOT
        <li class="prev"><a class="page_link" href="professor.php?id={$professors[0]["id"]}&page={$prev_number}" > << </a></li>
EOT;

    for($i=$start_index; $i < $last_index; $i++){
    $selected="not_selected";
    if($i == $page){
      $selected="selected";
    }
    echo <<<EOT
      <li class="{$selected}"><a class="page_link" href="professor.php?id={$professors[0]["id"]}&page={$i}" >[{$i}]</a></li>
EOT;
  }
    echo <<<EOT
       <li class="{$selected}"><a class="page_link" href="professor.php?id={$professors[0]["id"]}&page={$next_number}" > >> </a></li>
EOT;
?>
</ul>
</div>
<?php
  require_once "beneath.php";
?>
