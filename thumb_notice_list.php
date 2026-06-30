<?php
require_once("include/function.php");
require_once("include/class/thumbnail.inc.php") ;

$nombre = base64_decode($_GET['image']) ; // codificado en base 64

if(tep_not_null($nombre) && is_file($nombre)) {

//if(is_file($nombre) && file_exists($nombre)) {
$datos = getimagesize($nombre);
$w = (int)$_GET['w'];
$h = (int)$_GET['h'];


// $view_watermark = $_GET['watermark'];
$thumb = new Thumbnail($nombre);
//$thumb->crop(100,50,$w,$h);
$thumb->resize($w,$h);
### 
//$thumb->watermark("fotos/pin.png");
$thumb->show();
//}

}
?>
