<?php
require_once("../include/function.php");
require_once("../include/class/thumbnail.inc.php") ;
$nombre = base64_decode($_GET['image']) ; // codificado en base 64

if(is_file($nombre) && file_exists($nombre)) {

$IsCrop = stripslashes_deep($_GET['IsCrop']);


$w = (int)$_GET['w'];
$h = (int)$_GET['h'];

if($w==0)$w = 80;
if($h==0)$h = 50;

$thumb = new Thumbnail($nombre);
if($IsCrop==1)
$thumb->crop(100,100,$w,$h);
else
$thumb->resize($w,$h);

$thumb->show();

}
?>