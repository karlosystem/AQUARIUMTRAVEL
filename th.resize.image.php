<?php

require_once("include/class/thumbnail.inc.php") ;
$nombre = base64_decode($_GET['image']) ; // codificado en base 64
if(is_file($nombre) && file_exists($nombre)) {
$datos = getimagesize($nombre);

$w = (int)$_GET['w'];
$h = (int)$_GET['h'];

if($w==0)$w = 80;
if($h==0)$h = 50;


// $view_watermark = $_GET['watermark'];
$thumb = new Thumbnail($nombre);
//$thumb->crop(100,0,$w,$h);
$thumb->resize($w,$h);
### 
$thumb->show();
}
?>