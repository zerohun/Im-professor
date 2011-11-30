<?php
require_once "config.php";
require_once "upper.php";
require_once "model.php";
require_once "professors.php";

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
      <th>흥미도</th>
      <td><?php echo $professors[0]["vote"]["interest_average"];?></td>
    </tr>

    <tr>
      <th>호감도</th>
      <td><?php echo $professors[0]["vote"]["hot_average"];?></td>
    </tr>

    <tr>
      <th>이해도</th>
      <td><?php echo $professors[0]["vote"]["understanding_average"];?></td>
    </tr>

    <tr>
      <th>얼마나 유익했는가?</th>
      <td><?php echo $professors[0]["vote"]["benefit_average"];?></td>
    </tr>

    <tr>
      <th>수업준비도</th>
      <td><?php echo $professors[0]["vote"]["prepare_average"];?></td>
    </tr>
    
    <tr>
      <th>평점</th>
      <td><?php echo $professors[0]["vote"]["total_average"];?></td>
    </tr>

    <th colspan="2"><?php echo $professors[0]["content"] ?></th>
    </tr>
	</table>
  <a href="vote.php?professor_id=<?php echo  $professors[0]["id"] ?>">투표하기</a>
</div>
<?php
  require_once "beneath.php";
?>
