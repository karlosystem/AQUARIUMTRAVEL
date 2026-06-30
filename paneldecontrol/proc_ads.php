<?php
@ob_start();
@session_start();

require_once("../init.php") ;
require_once("loadclass.php") ;

require_once("../include/class/thumbnail.inc.php") ;

$UserLoadTemp = new cls_tbl_administrador();

$InfoUser = $UserLoadTemp->fetch_user_info($_SESSION[COOKIE_NAME]);
$CUser = (int)$InfoUser['pk_usuario'];

$UserLoad = new cls_tbl_administrador($CUser);

if(!$UserLoad->is_user_logged_in())
header("Location: index.php");



$id = (tep_not_null($_POST['id']))?$_POST['id']:$_GET['id']; # Id del Ads
$op = (tep_not_null($_POST['op']))?$_POST['op']:$_GET['op']; # Id del Ads

$IsReferrer = $_SERVER['HTTP_REFERER'];

$url_ads = $_POST['txt_url'];
$target_ads = $_POST['txt_target'];
$order_ads = (int)$_POST['txt_order'];
$status_ads = (int)$_POST['txt_status'];
$dateadd_ads = date("Y-m-d");

$int_position = (int)$_POST['sle_position'];
$int_visibletitle = (int)$_POST['chk_istitle'];
$int_optbg = (int)$_POST['rb_imagebg'];
$txtcolor = $_POST['get_bgcolor'];


$hidden_width = (int)$_POST['hwidth'];
$hidden_height = (int)$_POST['hheight']; 

$WPopup = 0;
$HPopup = 0;

$IsPopUp = (int)$_POST['chk_ispopup'];
if($IsPopUp==1){
 $WPopup = (int)$_POST['txt_wpopup'];
 $HPopup = (int)$_POST['txt_hpopup'];
}


$banner = new cls_tbl_banner($id);
$banner->settxt_url($url_ads);
$banner->settxt_destino($target_ads);
$banner->setint_orden($order_ads);
$banner->setint_estado($status_ads);
$banner->setint_dateadd($dateadd_ads);
$banner->setint_position($int_position);
$banner->setint_ispopup($IsPopUp);
$banner->setint_popupw($WPopup);
$banner->setint_popuph($HPopup);

#Dimensiones del Banner
$banner->maxwidth = $hidden_width;
$banner->maxheight = $hidden_height;



if($int_position==3){
$banner->setint_titlevisible($int_visibletitle);
$banner->setint_optfondo($int_optbg);
$banner->settxt_optcolor($txtcolor);
}else{
$banner->setint_titlevisible("");
$banner->setint_optfondo("");
$banner->settxt_optcolor("");
}

switch($op)
{
  case 1:	# Save
			$banner->_Save();
			$id = $banner->getpk_banner();
			$banner->Banner_US();
			
  break;
  case 2:   # Update
			$banner->setpk_banner($id);	
			$banner->_Update();
			$banner->Banner_US('Update');

  break;
  case 3:   # Remove
			$banner = new cls_tbl_banner($id);
			$banner->_Remove();	
			
  break;
  case 4:   #Actualizar  status => Activo | Desactivo
			$banner = new cls_tbl_banner($id);
			@$banner->estado();					
  break;
  
  case 5:  #Remover banner sólo los seleccioandos

	if(!empty($_POST["chkbanner"]))
	{	
		foreach($_POST["chkbanner"] as $valor)
		{		if($_POST["chkbanner"])
				{	$banner = new cls_tbl_banner($valor);
					$banner->_Remove();				
				}
		}		// foreach
	}
						
  break;
  case 6:  #Activar los banner seleccionados

	if(!empty($_POST["chkbanner"]))
	{	
		foreach($_POST["chkbanner"] as $valor)
		{		if($_POST["chkbanner"])
				{	$banner = new cls_tbl_banner($valor);
					@$banner->estado("1");				
				}
		}		// foreach
	}
  break;
  
  case 7:  #Desactivar los banner selecciaandos

	if(!empty($_POST["chkbanner"]))
	{	
		foreach($_POST["chkbanner"] as $valor)
		{		if($_POST["chkbanner"])
				{	$banner = new cls_tbl_banner($valor);
					@$banner->estado("0");				
				}
		}		// foreach
	}
  break;
	
	
}

if(($op==1) || ($op==2) || ($op==5) ||   ($op==6) ||  ($op==7) ||  ($op==8) )
{	
	header ("location: inf_banner.php");
}

?>