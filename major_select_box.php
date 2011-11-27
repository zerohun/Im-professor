<script src="embedded_select_box.js" type="text/javascript"></script>
<ul>
<li>
학교:
<select name="school"/>
<option id="first_option" value="-1" selected="selected">학교 선택</option>

<?php
	$model = new Model;
	$model->fetch("universities", array("id", "name"));
	$whole_data = $model->to_array();
	foreach($whole_data as $each_data){
		echo "<option value='{$each_data["id"]}'>{$each_data["name"]}</option>";
		echo "<input type = 'hidden' name = 'option_university_value' id = 'option_university_value' value = '{$each_data["id"]}'>"; 	// 학교를 join.php로 보냄
	}
?>
</select>
</li>

<li>
  학과:
  <select name="major" class="major">
    <option value="0">학교를 먼저 선택해 주세요.</option>
  </select>
</li>
</ul>
