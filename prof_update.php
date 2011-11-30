<?php
require_once "upper.php";
require_once "config.php";

$record_data = array();

$record_data["user_id"] = current_user;
if($_POST["major_id"]){
  $record_data["major_id"] = $_POST["major_id"];
}
if($_POST["name"]){
  $record_data["name"] = $_POST["name"];
}
if($_POST["photo"]){
  $record_data["photo"] = $_POST["photo"];
}
if($_POST["content"]){
  $record_data["content"] = $_POST["content"];
}

foreach($record_data as $key => $value){
  
}
?>

<?php
require_once "beneath.php";
?>
