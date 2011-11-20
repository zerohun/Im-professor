<script src="embedded_select_box.js" type="text/javascript"></script>
<ul>
<li>
<select name="school"/>
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
  <select name="major" class="major">
    <option value="0">학교를 먼저 선택해 주세요.</option>
  </select>
</li>
</ul>
