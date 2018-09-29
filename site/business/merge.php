<?php
//include "include.php";

$rawpic = $_POST['image'];
$image = imagecreatefromstring(base64_decode($rawpic));

$pic_id = htmlentities($_POST['imgSelected'], ENT_QUOTES, "UTF-8");

//$filtre = $dbConnector->getPicture($pic_id);
$img = imagecreatefrompng('../img/Aragon.png');

//imagealphablending() fournit deux modes de dessin des images en vraies couleurs (truecolors)
imagealphablending($img, false);
imagesavealpha($img, true);

imagecopy($image, $img, 10, 10, 0, 0, 100, 100);
ob_start();
imagejpeg($image, null, 100);
$contents = ob_get_contents();
ob_end_clean();
imagedestroy($image);
imagedestroy($img);
$fic=fopen("Toto.png","wb");
fwrite($fic,$contents);
fclose($fic);
echo 'OK';
?>


