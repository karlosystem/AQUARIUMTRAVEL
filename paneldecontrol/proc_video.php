<?php
@ob_start();
@session_start();

require_once("../init.php") ;
require_once("loadclass.php") ;

$id= (int)(tep_not_null($_GET['id']))?$_GET['id']:$_POST['id'];
$op= (int)(tep_not_null($_GET['op']))?$_GET['op']:$_POST['op'];
$IsReferrer = $_SERVER['HTTP_REFERER'];


$jutjub = new YouTube();
$getvideo_yt = new cls_tbl_video($id);
    
	$idyt = secure_sql($_POST['txt_yt_thumb']);
	$img_yt = $jutjub->GetImg($idyt) ;
	
	$getvideo_yt->settxt_video_title(secure_sql($_POST['video_title']));
	$getvideo_yt->settxt_yt_id($idyt);
	$getvideo_yt->settxt_yt_thumb($img_yt);
	$getvideo_yt->settxt_yt_id($_POST['txt_yt_thumb']);
	$getvideo_yt->settxt_yt_thumb($_POST['txt_yt_thumb']);
	$getvideo_yt->settxt_dateadd(time());
	$getvideo_yt->setint_estado((int)$_POST['chk_status']);
    $getvideo_yt->setv_destacado((int)$_POST['chk_portada']);
	
switch($op)
{
	case 1:	//guardar
			$getvideo_yt->guarda();
			$idyt_video=$getvideo_yt->getpk_idvideo();
			//$idsec=$getvideo_yt->getpk_video();

	break;
	case 2://Actualizar	
			$getvideo_yt->setpk_idvideo($id);	
			$getvideo_yt->actualiza();
			
	break;
	case 3://Eliminar	
			$getvideo_yt = new cls_tbl_video($id);
			$getvideo_yt->elimina();	
				
	break;
	case 4://Estado	
			$getvideo_yt = new cls_tbl_videoyoutube($id);
			@$getvideo_yt->estado();					
	break;
	case 5://activar check
	if(!empty($_POST["chkvideoyt"]))
	{	
		foreach($_POST["chkvideoyt"] as $valor)
		{		if($_POST["chkvideoyt"])
				{	$getvideo_yt = new cls_tbl_videoyoutube($valor);
					@$getvideo_yt->estado("1");				
				}
		}		// foreach
	}
	break;
	case 6://desactivar check

	if(!empty($_POST["chkvideoyt"]))
	{	
		foreach($_POST["chkvideoyt"] as $valor)
		{		if($_POST["chkvideoyt"])
				{	$getvideo_yt = new cls_tbl_videoyoutube($valor);
					@$getvideo_yt->estado("0");				
				}
		}		// foreach
	}
	break;
	case 7://eliminar check

	if(!empty($_POST["chkvideoyt"]))
	{	
		foreach($_POST["chkvideoyt"] as $valor)
		{		if($_POST["chkvideoyt"])
				{	$getvideo_yt= new cls_tbl_videoyoutube($valor);
					$getvideo_yt->elimina();				
				}
		}		// foreach
	}
						
	break;
}//fin del switch*/

	
if(($op==1) || ($op==2) || ($op==3) ||  ($op==5) ||   ($op==6) ||  ($op==7) )
{	header ("location: inf_videos.php"); }
else if($op!=4)
{	unset($_SESSION['webuser']);
	header ("location: index.php"); }

?>