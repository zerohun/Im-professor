<?php
require_once "common.php";
require_once "config.php";
require_once "upper.php";
require_once "model.php";
require_once "professors.php";
$page_number = 0;
$number_for_page = 10;
$number_for_each_page = 10;
if(isset($_GET["page"])){
  $page_number = (int)$_GET["page"];
}

if(isset($_GET["professor_id"])){
  $professor_id = $_GET["professor_id"];
  $professors_model = new Professors;
  $professors_model->find_by_id_with_infos_join_users($professor_id);
  $professors = $professors_model->to_array();
  $infos_pagination = paginate_array($professors[0]["infos"], $page_number, $number_for_page);
  $infos = $infos_pagination["data"];
  $total_page = $infos_pagination["total_page"];
  $p_range = page_selection_range($page_number, $total_page, $number_for_each_page);

  foreach($infos as $info){
    echo <<<EOT
      <div class="history">
        <a href="professors_info.php?id={$info["id"]}">{$info["created_at"]} by {$info["user_name"]}</a>
      </div>
      
EOT;
  }
}

?>




<?php
require_once "beneath.php"
?>
