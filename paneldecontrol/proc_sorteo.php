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


$cnt_sorteo = new cls_tbl_sorteo($id);
$cnt_sorteo->settxt_titulo($_POST['get_txttitulo']);
$cnt_sorteo->settxt_ganador($_POST['get_txtganador']);
$cnt_sorteo->settxt_empresa($_POST['get_txtempresa']);
$cnt_sorteo->settxt_cargo($_POST['get_txtcargo']);
$cnt_sorteo->settxt_content($_POST['get_contentsorteo']);
$cnt_sorteo->setint_order($_POST['get_order']);
$cnt_sorteo->settxt_status($_POST['chksorteo']);
$cnt_sorteo->setdate_fecha(date("Y-m-d"));

$thisdatesorteo = $_POST['get_dateadd'];
if(tep_not_null($thisdatesorteo) && $thisdatesorteo!='00-00-0000')
$thisdatesorteo = Date::convert($thisdatesorteo,'d-m-Y','Y-m-d');

//echo $thisdatenotice."*********".$_POST['get_datenotice'];
//exit();

$cnt_sorteo->setdate_dateadd($thisdatesorteo);#fecha de la noticia

$imagen = $_POST['h_thumbsorteo'];
if ($_FILES['fileup_sorteo']['name']==NULL)
{$cnt_sorteo->settxt_imgthumb($imagen);}
else
{
$max_size = 1024*1000; #<>5Mb
$my_upload = new file_upload;
$my_upload->upload_dir = ADMIN_IMG_SORTEO;
$my_upload->extensions = array(".jpeg",".jpg");
$my_upload->max_length_filename = 50;
$my_upload->rename_file = true;
$my_upload->the_temp_file = $_FILES['fileup_sorteo']['tmp_name'];
$my_upload->the_file = $_FILES['fileup_sorteo']['name'];
$my_upload->http_error = $_FILES['fileup_sorteo']['error'];
$my_upload->replace = "n"; // because only a checked checkboxes is true
$my_upload->do_filename_check = "y"; // use this boolean to check for a valid filename

$new_name = "";
		
		if ($my_upload->upload($new_name)) {
		$full_path = $my_upload->upload_dir.$my_upload->file_copy;
		
		$infoimg = getimagesize($full_path);
		$w = $infoimg[0]; # ancho de la noticia
			if($w>300){
				$resize_image = new Thumbnail($full_path);
				$resize_image->resize(W_SORTEO_MAX,H_SORTEO_MAX);
				$resize_image->save($full_path); #save(path,100) => 100 <> a la calidad de la imagen
				$cnt_sorteo->settxt_imgthumb($my_upload->file_copy);
			}
		}else{
		$cnt_sorteo->settxt_imgthumb($imagen);
		}
}

switch($op)
{
	case 1:	//guardar
			$cnt_sorteo->guarda();
			$idsec=$cnt_sorteo->getpk_sorteo();
	break;
	case 2://Actualizar	
			$cnt_sorteo->setpk_sorteo($id);	
			$sorteo_borrar= new cls_tbl_sorteo($id);						
			$file_temp = $sorteo_borrar->gettxt_imgthumb();				
			if($file_temp!=$cnt_sorteo->gettxt_imgthumb())
			{	deleteFiles(ADMIN_IMG_SORTEO,$file_temp);	}									
			$cnt_sorteo->actualiza();
			
/*			echo $op;
			exit();*/
			
	break;
	case 3://Eliminar	
			$cnt_sorteo = new cls_tbl_sorteo($id);
			//deleteFiles(ADMIN_IMG_SORTEO,$cnt_sorteo->gettxt_imgthumb());
			$cnt_sorteo->elimina();					
					
	break;
	case 4://Estado	
			$cnt_sorteo = new cls_tbl_sorteo($id);
			@$cnt_sorteo->estado();					
	break;
	
	case 5://Activar check
	if(!empty($_POST["chksorteo"]))
	{	
		foreach($_POST["chksorteo"] as $valor)
		{		if($_POST["chksorteo"])
				{	$sorteo = new cls_tbl_sorteo($valor);
					@$sorteo->estado("1");				
				}
		}		// foreach
	}
	break;
	
	case 6://Desactivar check
	if(!empty($_POST["chksorteo"]))
	{	
		foreach($_POST["chksorteo"] as $id=>$valor)
		{		if($_POST["chksorteo"])
				{	$sorteo = new cls_tbl_sorteo($valor);
					@$sorteo->estado("0");				
				}
		}		// foreach
	}
	break;
	
	case 7: //Remover check
	if(!empty($_POST["chksorteo"]))
	{	
		foreach($_POST["chksorteo"] as $id=>$valor)
		{		if($_POST["chksorteo"])
				{	$sorteo = new cls_tbl_sorteo($valor);
					$sorteo->elimina();				
				}
		}		// foreach
	}
	break;
}


if(($op==1) || ($op==2) || ($op==3) ||  ($op==5) ||   ($op==6) ||  ($op==7) )
{	header ("location: inf_sorteo.php"); 	}
else if($op!=4)
{	unset($_SESSION['webuser']);
	header ("location: index.php"); }
	
	
?>