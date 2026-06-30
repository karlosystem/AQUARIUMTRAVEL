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


$cnt_departamento = new cls_tbl_departamento($id);
$cnt_departamento->setfk_pais($_POST['sle_pais']);
$cnt_departamento->settxt_descripcion($_POST['get_txtubicacion']);
$cnt_departamento->settxt_status($_POST['chkdepartamento']);
$cnt_departamento->setdate_dateadd(date("Y-m-d"));

$thisdatedepa = $_POST['getdate_creacion'];
if(tep_not_null($thisdatedepa) && $thisdatedepa!='00-00-0000')
$thisdatedepa = Date::convert($thisdatedepa,'d-m-Y','Y-m-d');


$cnt_departamento->settxt_creacion($thisdatedepa);

$imagen = $_POST['h_thumbdepartamento'];
if ($_FILES['fileup_departamento']['name']==NULL)
{$cnt_departamento->settxt_imagen($imagen);}
else
{
$max_size = 1024*1000; #<>5Mb
$my_upload = new file_upload;
$my_upload->upload_dir = ADMIN_IMG_DEPARTAMENTOS;
$my_upload->extensions = array(".jpeg",".jpg");
$my_upload->max_length_filename = 50;
$my_upload->rename_file = true;
$my_upload->the_temp_file = $_FILES['fileup_departamento']['tmp_name'];
$my_upload->the_file = $_FILES['fileup_departamento']['name'];
$my_upload->http_error = $_FILES['fileup_departamento']['error'];
$my_upload->replace = "n"; // because only a checked checkboxes is true
$my_upload->do_filename_check = "y"; // use this boolean to check for a valid filename

$new_name = "";
		
		if ($my_upload->upload($new_name)) {
		$full_path = $my_upload->upload_dir.$my_upload->file_copy;
		
		$infoimg = getimagesize($full_path);
		$w = $infoimg[0]; #
			if($w>300){
				$resize_image = new Thumbnail($full_path);
				$resize_image->resize(W_DEPARTAMENTOS_MAX,H_DEPARTAMENTOS_MAX);
				$resize_image->save($full_path); #save(path,100) => 100 <> a la calidad de la imagen
				$cnt_departamento->settxt_imagen($my_upload->file_copy);
			}
		}else{
		$cnt_departamento->settxt_imagen($imagen);
		}
}

switch($op)
{
	case 1:	//guardar
			$cnt_departamento->guarda();
			$idsec=$cnt_departamento->getpk_departamento();
	break;
	case 2://Actualizar	
			$cnt_departamento->setpk_departamento($id);	
			$depa_borrar= new cls_tbl_departamento($id);						
			$file_temp = $depa_borrar->gettxt_imagen();				
			if($file_temp!=$cnt_departamento->gettxt_imagen())
			{	deleteFiles(ADMIN_IMG_DEPARTAMENTOS,$file_temp);	}									
			$cnt_departamento->actualiza();
			
/*			echo $op;
			exit();*/
			
	break;
	case 3://Eliminar	
			$cnt_departamento = new cls_tbl_departamento($id);
			deleteFiles(ADMIN_IMG_DEPARTAMENTOS,$cnt_departamento->gettxt_imagen());
			$cnt_departamento->elimina();					
					
	break;
	case 4://Estado	
			$cnt_departamento = new cls_tbl_departamento($id);
			@$cnt_departamento->estado();					
	break;
	
	case 5://Activar check
	if(!empty($_POST["chkdepartamento"]))
	{	
		foreach($_POST["chkdepartamento"] as $valor)
		{		if($_POST["chkdepartamento"])
				{	$sorteo = new cls_tbl_departamento($valor);
					@$sorteo->estado("1");				
				}
		}		// foreach
	}
	break;
	
	case 6://Desactivar check
	if(!empty($_POST["chkdepartamento"]))
	{	
		foreach($_POST["chkdepartamento"] as $id=>$valor)
		{		if($_POST["chkdepartamento"])
				{	$sorteo = new cls_tbl_departamento($valor);
					@$sorteo->estado("0");				
				}
		}		// foreach
	}
	break;
	
	case 7: //Remover check
	if(!empty($_POST["chkdepartamento"]))
	{	
		foreach($_POST["chkdepartamento"] as $id=>$valor)
		{		if($_POST["chkdepartamento"])
				{	$sorteo = new cls_tbl_departamento($valor);
					$sorteo->elimina();				
				}
		}		// foreach
	}
	break;
}


if(($op==1) || ($op==2) || ($op==3) ||  ($op==5) ||   ($op==6) ||  ($op==7) )
{	header ("location: inf_departamentos.php"); 	}
else if($op!=4)
{	unset($_SESSION['webuser']);
	header ("location: index.php"); }
	
	
?>