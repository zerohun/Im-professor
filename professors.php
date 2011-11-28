<?php

require_once "model.php";
class Professors{
  var $professors;
  var $infos;

  function find_professor_by_major_id($id){
    $professors_model = new Model;
    $professors_model->fetch("professors", array("id"), "WHERE major_id='{$id}'");
    $professors = $professors_model->to_array();
    $infos_model = new Model;



    foreach($professors as $professor){
      echo "professor id is   {$professor["id"]}";
      $infos_model->fetch("professor_infos", array("name", "photo", "content"), "WHERE professor_id='{$professor["id"]}' ORDER BY created_at DESC LIMIT 1");
      $infos = $infos_model->to_array();
      $professor["name"] = $infos[0]["name"]; 
      $professor["photo"] = $infos[0]["photo"]; 
      $professor["content"] = $infos[0]["content"]; 

    }
  }
  function to_array(){
    return $this->professors;
  }

}
?>
