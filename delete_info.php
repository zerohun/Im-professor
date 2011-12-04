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
    $info_after_model = new model;
    $info_after_model->fetch("professor_infos", array("major_id", "university_id"), "WHERE professor_id={$professor_id} ORDER BY created_at DESC LIMIT 1");
    $after_info = $info_after_model->to_array();
    $sec_query = "UPDATE professors SET major_id={$after_info[0]["major_id"]}, university_id={$after_info[0]["university_id"]} WHERE id={$professor_id};";
    if(mysql_query($sec_query)){
      redirect_to("professor.php?id={$professor_id}");
    }
    else{
      die(mysql_error());
    } 

  }
  else{
    die(mysql_error());
  }
}

?>
