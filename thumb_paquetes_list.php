<?php
require_once("include/constants.php");
require_once("include/class/thumbnail.inc.php");
require_once("include/function.php");

if(_SEOMOD==0){
	$nombre = base64_decode($_GET['image']) ; // codificado en base 64
}else{
	$nombre = $_GET['image'];
}

if(is_file($nombre) && file_exists($nombre)) {
$datos = getimagesize($nombre);

$IsCrop = SecureGet($_GET['IsCrop']);

$w = (int)$_GET['w'];
$h = (int)$_GET['h'];


if($w==0)$w = 80;
if($h==0)$h = 50;


$thumb = new Thumbnail($nombre);
if($IsCrop==1)
#$thumb->crop(100,100,$w,$h);
else
$thumb->resize($w,$h);
$thumb->show();

}
?>