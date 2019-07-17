<?php
print("call php\n");
$project='../';
$files=scandir($project.'src', 1);

if($argc < 2){
  exit("Usage: generate_simple.php <filename>\n");
}
$file = basename($argv[1]);
print "$file\n";

//元画像のパス
$srcImagePath = $project.'src/'.$file;
//サムネイル画像保存先のパス(ファイル名)

$file = substr($file, 0, -3).'png';
$highImagePath = $project.'simple/High/'.$file;
$midImagePath = $project.'simple/Mid/'.$file;
$lowImagePath = $project.'simple/Low/'.$file;

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

$image->writeImage($highImagePath);

$image->resizeImage(1024, 512, Imagick::FILTER_LANCZOS, 0);

$image->writeImage($midImagePath);

$image->resizeImage(480, 270, Imagick::FILTER_LANCZOS, 0);
$image->writeImage($lowImagePath);
?>
