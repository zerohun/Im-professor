<?php
session_start();
require_once "config.php";
require_once "common.php";

$user_id = $current_user;
if($_POST["major_id"]){
  $major_id = $_POST["major_id"];
  
}
if($_POST["name"]){
  $name = $_POST["name"];
}
if($_POST["photo"]){
  $photo = $_POST["photo"];
}
else{
  $photo = "";
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


$majors = $major_model->to_array();


$sql_query = "INSERT INTO professor_infos(professor_id, user_id, major_id, name, photo, content) VALUES({$professor_id},{$user_id},{$major_id},\"{$name}\",\"{$photo}\",\"{$content}\");";
$sql_query += "UPDATE professors set major_id={$major_id} where professor_id={$professor_id};";
$sql_query += "UPDATE professors set university_id={$university_id} where professor_id={$professor_id};";

if(mysql_query($sql_query)){
  
}
else{
  die("sql error");
}

?>

