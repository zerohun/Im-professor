<?php

require_once "model.php";
class Professors{
  var $professors;
  var $infos;

  function find_professor_by_major_id($id){
    $professors_model = new Model;
    $professors_model->fetch("professors", array("id"), "WHERE major_id='{$id}'");
    $this->professors = $professors_model->to_array();
    $infos_model = new Model;



    for($i=0; $i<count($this->professors); $i++){

      $infos_model->fetch("professor_infos", array("id", "name", "photo", "content"), "WHERE professor_id='{$this->professors[$i]["id"]}' ORDER BY created_at DESC LIMIT 1");
      $infos = $infos_model->to_array();
      $this->professors[$i]["name"] = $infos[0]["name"]; 
      $this->professors[$i]["photo"] = $infos[0]["photo"]; 
      $this->professors[$i]["content"] = $infos[0]["content"]; 

    }
  }
  function to_array(){
    return $this->professors;
  }

}
?>
