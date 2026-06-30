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


$id = (int)(tep_not_null($_GET['id']))?$_GET['id']:$_POST['id'];
$op = (int)(tep_not_null($_GET['op']))?$_GET['op']:$_POST['op'];


$cnt_hoteles = new cls_tbl_hoteles($id);
$cnt_hoteles->settxt_fecha($_POST['get_datehoteles']);
$cnt_hoteles->setfk_departamento($_POST['sle_departamento']);
$cnt_hoteles->setfk_cadena($_POST['sle_cadena']);
$cnt_hoteles->settxt_link($_POST['txt_link']);
$cnt_hoteles->settxt_direccion($_POST['txt_direccion']);
$cnt_hoteles->settxt_estrellas($_POST['sle_estrellas']);
$cnt_hoteles->settxt_estado((int)($_POST['chk_publichoteles']));
$cnt_hoteles->settxt_destacado((int)($_POST['chk_destacado']));
$cnt_hoteles->setdate_fecregistro(date("Y-m-d"));

$cnt_hoteles->settxt_precio_simple($_POST['txt_precio_simple']);
$cnt_hoteles->settxt_precio_doble($_POST['txt_precio_doble']);
$cnt_hoteles->settxt_precio_triple($_POST['txt_precio_triple']);
$cnt_hoteles->settxt_precio_nino($_POST['txt_precio_nino']);

$cnt_hoteles->graba_galeria('file');

$imagen=$_POST['hidden_hoteles'];

if ($_FILES['file_hoteles']['name']==NULL)
{	$cnt_hoteles->settxt_imagen($imagen);	}
else
{	
	$max_size = 1024*5000; #<>5Mb
    $my_upload = new file_upload;
    $my_upload->upload_dir = ADMIN_PHOTOBIG_HOTELES;
    $my_upload->extensions = array(".jpg",".jpeg",".png",".gif"); ;
    $my_upload->max_length_filename = 50;
    $my_upload->rename_file = true;
	
	$my_upload->the_temp_file = $_FILES['file_hoteles']['tmp_name'];
	$my_upload->the_file = $_FILES['file_hoteles']['name'];
	$my_upload->http_error = $_FILES['file_hoteles']['error'];
	$my_upload->replace = "n"; // because only a checked checkboxes is true
	$my_upload->do_filename_check = "y"; // use this boolean to check for a valid filename
	$new_name = "";
    
		if ($my_upload->upload($new_name)) {
		  $full_path = $my_upload->upload_dir.$my_upload->file_copy;
		  $info = $my_upload->get_uploaded_file_info($full_path);
	      $cnt_hoteles->settxt_imagen($my_upload->file_copy);
        }
}

#REMOVEMOS LAS IMAGENES  NO DESEADAS DE LOS HOTELES
if(tep_not_null($_REQUEST['chk_photohoteles'])){
	foreach($_REQUEST['chk_photohoteles'] as $code_photo){
		$Query = "SELECT mm_filenamebig, mm_filenamemin FROM tbl_hoteles_gallery WHERE pk_mmimage='".$code_photo."' AND fk_hoteles='".$id."'";
		$Result = $GLOBALS['CONNECT_DB']->query($Query);
		$Fetch = $GLOBALS['CONNECT_DB']->Fetch($Result);  
		deleteFiles(ADMIN_PHOTOBIG_HOTELESGALLERY,$Fetch['mm_filenamebig']);
		deleteFiles(ADMIN_PHOTOMIN_HOTELESPREVIEW,$Fetch['mm_filenamemin']);
		$GLOBALS['CONNECT_DB']->query("DELETE FROM tbl_hoteles_gallery WHERE pk_mmimage='".$code_photo."' AND fk_hoteles='".$id."'"); 
	}
}

switch($op)
{
	case 1:	//guardar
			$cnt_hoteles->_Save();
			$idsec=$cnt_hoteles->getpk_hoteles();
			$cnt_hoteles->SU_Hoteles();
			$cnt_hoteles->graba_galeria('file');
	break;
	
	case 2://Actualizar	
			$cnt_hoteles->setpk_hoteles($id);	
			$cntevent_borrar= new cls_tbl_hoteles($id);						
			$file_temp=$cntevent_borrar->gettxt_imagen();
			
			if($file_temp!=$cnt_hoteles->gettxt_imagen())
			{
				deleteFiles(ADMIN_PHOTOBIG_HOTELES,$cntevent_borrar->gettxt_imagen());
			}									
			$cnt_hoteles->_Update();
			$cnt_hoteles->SU_Hoteles('Update');
			#$cnt_hoteles->graba_galeria('file');
	        
	break;
	
	case 3://Eliminar	
			$cnt_hoteles = new cls_tbl_hoteles($id);
			deleteFiles(ADMIN_PHOTOBIG_HOTELES,$cnt_hoteles->gettxt_imagen());
			
			$cnt_hoteles->_Delete();					
	break;
	
	case 4://Estado	
			$cnt_hoteles = new cls_tbl_hoteles($id);
			@$cnt_hoteles->estado();					
	break;
	
	case 5://activar check
		if(!empty($_POST["chkhoteles"]))
	{	
		foreach($_POST["chkhoteles"] as $id=>$valor)
		{		if($_POST["chkhoteles"])
				{	$cnt_hoteles = new cls_tbl_hoteles($valor);
				    deleteFiles(ADMIN_PHOTOBIG_HOTELES,$cnt_hoteles->gettxt_imagen());
					$cnt_hoteles->_Delete();				
				}
		}		// foreach
	}

	break;
	
	case 6://desactivar check
	if(!empty($_POST["chkhoteles"]))
	{	
		foreach($_POST["chkhoteles"] as $id=>$valor)
		{		if($_POST["chkhoteles"])
				{	$cnt_hoteles = new cls_tbl_hoteles($valor);
					$cnt_hoteles->estado("1");				
				}
		}		// foreach
	}
	break;

	case 7://eliminar check
	if(!empty($_POST["chkhoteles"]))
	{	
		foreach($_POST["chkhoteles"] as $valor)
		{		if($_POST["chkhoteles"])
				{	$cnt_hoteles = new cls_tbl_hoteles($valor);
					$cnt_hoteles->estado("0");				
				}
		}		// foreach
	}
	break;
}//fin del switch*/

if(($op==1) || ($op==2) || ($op==3) ||  ($op==5) ||   ($op==6) ||  ($op==7) )
{	header ("location: inf_hoteles.php"); 	}
else if($op!=4)
{	unset($_SESSION['webuser']);
	header ("location: index.php"); }

?>