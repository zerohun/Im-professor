<?php
session_start();
require_once "config.php";
require_once "common.php";
require_once "model.php";

$user_id = $current_user;
if($_POST["major_id"]){
  $major_id = escape_str($_POST["major_id"]);
  
}
if($_POST["name"]){
  $name = escape_str($_POST["name"]);
}
if($_POST["content"]){
  $content = escape_str($_POST["content"]);
}
if($_POST["professor_id"]){
  $professor_id = escape_str($_POST["professor_id"]);
}



$major_model = new Model;
$major_model->fetch("majors", array("university_id"), "WHERE id={$major_id}");
$majors = $major_model->to_array();

$university_id = $majors[0]["university_id"];
$sql_query_list = array();
$sql_query_list[] = "INSERT INTO professor_infos(university_id, professor_id, user_id, major_id, name,  content) VALUES({$university_id}, {$professor_id} ,{$user_id},{$major_id},\"{$name}\",\"{$content}\");";
$sql_query_list[] = "\nUPDATE professors SET major_id={$major_id} WHERE id={$professor_id};";
$sql_query_list[] = "\nUPDATE professors SET university_id={$university_id} WHERE id={$professor_id};";

//$sql_query = join("", $sql_query_list);

if(mysql_query($sql_query_list[0])){
  if(mysql_query($sql_query_list[1])){
    if(mysql_query($sql_query_list[2])){

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
else{
  echo "<strong>$sql_query</strong>";
  echo "<br />";


  die(mysql_error());
}

?>

