<?php
class Model{
  var $data;

  function fetch($table, $columns, $options = ""){
    $data = array();


    if(count($columns) == 0){
      throw new Exception('$columns array has to be bigger then 0');
    }
    if(count($columns) == 1){
      $column_string = $columns[0];
    }
    if(count($columns) > 1){
      $column_string = implode(",",$columns);
    }

    $query = "SELECT {$column_string} FROM {$table} {$options};";
    $result = mysql_query($query);
    if($result){
      $count = 0;
      while($row = mysql_fetch_array($result)){
        $data[$count] = array();
        foreach($columns as $column){
          $this->data[$count][$column] = $row[$column];

        }
        $count++;
      }
    }
    else{
      echo "no result";
    }
  }

  function to_json(){
    return json_encode($this->data);
  }

  function to_array(){
    return $this->data;
  }
}
?>
