<?php
  require_once "upper.php";
  require_once "config.php";
  require_once "model.php";
  require_once "professors.php";


  if(isset($_GET["id"])){

    $id = $_GET["id"];

    $info_model = new Model;
    $info_model->fetch("professor_infos", array("created_at", "user_id", "major_id", "name", "photo", "content"), "WHERE id={$id} LIMIT 1;");
    $infos = $info_model->to_array();

    $major_model = new Model;
    $major_model->fetch("majors", array("id", "name", "university_id"), "WHERE id={$infos[0]["major_id"]};");
    $majors = $major_model->to_array();
    $university_model = new Model;
    $university_model->fetch("universities", array("id" ,"name"), "WHERE id={$majors[0]["university_id"]};" );

    $universities = $university_model->to_array();

    $user_model = new Model;
    $user_model->fetch("users", array("name"), "WHERE id={$infos[0]["user_id"]}");
    $users = $user_model->to_array();

    echo <<<EOT

    {$users[0]["name"]} 님이 편집한 내용입니다.
    <ul>
      <li>교수명 : {$infos[0]["name"]}</li>
      <li>학교 : {$universities[0]["name"]}</li>
      <li>학과 : {$majors[0]["name"]}</li>
      <li>소개 : {$infos[0]["content"]}</li>
    </ul>
EOT;

  }



  require_once "beneath.php";
?>
