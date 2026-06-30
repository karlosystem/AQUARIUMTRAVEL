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


$cnt_destino = new cls_tbl_destino($id);
$cnt_destino->settxt_nombre($_POST['get_txtnombre']);
$cnt_destino->setfk_ubicacion($_POST['sle_ubicacion']);
$cnt_destino->settxt_descripcion($_POST['get_content']);
$cnt_destino->settxt_status($_POST['chkdestino']);
$cnt_destino->setdate_dateadd(date("Y-m-d"));

$cnt_destino->settxt_metatitle($_POST['get_txtmetatitle']);
$cnt_destino->settxt_metadescription($_POST['get_txtmetadescription']);

$thisdatedepa = $_POST['getdate_creacion'];
if(tep_not_null($thisdatedepa) && $thisdatedepa!='00-00-0000')
$thisdatedepa = Date::convert($thisdatedepa,'d-m-Y','Y-m-d');


$cnt_destino->settxt_creacion($thisdatedepa);

$imagen = $_POST['h_thumbdestino'];
if ($_FILES['fileup_destino']['name']==NULL)
{$cnt_destino->settxt_imagen($imagen);}
else
{
$max_size = 1024*1000; #<>5Mb
$my_upload = new file_upload;
$my_upload->upload_dir = ADMIN_PHOTOBIG_DESTINOS;
$my_upload->extensions = array(".jpeg",".jpg");
$my_upload->max_length_filename = 50;
$my_upload->rename_file = true;
$my_upload->the_temp_file = $_FILES['fileup_destino']['tmp_name'];
$my_upload->the_file = $_FILES['fileup_destino']['name'];
$my_upload->http_error = $_FILES['fileup_destino']['error'];
$my_upload->replace = "n"; // because only a checked checkboxes is true
$my_upload->do_filename_check = "y"; // use this boolean to check for a valid filename

$new_name = "";
		
		if ($my_upload->upload($new_name)) {
		$full_path = $my_upload->upload_dir.$my_upload->file_copy;
		
		$infoimg = getimagesize($full_path);
		$w = $infoimg[0]; #
			if($w>300){
				$resize_image = new Thumbnail($full_path);
				$resize_image->resize(W_DESTINOS_MAX,H_DESTINOS_MAX);
				$resize_image->save($full_path); #save(path,100) => 100 <> a la calidad de la imagen
				$cnt_destino->settxt_imagen($my_upload->file_copy);
			}
		}else{
		$cnt_destino->settxt_imagen($imagen);
		}
}

switch($op)
{
	case 1:	//guardar
			$cnt_destino->guarda();
			$idsec=$cnt_destino->getpk_destino();
	break;
	case 2://Actualizar	
			$cnt_destino->setpk_destino($id);	
			$depa_borrar= new cls_tbl_destino($id);						
			$file_temp = $depa_borrar->gettxt_imagen();				
			if($file_temp!=$cnt_destino->gettxt_imagen())
			{	deleteFiles(ADMIN_PHOTOBIG_DESTINOS,$file_temp);	}									
			$cnt_destino->actualiza();
			
/*			echo $op;
			exit();*/
			
	break;
	case 3://Eliminar	
			$cnt_destino = new cls_tbl_destino($id);
			deleteFiles(ADMIN_PHOTOBIG_DESTINOS,$cnt_destino->gettxt_imagen());
			$cnt_destino->elimina();					
					
	break;
	case 4://Estado	
			$cnt_destino = new cls_tbl_destino($id);
			@$cnt_destino->estado();					
	break;
	
	case 5://Activar check
	if(!empty($_POST["chkdestino"]))
	{	
		foreach($_POST["chkdestino"] as $valor)
		{		if($_POST["chkdestino"])
				{	$sorteo = new cls_tbl_destino($valor);
					@$sorteo->estado("1");				
				}
		}		// foreach
	}
	break;
	
	case 6://Desactivar check
	if(!empty($_POST["chkdestino"]))
	{	
		foreach($_POST["chkdestino"] as $id=>$valor)
		{		if($_POST["chkdestino"])
				{	$sorteo = new cls_tbl_destino($valor);
					@$sorteo->estado("0");				
				}
		}		// foreach
	}
	break;
	
	case 7: //Remover check
	if(!empty($_POST["chkdestino"]))
	{	
		foreach($_POST["chkdestino"] as $id=>$valor)
		{		if($_POST["chkdestino"])
				{	$sorteo = new cls_tbl_destino($valor);
					$sorteo->elimina();				
				}
		}		// foreach
	}
	break;
}


if(($op==1) || ($op==2) || ($op==3) ||  ($op==5) ||   ($op==6) ||  ($op==7) )
{	header ("location: inf_destino.php"); 	}
else if($op!=4)
{	unset($_SESSION['webuser']);
	header ("location: index.php"); }
	
	
?>