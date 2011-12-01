<?php

require_once "model.php";

function compare_by_average($p1, $p2){
    $p1_score = $p1["vote"]["total_average"];
    $p2_score = $p2["vote"]["total_average"];
    if($p1_score > $p2_score){
      return 1;
    }
    if($p1_score < $p2_score){
      return -1;
    }
    if($p1_score == $p2_score){
      return 0;
    }
  }


class Professors{
  var $professors;
  var $infos;

  function find_by_id($id){
    $professors_model = new Model;
    $professors_model->fetch("professors", array("id"), "WHERE id='{$id}'");
    $this->professors = $professors_model->to_array();
    $infos_model = new Model;
    $infos_model->fetch("professor_infos", array("id", "university_id", "major_id","name", "photo", "content"), "WHERE professor_id='{$this->professors[0]["id"]}' ORDER BY created_at DESC LIMIT 1");
    $infos = $infos_model->to_array();
    $this->professors[0]["name"] = $infos[0]["name"]; 
    $this->professors[0]["photo"] = $infos[0]["photo"]; 
    $this->professors[0]["content"] = $infos[0]["content"]; 
    $this->professors[0]["major_id"] = $infos[0]["major_id"];   
	$this->professors[0]["university_id"] = $infos[0]["university_id"]; 

  }

  function find_by_id_with_infos_join_users($id){
    $professors_model = new Model;
    $professors_model->fetch("professors", array("id"), "WHERE major_id='{$id}'");
    $this->professors = $professors_model->to_array();
    $infos_model = new Model;
    $infos_model->fetch("professor_infos, users", array("professor_infos.id", "professor_infos.major_id","professor_infos.name", "professor_infos.photo", "professor_infos.content", "professor_infos.created_at",  "users.name"), "WHERE professor_infos.professor_id='{$this->professors[0]["id"]}' ORDER BY created_at DESC");
    $this->professors["infos"] = $infos_model->to_array();
  }

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

  function find_professor_by_university_id($id){
    $professors_model = new Model;
    $professors_model->fetch("professors", array("id"), "WHERE university_id='{$id}'");
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

  function fetch_vote_list(){
    $votes_model = new Model;
    foreach($this->professors as $key => $professsor){
      $votes_model->fetch("votes", array("id", "created_at", "user_id", 
                          "prepare", "understanding", "interest", "benefit", "hot", "comment_text"), 
                          "WHERE professor_id={$professsor["id"]} ORDER BY created_at DESC");

      $this->professors[$key]["vote"] = $votes_model->to_array();
      $votes =  $votes_model->to_array();

      $total = 0;
      $prepare_total = 0;
      $understanding_total = 0;
      $interest_total = 0;
      $benefit_total = 0;
      $hot_total = 0;

      foreach($votes as $vote){ 
        $total += $vote["prepare"];
        $prepare_total += $vote["prepare"];
        $total += $vote["understanding"];
        $understanding_total += $vote["understanding"];
        $total += $vote["interest"];
        $interest_total +=  $vote["interest"];
        $total += $vote["benefit"];
        $benefit_total += $vote["benefit"];
        $total += $vote["hot"];
        $hot_total += $vote["hot"];

      }
      $num_to_devide = count($votes) * 5;
      $this->professors[$key]["vote_average"] = array();

      $this->professors[$key]["vote_average"]["total_average"] = $total/$num_to_devide;
      $this->professors[$key]["vote_average"]["prepare_average"] = $prepare_total/ count($votes);
      $this->professors[$key]["vote_average"]["understanding_average"] = $understanding_total/ count($votes);
      $this->professors[$key]["vote_average"]["interest_average"] = $interest_total/ count($votes);
      $this->professors[$key]["vote_average"]["benefit_average"] = $benefit_total/ count($votes);
      $this->professors[$key]["vote_average"]["hot_average"] = $hot_total/ count($votes);
    }
    usort($this->professors, "compare_by_average");
  }
}
?>
