<?php
session_start();
require_once "config.php";
require_once "common.php";
require_once "model.php";

$user_id = $current_user;
if($_POST["major_id"]){
  $major_id = $_POST["major_id"];
  
}
if($_POST["name"]){
  $name = $_POST["name"];
}
if($_POST["content"]){
  $content = $_POST["content"];
}
if($_POST["professor_id"]){
  $professor_id = $_POST["professor_id"];
}



$major_model = new Model;
$major_model->fetch("majors", array("university_id"), "WHERE id={$major_id}");
$majors = $major_model->to_array();

$university_id = $majors[0]["university_id"];
$sql_query = "INSERT INTO professor_infos(university_id, professor_id, user_id, major_id, name,  content) VALUES({$university_id}, {$professor_id} ,{$user_id},{$major_id},\"{$name}\",\"{$content}\");";
$sql_query_2 = "UPDATE professors set major_id={$major_id} WHERE id={$professor_id};";
$sql_query_3 = "UPDATE professors set university_id={$university_id} WHERE id={$professor_id};";

echo $sql_query, $sql_query_2, $sql_query_3;


if(mysql_query($sql_query)){
  redirect_to("professor.php?id={$professor_id}");
}
else{
  die("sql error");
}

?>

