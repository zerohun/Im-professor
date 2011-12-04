<?php
require_once "common.php";
require_once "config.php";


if(isset($_POST["id"])){
  $id = $_POST["id"];
  $info_model = new model;
  $info_model->fetch("professor_infos", array("professor_id"), "WHERE id='{$id}'");
  $info = $info_model->to_array();
  $professor_id = $info[0]["professor_id"];
  $query = "DELETE FROM professor_infos WHERE id={$id}";
  if(mysql_query($query)){
    redirect_to("professor.php?id={$professor_id}");
  }
  else{
    die(mysql_error());
  }
}

?>
