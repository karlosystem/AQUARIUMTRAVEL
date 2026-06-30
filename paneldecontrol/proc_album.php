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
$idphoto = secure_sql($_REQUEST['idphoto']);
$IsReferrer = $_SERVER['HTTP_REFERER'];


$album_date = change2mdy($_POST['txt_albumdate']); # Cnvertimos de dd/mm/yyyy a yyyy-mm-dd
$album_status = (int)$_POST['txt_status'];
$album_dateadd = date("Y-m-d");


$cls_album = new cls_tbl_album($id);
$cls_album->settxt_datealbum($album_date);
$cls_album->setint_status($album_status);
$cls_album->setdate_fecadd($album_dateadd);

 switch($op)
 { 
  case 1:	# Save
			$cls_album->guarda();
			$id = $cls_album->getpk_album();
			$cls_album->Album_US();
  break;
  case 2:	# Update
			$cls_album->setpk_album($id);	
			$cls_album->actualiza();
			$cls_album->Album_US('Update');
  break;
  case 3:	# Eliminar
			$cls_album = new cls_tbl_album($id);
			$cls_album->elimina();
  break;
  case 4:   #Actualizar  status => Activo | Desactivo
			$cls_album = new cls_tbl_album($id);
			@$cls_album->estado();					
  break;
  case 5:  #Remover album sólo los seleccioandos

	if(!empty($_POST["chkalbum"]))
	{	
		foreach($_POST["chkalbum"] as $valor)
		{		if($_POST["chkalbum"])
				{	$cls_album = new cls_tbl_album($valor);
					$cls_album->elimina();				
				}
		}		// foreach
	}
						
  break;
  case 6:  #Activar los albunes seleccionados

	if(!empty($_POST["chkalbum"]))
	{	
		foreach($_POST["chkalbum"] as $valor)
		{		if($_POST["chkalbum"])
				{	$cls_album = new cls_tbl_album($valor);
					@$cls_album->estado("1");				
				}
		}		// foreach
	}
  break;
  case 7:  #Desactivar los albunes seleccionados

	if(!empty($_POST["chkalbum"]))
	{	
		foreach($_POST["chkalbum"] as $valor)
		{		if($_POST["chkalbum"])
				{	$cls_album = new cls_tbl_album($valor);
					@$cls_album->estado("0");				
				}
		}		// foreach
	}
  break;
  case 8:  #Remover Imagen independiente de cada Album
    cls_tbl_album::RemovePhoto($idphoto);
  break;
  
 }

//print $op."------";
if(($op==1)||($op==2)||($op==5)||($op==6)||($op==7)||($op==8))
header("location: inf_album.php");

//if($op!=3 || $op!=4)
//header("Location: index.php");

?>