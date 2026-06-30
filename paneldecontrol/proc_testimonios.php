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



$cnt_testimonios = new cls_tbl_testimonios($id);
$cnt_testimonios->setdate_testimonio($_POST['get_datetestimonio']);
$cnt_testimonios->settxt_status((int)($_POST['chk_publictestimonio']));
$cnt_testimonios->setdate_dateadd(date("Y-m-d"));

$imagen=$_POST['hidden_testimonio'];
if ($_FILES['file_testimonio']['name']==NULL)
{	$cnt_testimonios->settxt_imgthumb($imagen);	}
else
{	
	$max_size = 1024*5000; #<>5Mb
    $my_upload = new file_upload;
    $my_upload->upload_dir = ADMIN_IMG_TESTIMONIO;
    $my_upload->extensions = array(".jpg",".jpeg"); ;
    $my_upload->max_length_filename = 50;
    $my_upload->rename_file = true;
	
	$my_upload->the_temp_file = $_FILES['file_testimonio']['tmp_name'];
	$my_upload->the_file = $_FILES['file_testimonio']['name'];
	$my_upload->http_error = $_FILES['file_testimonio']['error'];
	$my_upload->replace = "n"; // because only a checked checkboxes is true
	$my_upload->do_filename_check = "y"; // use this boolean to check for a valid filename
	$new_name = "";
    
		if ($my_upload->upload($new_name)) {
		  $full_path = $my_upload->upload_dir.$my_upload->file_copy;
		  $info = $my_upload->get_uploaded_file_info($full_path);
	      $cnt_testimonios->settxt_imgthumb($my_upload->file_copy);
        }
}


switch($op)
{
	case 1:	//guardar
			$cnt_testimonios->_Save();
			$idsec=$cnt_testimonios->getpk_testimonios();
			$cnt_testimonios->SU_Testimonios();
	break;
	
	case 2://Actualizar	
			$cnt_testimonios->setpk_testimonios($id);	
			$cntevent_borrar= new cls_tbl_testimonios($id);						
			$file_temp=$cntevent_borrar->gettxt_imgthumb();
			
			if($file_temp!=$cnt_testimonios->gettxt_imgthumb())
			{
			deleteFiles(ADMIN_IMG_TESTIMONIO,$cntevent_borrar->gettxt_imgthumb());
			}									
			$cnt_testimonios->_Update();
			$cnt_testimonios->SU_Testimonios('Update');
	        
	break;
	
	case 3://Eliminar	
			$cnt_testimonios = new cls_tbl_testimonios($id);
			deleteFiles(ADMIN_IMG_TESTIMONIO,$cnt_testimonios->gettxt_imgthumb());			
			$cnt_testimonios->_Delete();					
	break;
	
	case 4://Estado	
			$cnt_testimonios = new cls_tbl_testimonios($id);
			@$cnt_testimonios->estado();					
	break;
	
	case 5://activar check
		if(!empty($_POST["chkallregister"]))
	{	
		foreach($_POST["chkallregister"] as $id=>$valor)
		{		if($_POST["chkallregister"])
				{	$cnt_testimonios = new cls_tbl_testimonios($valor);
				    deleteFiles(ADMIN_IMG_TESTIMONIO,$cnt_testimonios->gettxt_imgthumb());
					$cnt_testimonios->_Delete();				
				}
		}		// foreach
	}

	
	
	break;
	
	case 6://desactivar check
	if(!empty($_POST["chkallregister"]))
	{	
		foreach($_POST["chkallregister"] as $id=>$valor)
		{		if($_POST["chkallregister"])
				{	$cnt_testimonios = new cls_tbl_testimonios($valor);
					$cnt_testimonios->estado("1");				
				}
		}		// foreach
	}
	break;

	case 7://eliminar check
	if(!empty($_POST["chk_publictestimonio"]))
	{	
		foreach($_POST["chk_publictestimonio"] as $valor)
		{		if($_POST["chk_publictestimonio"])
				{	$cnt_testimonios = new cls_tbl_testimonios($valor);
					$cnt_testimonios->estado("0");				
				}
		}		// foreach
	}
	break;
}//fin del switch*/

if(($op==1) || ($op==2) || ($op==3) ||  ($op==5) ||   ($op==6) ||  ($op==7) )
{	header ("location: inf_testimonios.php"); 	}
else if($op!=4)
{	unset($_SESSION['webuser']);
	header ("location: index.php"); }

?>