<?php
@ob_start();
@session_start();

require_once("init.php");

require_once("include/class/cls_tbl_reservas.php");

function msg($status,$txt)
{
	return '{"status":'.$status.',"txt":"'.$txt.'"}';
}

$get_name = $_POST['txt_nombres'];
$get_apellido = $_POST['txt_apellidos'];
$get_mail = $_POST['txt_email'];
$get_direccion = $_POST['txt_direccion'];
$get_fono = $_POST['txt_telefono'];
$get_celular = $_POST['txt_celular'];
$get_hoteles = $_POST['txt_hoteles'];
$get_cantidad_adultos = $_POST['txt_cantidad_adultos'];
$get_cantidad_ninos = $_POST['txt_cantidad_ninos'];
$get_comment = $_POST['txt_mensaje'];
$get_captcha = $_POST['get_captcha'];
$sle_pais = $_POST['sle_pais'];
$sle_destino = $_POST['sle_destino'];


$get_fecha_salida = stripslashes_deep($_POST['txt_fecha_salida']); 
if(tep_not_null($get_fecha_salida) && $get_fecha_salida!="00-00-0000") {
$temp_datenac  = explode("-",$get_fecha_salida) ;
$get_fecha_salida = $temp_datenac[2]."-".$temp_datenac[1]."-".$temp_datenac[0] ;# Y-m-d MySQL
}

$get_fecha_retorno = stripslashes_deep($_POST['txt_fecha_retorno']); 
if(tep_not_null($get_fecha_retorno) && $get_fecha_retorno!="00-00-0000") {
$temp_datenac  = explode("-",$get_fecha_retorno) ;
$get_fecha_retorno = $temp_datenac[2]."-".$temp_datenac[1]."-".$temp_datenac[0] ;# Y-m-d MySQL
}


	if(!tep_not_null($get_name))die(msg(0,"Ingrese su nombre completo"));
	  if(!tep_not_null($get_apellido))die(msg(0,"Ingrese su apellido completo"));	   
				    if(!is_email_address($get_mail))die(msg(0,"Ingrese un e-mail valido"));
						 if(!tep_not_null($get_cantidad_adultos))die(msg(0,"Ingrese la cantidad de personas adultas"));
							  if(!tep_not_null($get_comment))die(msg(0,"Ingrese algun mensaje adicional"));						 
								  if(!tep_not_null($get_captcha))die(msg(0,"Ingrese el código de seguridad"));
									if(!tep_not_null($get_fecha_salida))die(msg(0,"Ingrese la fecha de salida, click en el icono del calendario"));
									  if(strtoupper($_SESSION['turing_string']) != strtoupper($get_captcha))die(msg(0,"Codigo invalido"));
						  
	
	$cls_reservas = new cls_tbl_reservas();
	$cls_reservas->settxt_reservaname($get_name);
	$cls_reservas->settxt_reservaape($get_apellido);
	$cls_reservas->settxt_email($get_mail);
	$cls_reservas->settxt_direccion($get_direccion);
	$cls_reservas->setpais($sle_pais);
	$cls_reservas->setfk_destino($sle_destino);
	$cls_reservas->settxt_cantidad_adultos($get_cantidad_adultos);	
	$cls_reservas->settxt_cantidad_ninos($get_cantidad_ninos);	
	$cls_reservas->settxt_fecha_salida($get_fecha_salida);
	$cls_reservas->settxt_telefono($get_fono);
	$cls_reservas->settxt_celular($get_celular);
	$cls_reservas->settxt_hoteles($get_hoteles);
	$cls_reservas->setfk_estado(1);
    $cls_reservas->settxt_comentario($get_comment);
	$cls_reservas->setdate_fecha(date("Y-m-d H:i:s"));
	
	
	$sendOf = $get_mail ;
	$subject  = "Formulario de Reservas";
	
	$cls_paquete = new cls_tbl_paquete($sle_destino);
	$ArrayNamePaq = $cls_paquete->get_infolang_pack(2);
	
	$array_mailer[] = array("tpl_nombres",$get_name);
	$array_mailer[] = array("tpl_apellidos",$get_apellido);
	$array_mailer[] = array("tpl_direccion",$get_direccion);
	$array_mailer[] = array("tpl_pais",$sle_pais);
	$array_mailer[] = array("tpl_destino",$ArrayNamePaq[0]['title']);
	$array_mailer[] = array("tpl_cantidad",$get_cantidad_adultos);
	$array_mailer[] = array("tpl_ninos",$get_cantidad_ninos);
	$array_mailer[] = array("tpl_fecha",$get_fecha_salida);
	$array_mailer[] = array("tpl_fecha_retorno",$get_fecha_retorno);
	$array_mailer[] = array("tpl_telefono",$get_fono);
	$array_mailer[] = array("tpl_celular",$get_celular);
	$array_mailer[] = array("tpl_email",$get_mail);
	$array_mailer[] = array("tpl_hoteles",$get_hoteles);
	$array_mailer[] = array("tpl_dateformat_spanish",fecha_spanish(date("Y-m-d : hh:mm:ss")));
	$array_mailer[] = array("tpl_year",date("Y"));	
	$array_mailer[] = array("tpl_anotacion",$get_comment);
	$array_mailer[] = array("tpl_url",_URL);
	
	$ReturnInfo = sendEmail("aquariumtravel@hotmail.com",$sendOf,$subject,$array_mailer,"templates/tpl_reservas.html");
	
	if($ReturnInfo==true || $ReturnInfo==1){
	 $cls_reservas->guarda();
	 	$ReturnAuto = sendEmail($sendOf,"noresponder@aquariumtravel.com.pe",$subject,$array_mailer,"templates/send_autoresponder.html");
		if($ReturnAuto==true || $ReturnAuto==1){
	 		print msg(1,"Su informacion ha sido enviado satisfactoriamente.");
		}		
	}else{
	 print msg(0,$ReturnInfo);
	}
	
?>