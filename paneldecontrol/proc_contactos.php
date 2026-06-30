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


$cnt_contactos = new cls_tbl_contacto($id);


$cnt_contactos->settxt_nombres($_POST['get_txtnombres']);
$cnt_contactos->settxt_email($_POST['get_txtemail']);
$cnt_contactos->settxt_telefono($_POST['get_txttelefono']);
$cnt_contactos->settxt_mensaje($_POST['txt_mensaje']);
$cnt_contactos->settxt_nota($_POST['txt_nota']);
$cnt_contactos->settxt_vendedor($_POST['get_vendedor']);
$cnt_contactos->setfk_estado($_POST['getfk_estado']);
$cnt_contactos->setdate_fecha($_POST['txt_date']);

switch($op)
{
	case 1:	//guardar
			$cnt_contactos->guarda();
			$idsec=$cnt_contactos->getpk_contacto();
	break;
	case 2://Actualizar	
			$cnt_contactos->setpk_contacto($id);	
			$sorteo_borrar= new cls_tbl_contacto($id);															
			$cnt_contactos->actualiza();

	break;
	case 3://Eliminar	
			$cnt_contactos = new cls_tbl_contacto($id);
			$cnt_contactos->elimina();					
					
	break;
	case 4://Estado	
			$cnt_contactos = new cls_tbl_contacto($id);
			@$cnt_contactos->estado();					
	break;
	
	case 5://Activar check
	if(!empty($_POST["chkreserva"]))
	{	
		foreach($_POST["chkreserva"] as $valor)
		{		if($_POST["chkreserva"])
				{	$sorteo = new cls_tbl_contacto($valor);
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
				{	$sorteo = new cls_tbl_contacto($valor);
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
				{	$sorteo = new cls_tbl_contacto($valor);
					$sorteo->elimina();				
				}
		}		// foreach
	}
	break;
}


if(($op==1) || ($op==2) || ($op==3) ||  ($op==5) ||   ($op==6) ||  ($op==7) )
{	header ("location: inf_contacto.php"); 	}
else if($op!=4)
{	unset($_SESSION['webuser']);
	header ("location: index.php"); }
	
	
?>