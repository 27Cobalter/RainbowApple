<?php
$project='../';
$files=scandir($project.'src', 1);

foreach($files as $num => $file){
  if($file == ".."){
  	return;
  }
  //元画像のパス
  $srcImagePath = $project.'src/'.$file;
  //サムネイル画像保存先のパス(ファイル名)

  $file = substr($file, 0, -3).'png';
  $highImagePath = $project.'simple/High/'.$file;
  $midImagePath = $project.'simple/Mid/'.$file;
  $lowImagePath = $project.'simple/Low/'.$file;

  if(file_exists($highImagePath) && file_exists($midImagePath) && file_exists($lowImagePath)){
    print("All file Exists ".$file."\n");
    continue;
  }

  echo 'convert '.$file." to ".$file."\n";

  $image = new Imagick($srcImagePath);
  $d = $image->getImageGeometry();
  if($d['width']*9 < $d['height']*16){
    print("not 16:9\n");
    $image->cropThumbnailImage($d['width'], ceil($d['width']*9/16));
  }

  // 時間を入れる
  $string = substr($file, 17, 4)."/".substr($file, 22, 2)."/".substr($file, 25, 2)." ".substr($file, 28, 2).":".substr($file, 31, 2);
  $draw = new ImagickDraw();
  $draw->setFont("../font/timemachine-wa.ttf");
  $draw->setFontSize(round($d['width']/18));
  $draw->setGravity(imagick::GRAVITY_SOUTHEAST);
  $draw->setFillColor("rgba(255, 0, 0)");
  $draw->annotation(0, 0, $string);

  $image->drawImage($draw);

  if(!file_exists($highImagePath)){
    $image->writeImage($highImagePath);
  }

  $image->resizeImage(1024, 512, Imagick::FILTER_LANCZOS, 0);

  if(!file_exists($midImagePath)){
    $image->writeImage($midImagePath);
  }

  if(!file_exists($lowImagePath)){
    $image->resizeImage(480, 270, Imagick::FILTER_LANCZOS, 0);
    $image->writeImage($lowImagePath);
  }

}
?>
