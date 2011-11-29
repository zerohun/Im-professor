<?php
require_once "upper.php";

if(isset($_GET) && $_GET["id"]){
  $professor_id = $_GET["id"];

  $infomodel = new Model;
  $infomodel->fetch("professor_infos", array("name", "major_id", "content"), "WHERE professor_id = {$professor_id} ");
  $infos = $infomodel->to_array();

  $major_model = new Model;
  $major_model->fetch("majors", array("university_id", "name"), "WHERE id = {$infos[0]["major_id"]}");
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
			<td><?php echo $infos[0]["name"];?></td>
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
    <th colspan="2"><?php echo $infos[0]["content"] ?></th>
    </tr>
	</table>
	<input type="button" name="vote" value="투표하기">
</div>
<?php
  require_once "beneath.php";
?>
