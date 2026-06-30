<?php 
require_once("../include/class/thumbnail.inc.php");
$nombre = base64_decode($_GET['image']) ; // codificado en base 64

if(is_file($nombre) && file_exists($nombre)) {

$w = (int)$_GET['w'];
$h = (int)$_GET['h'];
$IsCrop = (int)$_GET['crop'];
$IsWM = (int)$_GET['watermark'];

if($w==0)$w = 90;
if($h==0)$h = 68;

// $view_watermark = $_GET['watermark'];
$thumb = new Thumbnail($nombre);
if($IsCrop==1)
$thumb->crop(100,100,$w,$h);
else
$thumb->resize($w,$h);
### 
if($IsWM==1)
$thumb->watermark(IMAGE_NAME_WATERMARK);

$thumb->show();
}
?>