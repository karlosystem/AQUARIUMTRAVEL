<?php

@ob_start();
@session_start();

require_once("../init.php") ;
require_once("loadclass.php") ;


$UserLoadTemp = new cls_tbl_administrador();

$InfoUser = $UserLoadTemp->fetch_user_info($_SESSION[COOKIE_NAME]);
$CUser = (int)$InfoUser['pk_usuario'];

$UserLoad = new cls_tbl_administrador($CUser);

if(!$UserLoad->is_user_logged_in())
header("Location: index.php");


$id= (int)(tep_not_null($_GET['id']))?$_GET['id']:$_POST['id'];
$op= (int)(tep_not_null($_GET['op']))?$_GET['op']:$_POST['op'];

$cls_user_class = new cls_tbl_administrador($id);


$seccion = new cls_tbl_seccion($id);
$seccion->settxt_nombre($_POST['txt_title']);
$seccion->settxt_url($_POST['txt_url']);
$seccion->settxt_destino($_POST['txt_target']);
$seccion->settxt_orden((int)$_POST['txt_order']);
$seccion->setint_estado((int)$_POST['txt_status']);

switch($op)
{
	case 1:	//guardar
				$seccion->_Save();
			    $idsec=$seccion->getpk_seccion();
	break;
	
	case 2://Actualizar	
				$seccion->setpk_seccion($id);	
			    $seccion_borrar= new cls_tbl_seccion($id);						
			    $seccion->_Update();
	break;
	
	case 3://Eliminar	
				$seccion = new cls_tbl_seccion($id);
			    $seccion->_Remove();
	break;
	
	case 4://Estado	
				$seccion = new cls_tbl_seccion($id);
			    @$seccion->estado();	
	break;
	
	case 5://Activar check
		if(!empty($_POST["chkseccion"]))
	      {	
		foreach($_POST["chkseccion"] as $id=>$valor)
		{		if($_POST["chkseccion"])
				{	$seccion = new cls_tbl_seccion($valor);
					$seccion->_Remove();				
				}
		       }		// foreach
	    }
	break;

	
	case 6://Activar check
	if(!empty($_POST["chkseccion"]))
	{	
		foreach($_POST["chkseccion"] as $valor)
		{		if($_POST["chkseccion"])
				{	$seccion = new cls_tbl_seccion($valor);
					@$seccion->estado("1");				
				}
		}		// foreach
	 }
	break;

	case 7: //Desactivar check
		if(!empty($_POST["chkseccion"]))
	{	
		foreach($_POST["chkseccion"] as $id=>$valor)
		{		if($_POST["chkseccion"])
				{	$seccion = new cls_tbl_seccion($valor);
					@$seccion->estado("0");				
				}
		}		// foreach
	  }
	break;

}//fin del switch*/



if(($op==1) || ($op==2) || ($op==3) ||  ($op==5) ||   ($op==6) ||  ($op==7) )
{	header ("location: inf_seccion.php"); 
}

?>