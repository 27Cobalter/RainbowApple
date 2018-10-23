<?php
$project='../http/RainbowApple/';
$files=scandir($project.'VRChat');
foreach($files as $num => $file){
	if($num<2){
		continue;
	}
	if(file_exists($project.'thumb/'.$file)){
		echo "thumbファイルが存在します ".$file."\n";
	}else{
		echo 'convert thumb '.$file."\n";
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

	if(file_exists($project.'low/'.$file)){
		echo "lowファイルが存在します ".$file."\n";
		continue;
	}else{
		echo 'convert low '.$file."\n";
		$baceImagePath = $project.'VRChat/'.$file;
		$saveImagePath = $project.'low/'.$file;
		$image = new Imagick($baceImagePath);
		$image->scaleImage(0,540);
		$image->writeImage($saveImagePath);
	}
}
?>
