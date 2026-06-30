<?php
@ob_start();
@session_start();

require_once("../init.php") ;
require_once("loadclass.php") ;
require_once("../include/class/resize.php");

$UserLoadTemp = new cls_tbl_administrador();

$InfoUser = $UserLoadTemp->fetch_user_info($_SESSION[COOKIE_NAME]);
$CUser = (int)$InfoUser['pk_usuario'];

$UserLoad = new cls_tbl_administrador($CUser);

if(!$UserLoad->is_user_logged_in())
header("Location: index.php");

$id= (int)(tep_not_null($_GET['id']))?$_GET['id']:$_POST['id'];
$op= (int)(tep_not_null($_GET['op']))?$_GET['op']:$_POST['op'];

$idphoto = (int)(tep_not_null($_GET['idphoto']))?$_GET['idphoto']:$_POST['idphoto'];

$tipoCambio2 = (float)$_GET['tipoCambio2'];

#Insertamos en la BD 
$newfechasta = $_POST['txt_hasta'];
if(tep_not_null($newfechasta) && $newfechasta!="00/00/0000") {
$temp_datehasta  = explode("/",$newfechasta) ;
$newfechasta = $temp_datehasta[2]."-".$temp_datehasta[1]."-".$temp_datehasta[0] ;# Y-m-d MySQL
}

$newfecdesde = $_POST['txt_desde'];
if(tep_not_null($newfecdesde) && $newfecdesde!="00/00/0000") {
$temp_datedesde  = explode("/",$newfecdesde) ;
$newfecdesde = $temp_datedesde[2]."-".$temp_datedesde[1]."-".$temp_datedesde[0] ;# Y-m-d MySQL
}


$newfecpaquete = $_POST['txt_datepublicacion'];
if(tep_not_null($newfecpaquete) && $newfecpaquete!="00/00/0000") {
$temp_datepaquete  = explode("/",$newfecpaquete) ;
$newfecpaquete = $temp_datepaquete[2]."-".$temp_datepaquete[1]."-".$temp_datepaquete[0] ;# Y-m-d MySQL
}


$class_paquete = new cls_tbl_paquete($id);
$class_paquete->settxt_datepaquete($newfecpaquete);
$class_paquete->setfk_categoria((int)$_POST['sle_category']);
$class_paquete->setfk_destino((int)$_POST['sle_destino']);
$class_paquete->setfk_aeropuerto((int)$_POST['sle_aeropuerto']);
$class_paquete->settxt_youtube(secure_sql($_POST['txt_youtube_link']));
$class_paquete->setint_status((int)($_POST['chk_status']));
$class_paquete->settxt_dateadd(date("Y-m-d"));
$class_paquete->settxt_dateupdate(date("Y-m-d"));
$class_paquete->settxt_datefrom($newfecdesde);
$class_paquete->settxt_dateto($newfechasta);
$class_paquete->setint_countdias((int)$_POST['txt_dias']);
$class_paquete->setint_countnoches((int)$_POST['txt_noches']);
$class_paquete->settxt_precio(secure_sql($_POST['txt_precio']));
$class_paquete->settxt_precio_soles($_POST['txt_precio_soles']);
$class_paquete->settxt_tipo_cambio($_POST['txt_tipo_cambio']);
$class_paquete->settxt_ishome((int)$_POST['chk_home']);
$class_paquete->settxt_isdestacado((int)$_POST['chk_destacado']);
$class_paquete->settxt_isnuevo((int)$_POST['chk_nuevo']);
$class_paquete->settxt_isultimos((int)$_POST['chk_ultimos']);
$class_paquete->settxt_isagotado((int)$_POST['chk_agotado']);

#Listado de Hoteles seleccionados
if( is_array($_REQUEST['hoteles_opt']) !== FALSE ){
$opt_hoteles = implode(",", $_REQUEST['hoteles_opt']);
}
else $opt_hoteles = $_REQUEST['hoteles_opt'];

$class_paquete->settxt_bhoteles($opt_hoteles);

switch($op)
{
	case 1:	//guardar
			$class_paquete->_Save();
			$idsec=$class_paquete->getpk_paquete();
            $class_paquete->Paquete_US();
	
	break;
	case 2://Actualizar	
			$class_paquete->setpk_paquete($id);	
			$class_paquete->_Update();
			$class_paquete->Paquete_US('Update');
			//$class_paquete->_SaveImages_Product('file_products');
	break;
	case 3://Eliminar	
			$class_paquete = new cls_tbl_paquete($id);
			$class_paquete->_Remove();					
	break;
	case 4://Estado	
			$class_paquete = new cls_tbl_paquete($id);
			@$class_paquete->estado();					
	break;
	case 5://Elimina check
	if(!empty($_POST["chkproducto"]))
	{	
		foreach($_POST["chkproducto"] as $valor)
		{		if($_POST["chkproducto"])
				{	$class_paquete = new cls_tbl_paquete($valor);
					$class_paquete->_Remove();				
				}
		}		// foreach
	}
	break;
	case 6://Activa check

	if(!empty($_POST["chkproducto"]))
	{	
		foreach($_POST["chkproducto"] as $valor)
		{		if($_POST["chkproducto"])
				{	$class_paquete = new cls_tbl_paquete($valor);
					@$class_paquete->estado("1");				
				}
		}		// foreach
	}
	break;
	case 7://Desactivar check

	if(!empty($_POST["chkproducto"]))
	{	
		foreach($_POST["chkproducto"] as $valor)
		{		if($_POST["chkproducto"])
				{	$class_paquete = new cls_tbl_paquete($valor);
					@$class_paquete->estado("0");				
				}
		}		// foreach
	}

						
	break;
	case 8:
	$class_paquete->_SaveImages_Product('Filedata');
	break;
	
	case 10:
	  cls_tbl_paquete::RemovePhoto($idphoto);
	break;
	
	case 11:
	  $class_paquete = new cls_tbl_paquete();
	  $class_paquete->TipoCambioDolares($tipoCambio2);	
	break;
	
	
}//fin del switch*/

if(($op==1) || ($op==2) || ($op==3) ||  ($op==5) ||   ($op==6) ||  ($op==7) ||  ($op==11))
{	header ("location: inf_paquete.php");
}
?>