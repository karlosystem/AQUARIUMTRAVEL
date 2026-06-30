<?php
require_once("init.php");

function msg($status,$txt)
{
	return '{"status":'.$status.',"txt":"'.$txt.'"}';
}

$txt_nombres = $_POST['txt_nombres'];
$txt_telefono = $_POST['txt_telefono'];
$txt_email = $_POST['txt_email'];
$sle_pais = $_POST['sle_pais'];
$txt_mensaje = $_POST['jform_contact_message'];

if(!tep_not_null($txt_nombres))die(msg(0,"Ingrese su nombre completo"));
if(!tep_not_null($txt_telefono))die(msg(0,"Ingrese el numero de Telefono"));
if(!tep_not_null($txt_email))die(msg(0,"Ingrese el correo electronico"));
if(!tep_not_null($sle_pais))die(msg(0,"Ingrese el pais de origen"));
if(!tep_not_null($txt_mensaje))die(msg(0,"Ingrese su mensaje"));


$cls_contacto =  new cls_tbl_contacto();
$cls_contacto->settxt_nombres($txt_nombres);
$cls_contacto->settxt_telefono($txt_telefono);
$cls_contacto->settxt_email($txt_email);
$cls_contacto->settxt_pais($sle_pais);
$cls_contacto->settxt_mensaje($txt_mensaje);
$cls_contacto->setdate_fecha(date("Y-m-d"));


$sendOf = $txt_email ;
$subject  = "Formulario de Contactenos";

$array_mailer[] = array("tpl_nombres",$txt_nombres);
$array_mailer[] = array("tpl_fono",$txt_telefono);
$array_mailer[] = array("tpl_email",$txt_email);
$array_mailer[] = array("tpl_pais",$sle_pais);
$array_mailer[] = array("tpl_dateformat_spanish",fecha_spanish(date("Y-m-d")));
$array_mailer[] = array("tpl_year",date("Y"));
$array_mailer[] = array("tpl_mensaje",$txt_mensaje);
$array_mailer[] = array("tpl_url",_URL);
	
$ReturnInfo = sendCorreo("aquariumtravel@hotmail.com",$sendOf,$subject,$array_mailer,"templates/send_contact.html");

if($ReturnInfo==true || $ReturnInfo==1){
  $cls_contacto->guarda();
  print msg(1,"Su informacion ha sido enviado satisfactoriamente.");
}
else{
  print msg(0,$ReturnInfo);
}

?>