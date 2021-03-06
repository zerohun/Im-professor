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
  $start_index = $p_range["start_index"];
  $last_index = $p_range["last_index"];
  $prev_number = $p_range["prev_number"];
  $next_number = $p_range["next_number"];

  $selected ="";

  foreach($infos as $key => $info){

    echo <<<EOT
      <div class="history">
        <a href="professor_info.php?id={$info["id"]}">{$info["created_at"]} by {$info["user_name"]}</a>

EOT;

    if($key == 0 && count($infos) > 1){
      echo <<<EOT
        <form method="post" action="delete_info.php">
          <input type="hidden" name="id" value="{$info["id"]}">
          <input type="submit" value="Undo">
        </form>
      </div> 

EOT;

    }
  }
    echo <<<EOT
        <ul class="page_list">
        <li class="prev"><a class="page_list" href="professor_infos.php?professor_id={$professor_id}&page={$prev_number}" > << </a></li>
EOT;
    for($i=$start_index; $i < $last_index; $i++){
      $selected="not_selected";
      if($i == $page_number){
        $selected="selected";
      }
      echo <<<EOT
         <li class="{$selected}"><a class="page_list" href="professor_infos.php?professor_id={$professor_id}&page={$i}" >[{$i}]</a></li>
EOT;
    }
      echo <<<EOT
         <li class="next"><a class="page_list" href="professor_infos.php?professor_id={$professor_id}&page={$next_number}" > >> </a></li>
      </ul>
EOT;
}

?>




<?php
require_once "beneath.php"
?>
