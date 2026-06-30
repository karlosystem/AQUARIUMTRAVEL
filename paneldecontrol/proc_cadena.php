<?php
@ob_start();
@session_start();

require_once("../init.php");
require_once("loadclass.php");

#Las siguientes 2 Lineas se cargan .... ya que no esta incluido en "inc.load.lib.php"
require_once("../include/class/thumbnail.inc.php");


$UserLoadTemp = new cls_tbl_administrador();

$InfoUser = $UserLoadTemp->fetch_user_info($_SESSION[COOKIE_NAME]);
$CUser = (int)$InfoUser['pk_usuario'];

$UserLoad = new cls_tbl_administrador($CUser);

if(!$UserLoad->is_user_logged_in())
header("Location: index.php");


$id= (int)(tep_not_null($_GET['id']))?$_GET['id']:$_POST['id'];
$op= (int)(tep_not_null($_GET['op']))?$_GET['op']:$_POST['op'];


$cnt_cadena = new cls_tbl_cadena($id);
$cnt_cadena->settxt_nombre($_POST['get_txtnombre']);
$cnt_cadena->settxt_status($_POST['chkcadena']);
$cnt_cadena->setdate_dateadd(date("Y-m-d"));

$thisdatecade = $_POST['getdate_creacion'];
if(tep_not_null($thisdatecade) && $thisdatecade!='00-00-0000')
$thisdatecade = Date::convert($thisdatecade,'d-m-Y','Y-m-d');


$cnt_cadena->settxt_creacion($thisdatecade);

$imagen = $_POST['h_thumbcadena'];
if ($_FILES['fileup_cadena']['name']==NULL)
{$cnt_cadena->settxt_imagen($imagen);}
else
{
$max_size = 1024*1000; #<>5Mb
$my_upload = new file_upload;
$my_upload->upload_dir = ADMIN_IMG_CADENA;
$my_upload->extensions = array(".jpeg",".jpg");
$my_upload->max_length_filename = 50;
$my_upload->rename_file = true;
$my_upload->the_temp_file = $_FILES['fileup_cadena']['tmp_name'];
$my_upload->the_file = $_FILES['fileup_cadena']['name'];
$my_upload->http_error = $_FILES['fileup_cadena']['error'];
$my_upload->replace = "n"; // because only a checked checkboxes is true
$my_upload->do_filename_check = "y"; // use this boolean to check for a valid filename

$new_name = "";
		
		if ($my_upload->upload($new_name)) {
		$full_path = $my_upload->upload_dir.$my_upload->file_copy;
		
		$infoimg = getimagesize($full_path);
		$w = $infoimg[0]; #
			if($w>300){
				$resize_image = new Thumbnail($full_path);
				$resize_image->resize(W_CADENA_MAX,H_CADENA_MAX);
				$resize_image->save($full_path); #save(path,100) => 100 <> a la calidad de la imagen
				$cnt_cadena->settxt_imagen($my_upload->file_copy);
			}
		}else{
		$cnt_cadena->settxt_imagen($imagen);
		}
}

switch($op)
{
	case 1:	//guardar
			$cnt_cadena->guarda();
			$idsec=$cnt_cadena->getpk_cadena();
	break;
	case 2://Actualizar	
			$cnt_cadena->setpk_cadena($id);	
			$depa_borrar= new cls_tbl_cadena($id);						
			$file_temp = $depa_borrar->gettxt_imagen();				
			if($file_temp!=$cnt_cadena->gettxt_imagen())
			{	deleteFiles(ADMIN_IMG_CADENA,$file_temp);	}									
			$cnt_cadena->actualiza();
			
/*			echo $op;
			exit();*/
			
	break;
	case 3://Eliminar	
			$cnt_cadena = new cls_tbl_cadena($id);
			deleteFiles(ADMIN_IMG_CADENA,$cnt_cadena->gettxt_imagen());
			$cnt_cadena->elimina();					
					
	break;
	case 4://Estado	
			$cnt_cadena = new cls_tbl_cadena($id);
			@$cnt_cadena->estado();					
	break;
	
	case 5://Activar check
	if(!empty($_POST["chkcadena"]))
	{	
		foreach($_POST["chkcadena"] as $valor)
		{		if($_POST["chkcadena"])
				{	$sorteo = new cls_tbl_cadena($valor);
					@$sorteo->estado("1");				
				}
		}		// foreach
	}
	break;
	
	case 6://Desactivar check
	if(!empty($_POST["chkcadena"]))
	{	
		foreach($_POST["chkcadena"] as $id=>$valor)
		{		if($_POST["chkcadena"])
				{	$sorteo = new cls_tbl_cadena($valor);
					@$sorteo->estado("0");				
				}
		}		// foreach
	}
	break;
	
	case 7: //Remover check
	if(!empty($_POST["chkcadena"]))
	{	
		foreach($_POST["chkcadena"] as $id=>$valor)
		{		if($_POST["chkcadena"])
				{	$sorteo = new cls_tbl_cadena($valor);
					$sorteo->elimina();				
				}
		}		// foreach
	}
	break;
}


if(($op==1) || ($op==2) || ($op==3) ||  ($op==5) ||   ($op==6) ||  ($op==7) )
{	header ("location: inf_cadena.php"); 	}
else if($op!=4)
{	unset($_SESSION['webuser']);
	header ("location: index.php"); }
	
	
?>