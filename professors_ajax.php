<?php
  require_once("config.php");
  require_once("model.php");
  
  if(isset($_GET)){
    $major_id = $_GET["id"];
    $prof_model = new Model;
    $prof_model->fetch("professors", array("id"));

    $info_model = new Model;
    $info_model->fetch("professor_infos", array("name"), "WHERE major_id={$major_id} ORDER BY created_at DESC LIMIT 1");

    $profs = $prof_model->to_array();
    $infos = $info_model->to_array();
    $combined = array();
    foreach ($profs as $p){
      $combined["id"] = $p["id"];
    }

    foreach ($infos as $i){
      $combined["name"] = $i["name"];
    }
    echo json_encode($combined);
  }
  else{
    die();
  }

?>
