<?php
  require_once("config.php");
  require_once("model.php");
  require_once("professors.php");
  
  if(isset($_GET["id"])){

    $major_id = $_GET["id"];

    $professor_model = new Professors;
    $professor_model->find_professor_by_major_id($major_id);
    $professors = $professor_model->to_array();
    echo json_encode($professors);
  }
  else{
    die();
  }

?>
