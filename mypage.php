<?php
require_once "config.php";
require_once "upper.php";
require_once "model.php";

if (isset($_SESSION["name"])){
  echo $_SESSION["name"];
}

else{
  echo "이 페이지는 로그인을 하셔야만 접근할 수 있습니다.";
}

?>

<?php
require_once "beneath.php";
?>
