<?php
require_once("include/function.php");
require_once("include/class/thumbnail.inc.php") ;
$nombre = base64_decode($_GET['image']) ; // codificado en base 64

if(is_file($nombre) && file_exists($nombre)) {
$datos = getimagesize($nombre);

$IsCrop = stripslashes_deep($_GET['IsCrop']);

$w = (int)$_GET['w'];
$h = (int)$_GET['h'];

if($w==0)$w = 170;
if($h==0)$h = 120;


// $view_watermark = $_GET['watermark'];
$thumb = new Thumbnail($nombre);
if($IsCrop==1)
$thumb->crop(100,100,$w,$h);
else
$thumb->resize($w,$h);

### 
//$thumb->watermark("fotos/pin.png");
$thumb->show();
}
?>