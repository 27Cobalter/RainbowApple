<?php
$project='../http/RainbowApple/';
$files=scandir($project.'VRChat');
foreach($files as $num => $file){
	if($num<2){
		continue;
	}
	if(file_exists($project.'thumb/'.substr($file, 0, -4).'.png')){
		echo "thumb file is already exists ".$file."\n";
	}else{
		echo 'convert thumb '.$file."\n";
		//元画像のパス
		$baseImagePath = $project.'VRChat/'.$file;
		//サムネイル画像保存先のパス(ファイル名)
		$saveImagePath = $project.'thumb/'.substr($file, 0, -4).'.png';
		//インスタンスを生成
		$image = new Imagick($baseImagePath);
		//サムネイルを生成
		$image->cropThumbnailImage(480, 270);
		//サムネイルを保存
		$image->writeImage($saveImagePath);
	}

	if(file_exists($project.'low/'.substr($file, 0, -4).'.png')){
		echo "low file is already exists ".$file."\n";
		continue;
	}else{
		echo 'convert low '.$file."\n";
		$baseImagePath = $project.'VRChat/'.$file;
		$saveImagePath = $project.'low/'.substr($file, 0, -4).'.png';
		$image = new Imagick($baseImagePath);
		$image->scaleImage(0,540);
		$image->writeImage($saveImagePath);
	}
}
?>
