<?php
@ob_start();
@session_start();

require_once("../init.php");
require_once("loadclass.php");

$UserLoadTemp = new cls_tbl_administrador();

$InfoUser = $UserLoadTemp->fetch_user_info($_SESSION[COOKIE_NAME]);
$CUser = (int)$InfoUser['pk_usuario'];

$UserLoad = new cls_tbl_administrador($CUser);

if(!$UserLoad->is_user_logged_in())
header("Location: index.php");


$id= (int)(tep_not_null($_GET['id']))?$_GET['id']:$_POST['id'];
$op= (int)(tep_not_null($_GET['op']))?$_GET['op']:$_POST['op'];


$cnt_reservas = new cls_tbl_reservas($id);

$cnt_reservas->settxt_reservaname($_POST['get_txtname']);
$cnt_reservas->settxt_reservaape($_POST['get_txtape']);
$cnt_reservas->setpais($_POST['get_txtpais']);
$cnt_reservas->settxt_email($_POST['get_txtemail']);
$cnt_reservas->settxt_cantidad_adultos($_POST['get_txtcantidad_adultas']);
$cnt_reservas->settxt_cantidad_ninos($_POST['get_txtcantidad_ninos']);
$cnt_reservas->settxt_telefono($_POST['get_txtfono']);
$cnt_reservas->setfk_destino($_POST['getfk_destino']);

$thisdateviaje = stripslashes_deep($_POST['getdate_viaje_salida']);
if(tep_not_null($thisdateviaje) && $thisdateviaje!='00-00-0000')
$thisdateviaje = Date::convert($thisdateviaje,'Y-m-d','Y-m-d');
$cnt_reservas->settxt_fecha_salida($thisdateviaje);#fecha de la noticia
/********************************/
$thisdateviaje02 = stripslashes_deep($_POST['getdate_viaje_retorno']);
if(tep_not_null($thisdateviaje02) && $thisdateviaje02!='00-00-0000')
$thisdateviaje02 = Date::convert($thisdateviaje02,'Y-m-d','Y-m-d');
$cnt_reservas->settxt_fecha_retorno($thisdateviaje02);#fecha de la noticia


$cnt_reservas->settxt_comentario($_POST['txt_comentario']);

$cnt_reservas->settxt_nota($_POST['txt_nota']);
$cnt_reservas->settxt_vendedor($_POST['get_vendedor']);
$cnt_reservas->settxt_reserva($_POST['get_txtreserva']);
$cnt_reservas->settxt_tipo($_POST['get_tipo']);
$cnt_reservas->setfk_estado($_POST['getfk_estado']);

$thisdatenotice = stripslashes_deep($_POST['getdate_llamar']);
if(tep_not_null($thisdatenotice) && $thisdatenotice!='00-00-0000')
$thisdatenotice = Date::convert($thisdatenotice,'Y-m-d','Y-m-d');

$cnt_reservas->settxt_fecha_llamar($thisdatenotice);#fecha de la noticia



$cnt_reservas->setdate_fecha($_POST['txt_date']);

switch($op)
{
	case 1:	//guardar
			$cnt_reservas->guarda();
			$idsec=$cnt_reservas->getpk_reserva();
	break;
	case 2://Actualizar	
			$cnt_reservas->setpk_reserva($id);	
			$sorteo_borrar= new cls_tbl_reservas($id);															
			$cnt_reservas->actualiza();

	break;
	case 3://Eliminar	
			$cnt_reservas = new cls_tbl_reservas($id);
			$cnt_reservas->elimina();					
					
	break;
	case 4://Estado	
			$cnt_reservas = new cls_tbl_reservas($id);
			@$cnt_reservas->estado();					
	break;
	
	case 5://Activar check
	if(!empty($_POST["chkreserva"]))
	{	
		foreach($_POST["chkreserva"] as $valor)
		{		if($_POST["chkreserva"])
				{	$sorteo = new cls_tbl_reservas($valor);
					@$sorteo->estado("1");				
				}
		}		// foreach
	}
	break;
	
	case 6://Desactivar check
	if(!empty($_POST["chkreserva"]))
	{	
		foreach($_POST["chkreserva"] as $id=>$valor)
		{		if($_POST["chkreserva"])
				{	$sorteo = new cls_tbl_reservas($valor);
					@$sorteo->estado("0");				
				}
		}		// foreach
	}
	break;
	
	case 7: //Remover check
	if(!empty($_POST["chkreserva"]))
	{	
		foreach($_POST["chkreserva"] as $id=>$valor)
		{		if($_POST["chkreserva"])
				{	$sorteo = new cls_tbl_reservas($valor);
					$sorteo->elimina();				
				}
		}		// foreach
	}
	break;
}


if(($op==1) || ($op==2) || ($op==3) ||  ($op==5) ||   ($op==6) ||  ($op==7) )
{	header ("location: inf_reservas.php"); 	}
else if($op!=4)
{	unset($_SESSION['webuser']);
	header ("location: index.php"); }
	
	
?>