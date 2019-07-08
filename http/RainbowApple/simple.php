<?php
  $files = scandir("./Simple/Low");
  if(isset($_GET['num'])){
    $num = $_GET['num'];
    if(count($files)-3 < $num){
      // header("Location: ./static/dummy.png");
      http_response_code(404);
      return;
    }else if($num < 0){
      // header("Location: ./static/dummy.png");
      http_response_code(404);
      return;
    }
  }else{
    $num = 0;
  }

  $qt = 0;
  if(isset($_GET['qt'])){
    $qt = $_GET['qt'];
    if($qt > 2){
      $qt = 2;
    } else if ($qt < 0){
      $qt = 0;
    }
  }
  $tag = ["Simple/Low", "Simple/Mid", "Simple/High"];
  header("Location: ./".$tag[$qt]."/".$files[count($files)-$num-1]);
?>
