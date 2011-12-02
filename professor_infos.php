<?php
require_once "common.php";
require_once "config.php";
require_once "upper.php";
require_once "model.php";

if(isset($_GET["professor_id"])){
  $professor_id = $_GET["professor_id"];
  $professors_model = new Professors;
  $professors_model->find_by_id($professor_id);
  $professors = $professors_model->to_array();
  $infos = $professors[0]["infos"];


  foreach($infos as $info){
    
  }
}

?>




<?php
require_once "beneath.php"
?>
