<?php
ini_set('display_errors', false); 
//error_reporting(0);
session_start();
if (isset ( $_SESSION['user_id'])) {
 $current_user = $_SESSION['user_id'];
 $loggedin = TRUE;
} 
else {
 $loggedin = FALSE;
}

function escape_str($str) 
{
  $new_str = strip_tags($str);
  return mysql_real_escape_string($new_str);
}

function paginate_array($array_data, $page_number, $number_for_page){
  $array_length = count($array_data);
  $current_index = $page_number * $number_for_page;
  $new_array_data = array();
  $last_index = $current_index + $number_for_page;
  if($last_index > $array_length){
    $last_index = $array_length;
  }
  for($i=$current_index; $i < $last_index; $i++){
    $new_array_data[] = $array_data[$i];
  }
  $total_page = floor($array_length / $number_for_page);
  return array("data" => $new_array_data, "total_page" => $total_page);
}

function page_selection_range($page_number, $total_page, $number_for_each_page){
  $start_index = $page_number - ($page_number % $number_for_each_page);
  $last_index = $start_index + $number_for_each_page;
  if($last_index > $total_page){
    $last_index = $total_page;
  }
  $page_select_array = array();
  for($i = $start_index; $i < $last_index; $i++){
    $page_select_array[] = $i;
  }

  if($page_number == 0){
    $prev_number = 0;
  }
  else{
    if($start_index > $number_for_each_page-1){
      $prev_number = $start_index - 1;
    }
    else{
      $prev_number = 0;
    }
  }


  if($last_index == $total_page ){
    if($total_page == 0){
      $next_number = 0;
    }
    else{
      $next_number = $last_index - 1;
    }
  }
  else{
    if($page_number + $number_for_each_page > $total_page){
      $next_number = $total_page - 1;
    }
    else{
      $next_number = $last_index; 
    }
    
  }
  
  return array("start_index" => $start_index, "last_index" => $last_index, "prev_number" => $prev_number, "next_number" => $next_number);
}

function redirect_to($url){
    echo "<script type='text/javascript'>window.location='{$url}';</script>";
}

?>
