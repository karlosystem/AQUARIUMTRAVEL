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

$int_optbg = (int)$_POST['rb_imagebg'];
$txtcolor = $_POST['get_bgcolor'];


$cnt_pasaje = new cls_tbl_pasajes($id);
$cnt_pasaje->setdate_pasaje($_POST['get_datepasaje']);
$cnt_pasaje->settxt_cobertura($_POST['get_cobertura']);

$cnt_pasaje->settxt_metatitle($_POST['get_metatitle']);
$cnt_pasaje->settxt_metadescription($_POST['get_metadescription']);

$cnt_pasaje->settxt_status((int)($_POST['chk_publicpasaje']));
$cnt_pasaje->setdate_fecregistro(date("Y-m-d"));

$imagen=$_POST['hidden_pasaje'];
	if ($_FILES['file_pasaje']['name']==NULL)
{	$cnt_pasaje->settxt_imagen($imagen);	}
else
{	
	$max_size = 1024*5000; #<>5Mb
    $my_upload = new file_upload;
    $my_upload->upload_dir = ADMIN_IMG_PASAJE;
    $my_upload->extensions = array(".jpg",".jpeg"); ;
    $my_upload->max_length_filename = 50;
    $my_upload->rename_file = true;
	
	$my_upload->the_temp_file = $_FILES['file_pasaje']['tmp_name'];
	$my_upload->the_file = $_FILES['file_pasaje']['name'];
	$my_upload->http_error = $_FILES['file_pasaje']['error'];
	$my_upload->replace = "n"; // because only a checked checkboxes is true
	$my_upload->do_filename_check = "y"; // use this boolean to check for a valid filename
	$new_name = "";
    
		if ($my_upload->upload($new_name)) {
		  $full_path = $my_upload->upload_dir.$my_upload->file_copy;
		  $info = $my_upload->get_uploaded_file_info($full_path);
	      $cnt_pasaje->settxt_imagen($my_upload->file_copy);
        }
}


switch($op)
{
	case 1:	//guardar
			$cnt_pasaje->_Save();
			$idsec=$cnt_pasaje->getpk_pasaje();
			$cnt_pasaje->SU_Pasaje();
	break;
	
	case 2://Actualizar	
			$cnt_pasaje->setpk_pasaje($id);	
			$cntevent_borrar= new cls_tbl_pasajes($id);						
			$file_temp=$cntevent_borrar->gettxt_imagen();
			
			if($file_temp!=$cnt_pasaje->gettxt_imagen())
			{
			deleteFiles(ADMIN_IMG_PASAJE,$cntevent_borrar->gettxt_imagen());
			}									
			$cnt_pasaje->_Update();
			$cnt_pasaje->SU_Pasaje('Update');
			
			$cnt_pasaje->setpk_pasaje($id);	
			$cnt_pasaje->_Update();
			$cnt_pasaje->SU_Pasaje('Update');
	        
	break;
	
	case 3://Eliminar	
			$cnt_pasaje = new cls_tbl_pasajes($id);
			deleteFiles(ADMIN_IMG_PASAJE,$cnt_pasaje->gettxt_imagen());
			
			$cnt_pasaje->_Delete();					
	break;
	
	case 4://Estado	
			$cnt_pasaje = new cls_tbl_pasajes($id);
			@$cnt_pasaje->estado();					
	break;
	
	case 5://activar check
		if(!empty($_POST["chknoticia"]))
	{	
		foreach($_POST["chknoticia"] as $id=>$valor)
		{		if($_POST["chknoticia"])
				{	$cnt_pasaje = new cls_tbl_pasajes($valor);
				    deleteFiles(ADMIN_PHOTOBIG_NOTICIA,$cnt_pasaje->gettxt_imagen());
					$cnt_pasaje->_Delete();				
				}
		}		// foreach
	}

	
	
	break;
	
	case 6://desactivar check
	if(!empty($_POST["chknoticia"]))
	{	
		foreach($_POST["chknoticia"] as $id=>$valor)
		{		if($_POST["chknoticia"])
				{	$cnt_pasaje = new cls_tbl_pasajes($valor);
					$cnt_pasaje->estado("1");				
				}
		}		// foreach
	}
	break;

	case 7://eliminar check
	if(!empty($_POST["chknoticia"]))
	{	
		foreach($_POST["chknoticia"] as $valor)
		{		if($_POST["chknoticia"])
				{	$cnt_pasaje = new cls_tbl_pasajes($valor);
					$cnt_pasaje->estado("0");				
				}
		}		// foreach
	}
	break;
}//fin del switch*/

if(($op==1) || ($op==2) || ($op==3) ||  ($op==5) ||   ($op==6) ||  ($op==7) )
{	header ("location: inf_pasajes.php"); 	}
else if($op!=4)
{	unset($_SESSION['webuser']);
	header ("location: index.php"); }

?>