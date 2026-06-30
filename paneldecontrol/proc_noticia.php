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



$cnt_noticia = new cls_tbl_noticia($id);
$cnt_noticia->settxt_fecha($_POST['get_datenoticia']);
$cnt_noticia->settxt_estado((int)($_POST['chk_publicnoticia']));
$cnt_noticia->setdate_fecregistro(date("Y-m-d"));

$imagen=$_POST['hidden_noticia'];
if ($_FILES['file_noticia']['name']==NULL)
{	$cnt_noticia->settxt_imagen($imagen);	}
else
{	
	$max_size = 1024*5000; #<>5Mb
    $my_upload = new file_upload;
    $my_upload->upload_dir = ADMIN_PHOTOBIG_NOTICIA;
    $my_upload->extensions = array(".jpg",".jpeg"); ;
    $my_upload->max_length_filename = 50;
    $my_upload->rename_file = true;
	
	$my_upload->the_temp_file = $_FILES['file_noticia']['tmp_name'];
	$my_upload->the_file = $_FILES['file_noticia']['name'];
	$my_upload->http_error = $_FILES['file_noticia']['error'];
	$my_upload->replace = "n"; // because only a checked checkboxes is true
	$my_upload->do_filename_check = "y"; // use this boolean to check for a valid filename
	$new_name = "";
    
		if ($my_upload->upload($new_name)) {
		  $full_path = $my_upload->upload_dir.$my_upload->file_copy;
		  $info = $my_upload->get_uploaded_file_info($full_path);
	      $cnt_noticia->settxt_imagen($my_upload->file_copy);
        }
}


switch($op)
{
	case 1:	//guardar
			$cnt_noticia->_Save();
			$idsec=$cnt_noticia->getpk_noticia();
			$cnt_noticia->SU_Notice();
	break;
	
	case 2://Actualizar	
			$cnt_noticia->setpk_noticia($id);	
			$cntevent_borrar= new cls_tbl_noticia($id);						
			$file_temp=$cntevent_borrar->gettxt_imagen();
			
			if($file_temp!=$cnt_noticia->gettxt_imagen())
			{
			deleteFiles(ADMIN_PHOTOBIG_NOTICIA,$cntevent_borrar->gettxt_imagen());
			}									
			$cnt_noticia->_Update();
			$cnt_noticia->SU_Notice('Update');
	        
	break;
	
	case 3://Eliminar	
			$cnt_noticia = new cls_tbl_noticia($id);
			deleteFiles(ADMIN_PHOTOBIG_NOTICIA,$cnt_noticia->gettxt_imagen());
			
			$cnt_noticia->_Delete();					
	break;
	
	case 4://Estado	
			$cnt_noticia = new cls_tbl_noticia($id);
			@$cnt_noticia->estado();					
	break;
	
	case 5://activar check
		if(!empty($_POST["chknoticia"]))
	{	
		foreach($_POST["chknoticia"] as $id=>$valor)
		{		if($_POST["chknoticia"])
				{	$cnt_noticia = new cls_tbl_noticia($valor);
				    deleteFiles(ADMIN_PHOTOBIG_NOTICIA,$cnt_noticia->gettxt_imagen());
					$cnt_noticia->_Delete();				
				}
		}		// foreach
	}

	
	
	break;
	
	case 6://desactivar check
	if(!empty($_POST["chknoticia"]))
	{	
		foreach($_POST["chknoticia"] as $id=>$valor)
		{		if($_POST["chknoticia"])
				{	$cnt_noticia = new cls_tbl_noticia($valor);
					$cnt_noticia->estado("1");				
				}
		}		// foreach
	}
	break;

	case 7://eliminar check
	if(!empty($_POST["chknoticia"]))
	{	
		foreach($_POST["chknoticia"] as $valor)
		{		if($_POST["chknoticia"])
				{	$cnt_noticia = new cls_tbl_noticia($valor);
					$cnt_noticia->estado("0");				
				}
		}		// foreach
	}
	break;
}//fin del switch*/

if(($op==1) || ($op==2) || ($op==3) ||  ($op==5) ||   ($op==6) ||  ($op==7) )
{	header ("location: inf_noticia.php"); 	}
else if($op!=4)
{	unset($_SESSION['webuser']);
	header ("location: index.php"); }

?>