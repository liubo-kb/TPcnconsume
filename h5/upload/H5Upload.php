<?php
	$content = $_POST['content'];
	$content = base64_decode($content);
	
	$fileName = $_POST['filename'];
	$fileType = ".png";
    $dir = "../../Public/Uploads/headImage/";
	$image = fopen($dir.$fileName.$fileType,"w");
	if( fwrite($image,$content) == true )
	{
		echo "upload access";
	}
	else
	{
		echo "upload fail";
	}
?>