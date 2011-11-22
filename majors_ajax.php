<?php
  require_once("config.php");
  require_once("model.php");
  if(isset($_GET)){
    $univ_id = $_GET["id"];
    $option = "WHERE university_id={$univ_id}";
    $model = new Model;
    $model->fetch("majors", array("id", "name"), $option);
    echo $model->to_json();
  }
  else{
    die();
  }
?>
