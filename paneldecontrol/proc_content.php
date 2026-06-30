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

$contenido = new cls_tbl_contenido($id);

$contenido->setint_order(secure_sql($_POST['txt_order']));
$contenido->setint_estado((int)$_POST['chk_status']);
$contenido->setfk_seccion($_POST['seccion']);
$contenido->settxt_dateadd(date("Y-m-d"));


$remove_img = (int)$_POST['chk_remove'];


$imagen=$_POST['imagen'];
if ($_FILES['file_uppages']['name']==NULL)
{$contenido->settxt_imagen($imagen);}
else
{

$my_upload = new file_upload;
$my_upload->upload_dir = ADMIN_IMG_PAGE;
$my_upload->extensions = array(".jpg", ".gif",".jpeg");
$my_upload->max_length_filename = 100;
$my_upload->rename_file = true;
$my_upload->max_size = 1024*1000; # 1Mb

$my_upload->the_temp_file = $_FILES['file_uppages']['tmp_name'];
$my_upload->the_file = $_FILES['file_uppages']['name'];
$my_upload->http_error = $_FILES['file_uppages']['error'];
$my_upload->replace = "n"; // because only a checked checkboxes is true
$my_upload->do_filename_check = "y"; // use this boolean to check for a valid filename

$new_name = "";
		
		if ($my_upload->upload($new_name)) {
        $contenido->settxt_imagen($my_upload->file_copy);
		}
}

if($remove_img==1){
deleteFiles(ADMIN_IMG_PAGE,$imagen);	
}

switch($op)
{
	case 1:	//guardar
			$contenido->_Save();
			$idsec=$contenido->getpk_contenido();
			$contenido->_SaveUpdate_PageLang();
	break;
	
	case 2://Actualizar	
			$contenido->setpk_contenido($id);	
			$contenido_borrar= new cls_tbl_contenido($id);						
			$file_temp=$contenido_borrar->gettxt_imagen();				
			if($file_temp!=$contenido->gettxt_imagen())
			{	deleteFiles(ADMIN_IMG_PAGE,$file_temp);	}									
			$contenido->_Update();
			$contenido->_SaveUpdate_PageLang('Update');
			
	break;
	
	case 3://Eliminar	
			$contenido = new cls_tbl_contenido($id);
            $contenido->_Remove();					
	break;
	
	case 4://Estado	
			$contenido = new cls_tbl_contenido($id);
			@$contenido->estado();					
	break;
	
	case 5://Activar check
	
	if(!empty($_POST["chkcontent"]))
	{	
		foreach($_POST["chkcontent"] as $id=>$valor)
		{		if($_POST["chkcontent"])
				{	$contenido = new cls_tbl_contenido($valor);
					$contenido->_Remove();				
				}
		}		// foreach
	}
	break;
	
	case 6://Desactivar check

	if(!empty($_POST["chkcontent"]))
	{	
		foreach($_POST["chkcontent"] as $id=>$valor)
		{		if($_POST["chkcontent"])
				{	$contenido = new cls_tbl_contenido($valor);
					@$contenido->estado("1");				
				}
		}		// foreach
	}
	break;

	case 7: //Remover check
	
	if(!empty($_POST["chkcontent"]))
	{	
		foreach($_POST["chkcontent"] as $valor)
		{		if($_POST["chkcontent"])
				{	$contenido = new cls_tbl_contenido($valor);
					@$contenido->estado("0");				
				}
		}		// foreach
	}

	break;

}//fin del switch*/



if(($op==1) || ($op==2) || ($op==3) ||  ($op==5) ||   ($op==6) ||  ($op==7) )
{	header ("location: inf_contenido.php"); 	}
else if($op!=4)
{	unset($_SESSION['webuser']);
	header ("location: index.php"); }

?>