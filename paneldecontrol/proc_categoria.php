<?php

@ob_start();
@session_start();

require_once("../init.php") ;
require_once("loadclass.php") ;

require_once("../include/class/upload_class.php");
require_once("../include/class/thumbnail.inc.php");

$UserLoadTemp = new cls_tbl_administrador();

$InfoUser = $UserLoadTemp->fetch_user_info($_SESSION[COOKIE_NAME]);
$CUser = (int)$InfoUser['pk_usuario'];

$UserLoad = new cls_tbl_administrador($CUser);

if(!$UserLoad->is_user_logged_in())
header("Location: index.php");


$id= (int)(tep_not_null($_GET['id']))?$_GET['id']:$_POST['id'];
$op= (int)(tep_not_null($_GET['op']))?$_GET['op']:$_POST['op'];
$doAction = $_POST['hdo'];

$cls_categoria = new cls_tbl_categoria($id);

#Asignamos los valores respectivos a la categoria
$ParentCategory = (int)$_POST['sle_parent'];

if($ParentCategory==$cls_categoria->getfk_categoria())
$ParentCategory = (int)$cls_categoria->getfk_categoria();

$cls_categoria->setfk_categoria($ParentCategory);
$cls_categoria->settxt_nombre(secure_sql($_POST['get_namecategory']));
$cls_categoria->settxt_descripcion(secure_sql($_POST['get_presentacioncategory']));
$cls_categoria->settxt_meta(secure_sql($_POST['get_metacategory']));
$cls_categoria->settxt_metatitle(secure_sql($_POST['get_metatitlecategory']));
$cls_categoria->settxt_linkexterno(secure_sql($_POST['txt_linkexterno']));
$cls_categoria->setint_orden((int)$_POST['txt_order']);
$cls_categoria->setint_tipo((int)$_POST['opt_nivel']);
$cls_categoria->setint_estado((int)$_POST['chk_status']);
$cls_categoria->settxt_dateadd(date("Y-m-d"));

//$cls_categoria->settxt_linkexterno(url_validate($_POST['txt_linkexterno']));

$imagen = $_POST['hidden_categoriaimg'];
$cls_categoria->settxt_imagen($imagen);

#IMAGE
if ($_FILES['file_categoria']['name']!=NULL)
  {
	$my_upload = new file_upload;
	$my_upload->upload_dir = ADMIN_IMG_CAT;
	$my_upload->extensions = array(".jpg", ".gif",".jpeg");
	$my_upload->max_length_filename = 100;
	$my_upload->rename_file = true;
	$my_upload->max_size = 1024*1000; # 1Mb
	
	$my_upload->the_temp_file = $_FILES['file_categoria']['tmp_name'];
	$my_upload->the_file = $_FILES['file_categoria']['name'];
	$my_upload->http_error = $_FILES['file_categoria']['error'];
	$my_upload->replace = "n"; // because only a checked checkboxes is true
	$my_upload->do_filename_check = "y"; // use this boolean to check for a valid filename
	$new_name = "";
			
			if ($my_upload->upload($new_name)) {
			
			@deleteFiles(ADMIN_IMG_CAT,$imagen);
			 
			$full_path = $my_upload->upload_dir.$my_upload->file_copy;
			$cls_categoria->settxt_imagen($my_upload->file_copy);
			}
	}
	
switch($op)
{	
	case 1:	//Crear una nueva categoria
			$cls_categoria->_Save();
			$id = $cls_categoria->getpk_categoria();

	break;
	case 2://Actualiza la categoria respectiva	
			@$cls_categoria->setpk_categoria($id);	
			$cls_categoria->_Update();
    break;
	
    case 3://Eliminar	
			$cls_categoria = new cls_tbl_categoria($id);
			$cls_categoria->_Remove();
	break;
	case 4://Actualiza el estado de la categoria	
			$cls_category = new cls_tbl_categoria($id);
			$cls_category->setpk_categoria($id);
			@$cls_category->estado();					
	break;
	case 5://Eliminar Categoria
		if(!empty($_POST["chkcategory"]))
		{	
			foreach($_POST["chkcategory"] as $CodeCategory)
			{		if($CodeCategory>0)
					{	$cls_categoria = new cls_tbl_categoria($CodeCategory);
						$cls_categoria->_Remove();				
					}
			}		// foreach
		}
	break;
	case 6://Activa el estado de los elementos seleccionados.
		if(!empty($_POST["chkcategory"]))
		{	
			foreach($_POST["chkcategory"] as $CodeCategory)
			{		if($CodeCategory)
					{	$cls_categoria = new cls_tbl_categoria($CodeCategory);
						$cls_categoria->estado("1");				
					}
			}		// foreach
		}
	break;
	case 7://Desactiva el estado de los elementos seleccionados.
		if(!empty($_POST["chkcategory"]))
		{	
			foreach($_POST["chkcategory"] as $CodeCategory)
			{		if($CodeCategory)
					{	
					   
						$cls_categoraia = new cls_tbl_categoria($CodeCategory);
						$cls_categoria->estado("0");				
					}
			}		// foreach
		}
	break;


}



if(($op==1) || ($op==2) || ($op==3) || ($op==5) || ($op==6))
{	
 if($id>0 && $cls_categoria->IsExistCategory()){
 $ParentReturn = (int)$cls_categoria->getParent($id);
 if($ParentReturn==-1)
 $ParentReturn = 0;
 
 header ("location: inf_categorias.php?CParent=$ParentReturn");
 }else{
 header ("location: inf_categorias.php"); 
 }		
}
else if($op!=4)
{	header ("location: index.php"); }

?>