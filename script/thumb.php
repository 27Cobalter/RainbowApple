<?php
$project='../http/RainbowApple/';
$files=scandir($project.'VRChat');
foreach($files as $num => $file){
	if($num<2){
		continue;
	}
	if(file_exists($project.'thumb/'.$file)){
		echo "ファイルが存在します ".$file."\n";
		continue;
	}
	echo 'convert '.$file."\n";
	//元画像のパス
	$baceImagePath = $project.'VRChat/'.$file;
	//サムネイル画像保存先のパス(ファイル名)
	$saveImagePath = $project.'thumb/'.$file;
	//インスタンスを生成
	$image = new Imagick($baceImagePath);
	//サムネイルを生成
	$image->cropThumbnailImage(480, 270);
	//サムネイルを保存
	$image->writeImage($saveImagePath);
}
?>
