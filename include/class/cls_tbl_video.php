<?php

class cls_tbl_video extends YouTube{

var $pk_video; 
var $txt_titulo;
var $txt_yt_id;
var $txt_yt_thumb;
var $txt_added;
var $int_estado;
var $v_destacado;

function cls_tbl_video($id=0)
{
    
	if($id!=0)
	{
		$sql = $GLOBALS['CONNECT_DB']->Query("select * from tbl_video where id = '".$id."' order by id desc") or $db->error();
		$fila = $GLOBALS['CONNECT_DB']->Fetch($sql);
		$this->setpk_idvideo($fila['id']);
		$this->settxt_video_title($fila['video_title']);
		$this->settxt_yt_id($fila['yt_id']);
		$this->settxt_yt_thumb($fila['yt_thumb']);
		$this->settxt_dateadd($fila['added']);
		$this->setint_estado($fila['status']);
		$this->setv_destacado($fila['video_destacado']);
	}else{
		$this->setpk_idvideo('');
		$this->settxt_video_title('');
		$this->settxt_yt_id('');
		$this->settxt_yt_thumb('');
		$this->settxt_dateadd('');
		$this->setint_estado('');
		$this->setv_destacado('');
	}

}

function setpk_idvideo($pk_video){  $this->pk_video = $pk_video;}
function getpk_idvideo(){  return $this->pk_video; }

function settxt_video_title($txt_titulo){  $this->txt_titulo = $txt_titulo;}
function gettxt_video_title(){  return $this->txt_titulo; }

function settxt_yt_id($txt_yt_id){  $this->txt_yt_id = $txt_yt_id;}
function gettxt_yt_id(){  return $this->txt_yt_id; }

function settxt_yt_thumb($txt_yt_thumb){  $this->txt_yt_thumb = $txt_yt_thumb;}
function gettxt_yt_thumb(){  return $this->txt_yt_thumb; }

function settxt_dateadd($txt_added){  $this->txt_added = $txt_added;}
function gettxt_dateadd(){  return $this->txt_added; }

function setint_estado($int_estado){  $this->int_estado = $int_estado;}
function getint_estado(){  return $this->int_estado; }

function setv_destacado($v_destacado){  $this->v_destacado = $v_destacado;}
function getv_destacado(){  return $this->v_destacado; }


function elimina()
{   
    
	$sql = "delete from tbl_video where id = '".$this->getpk_idvideo()."'";
	$GLOBALS['CONNECT_DB']->Query($sql);
}

function guarda()
{   
    
	$sql = "insert into tbl_video(
	video_title,
	yt_id,
	yt_thumb,
	added,
	status,
	video_destacado
	) values ( 
	'".$this->gettxt_video_title()."',
	'".$this->gettxt_yt_id()."',
	'".$this->gettxt_yt_thumb()."',
	'".$this->gettxt_dateadd()."',
	'".$this->getint_estado()."',
	'".$this->getv_destacado()."'
	)";
	
	$id = $GLOBALS['CONNECT_DB']->Query($sql) or die($db->error());
	$idnew = $GLOBALS['CONNECT_DB']->LastId();
	$this->setpk_idvideo($idnew);
}

function actualiza()
{	 
    
	$sql = " update tbl_video set
				video_title = '".$this->gettxt_video_title()."',
				yt_id = '".$this->gettxt_yt_id()."',
				yt_thumb = '".$this->gettxt_yt_thumb()."',
				status = ".$this->getint_estado().",
				video_destacado = ".$this->getv_destacado()."
			 where id='".$this->getpk_idvideo()."' ";
	echo $sql;			 
			 
	$GLOBALS['CONNECT_DB']->Query($sql);

}

function estado($estado)
{	
    
    $est=$estado;
	if($estado=="")
	{	$estado=($this->getint_estado()=="1")?"0":"1";}

	$sql = "UPDATE tbl_video
				SET status='".$estado."'
			WHERE id = '".$this->getpk_idvideo()."'";
	$GLOBALS['CONNECT_DB']->Query($sql);
	if($est=="")
	{
		$icono = "ico_estado".$estado.".gif";
		echo "<a href='javascript:ajax_estado(".$this->getpk_idvideo().")'>
 			  <img src='images/icons/".$icono."' border='0'></a>";
	}
}


function lista($sql="")
{  
    
	if(!tep_not_null($sql)){
	$sql = $GLOBALS['CONNECT_DB']->Query("select * from tbl_video order by id desc");
	}else{
	$sql = $GLOBALS['CONNECT_DB']->Query($sql);
	}
	//$rs = $GLOBALS['VIL_CLASS_DB']->Fetch($sql);
	$i=0;
	//for($i=0;$i<count($rs);$i++)
	while($Fetch = $GLOBALS['CONNECT_DB']->Fetch($sql))
	{
		$arreglo[$i]['id'] = $Fetch['id'];
		$arreglo[$i]['video_title'] = $Fetch['video_title'];
		$arreglo[$i]['yt_id'] = $Fetch['yt_id'];
		$arreglo[$i]['yt_thumb'] = $Fetch['yt_thumb'];
		$arreglo[$i]['added'] = $Fetch['added'];
		$arreglo[$i]['status'] = $Fetch['status'];
		$arreglo[$i]['video_destacado'] = $Fetch['video_destacado'];
	 $i++;
	}
	
	return $arreglo;
}


function IsExistVideo(){
	$SQL = "SELECT * FROM [|PREFIX|]video WHERE id='".$this->getpk_idvideo()."' ";
	$QueryExist = $GLOBALS['CONNECT_DB']->Query($SQL);
	$Count = $GLOBALS['CONNECT_DB']->CountResult($QueryExist);
	if($Count==0)
	return false ;
	else
	return true ;
}



function video_portada($sql="")
{  
    
	if(!tep_not_null($sql)){
	$sql = $GLOBALS['CONNECT_DB']->Query("SELECT case `v_destacado` when '1' then 'SI' when '0' then 'NO' END as condicion, id, video_title, date_video, yt_id, yt_thumb, added, status FROM video order by id desc");
	}else{
	$sql = $GLOBALS['CONNECT_DB']->Query($sql);
	}
	//$rs = $GLOBALS['VIL_CLASS_DB']->Fetch($sql);
	$i=0;
	//for($i=0;$i<count($rs);$i++)
	while($Fetch = $GLOBALS['CONNECT_DB']->Fetch($sql))
	{
		$arreglo[$i]['id'] = $Fetch['id'];
		$arreglo[$i]['video_title'] = $Fetch['video_title'];
		$arreglo[$i]['yt_id'] = $Fetch['yt_id'];
		$arreglo[$i]['yt_thumb'] = $Fetch['yt_thumb'];
		$arreglo[$i]['added'] = $Fetch['added'];
		$arreglo[$i]['status'] = $Fetch['status'];
		$arreglo[$i]['condicion'] = $Fetch['condicion'];
	 $i++;
	}
	
	return $arreglo;
}

function showvideo_destacado() {
$SQL = "SELECT video.id, video.video_title, video.date_video, video.yt_id, video.yt_thumb FROM video WHERE video.status =  '1' ORDER BY video.added DESC LIMIT 0, 1" ;
$Query = $GLOBALS['CONNECT_DB']->Query($SQL);
$CountResult = $GLOBALS['CONNECT_DB']->CountResult($Query);
	if($CountResult==1) {
	 $Fetch = $GLOBALS['CONNECT_DB']->Fetch($Query);
	     $show_video = $this->EmbedVideo($Fetch['yt_id'],273,142);
	     return $show_video;
	}


}

function mainvideos_gallery($from = 0, $to = 5, $page = 1){
$SQL = "SELECT [|PREFIX|]video.id, [|PREFIX|]video.video_title, [|PREFIX|]video.yt_id, [|PREFIX|]video.yt_thumb, [|PREFIX|]video.added FROM [|PREFIX|]video WHERE [|PREFIX|]video.status =  '1' ORDER BY [|PREFIX|]video.added DESC LIMIT ".$from.", ".$to." ";
 
 $Query = $GLOBALS['CONNECT_DB']->Query($SQL);
 $count = $GLOBALS['CONNECT_DB']->CountResult($Query);
 if($count >= 1) {
 $strgal_video = "";
   
  while($Fetch = $GLOBALS['CONNECT_DB']->Fetch($Query)) {

      $title_complete = secure_sql($Fetch['video_title']);
	  $cls_yt = new YouTube(); 


	  		$strgal_video .= "<li>";
			$strgal_video .= "<a class=\"bgcolor bordercolor\" href=\"http://www.youtube.com/watch?v={$Fetch['yt_id']}\" rel=\"YouTube\" title=\"$Title\">";			
			$strgal_video .= "<img src=\"http://img.youtube.com/vi/{$Fetch['yt_thumb']}/1.jpg\" style=\"width:170px; height:160px;\" class=\"bordercolor\" alt=\"AMERICAN EXPEDITIONS\"/>";
			
			$strgal_video .= "<span>".$title_complete."</span>";
			$strgal_video .= "<strong></strong>";
			$strgal_video .= "</a>";
			$strgal_video .= "</li>";
	 	  
  }
  return $strgal_video ;
 }
 
}


function ListVideo($from = 0, $to = 20, $page = 1){
  $SQL = "SELECT [|PREFIX|]video.id, [|PREFIX|]video.video_title, [|PREFIX|]video.yt_id, [|PREFIX|]video.yt_thumb, [|PREFIX|]video.added FROM [|PREFIX|]video WHERE [|PREFIX|]video.status =  '1' ORDER BY [|PREFIX|]video.added DESC LIMIT ".$from.", ".$to." ";
 
 $Query = $GLOBALS['CONNECT_DB']->Query($SQL);
 $count = $GLOBALS['CONNECT_DB']->CountResult($Query);
 $strgal_album = "";
 
  if($count >= 1) {
  $strgal_album = "";
  $strgal_album = "<table cellspacing=\"10\" cellpadding=\"10\" bordercolor=\"#FFFFFF\" border=\"1\" width=\"100%\"class=\"tablem_album\" >";
 
  $ncol = 3 ; # Numero de Columnas;
  $ncounter = 1;
  $Url = "";
  $title_video = "";
  
  $cls_youtube = new YouTube();
  
  while($Fetch = $GLOBALS['CONNECT_DB']->Fetch($Query)) {
	    $folderimg_encode64 = "";
		
		if($ncounter==1 || $ncounter>3){
		$strgal_album .= "<tr>";
		$ncounter = 1;
		}
		
		 $Url = 'http://www.youtube.com/v/'.$Fetch['yt_id'];
		
		$title_video = secure_sql($Fetch['video_title']);
		 
		$strgal_album .= "<td width=\"33%\" height=\"100\" align=\"center\" valign=\"top\">";
	    $strgal_video .= "<a href=\"http://www.youtube.com/watch?v={$Fetch['yt_id']}\" rel=\"YouTube\">";  
		
		
		$image_url = $cls_youtube->ShowImg($Fetch['yt_id'],1,150,100);
		
		$strgal_album .= $image_url;
		
		$strgal_album .= "</a>";
		
		
		$strgal_album .= "<br>";
		$strgal_album .= "<span class=\"titulo2\">$title_video</span>";
		$strgal_album .= "<br>";
		

								
		$strgal_album .= "</td>";
		
	  if($count==$ncounter ){
	    
		if($count<$ncol)
		$Dividendo = (int)($ncol-$ncounter);
		
		for($k=1;$k<=$Dividendo;$k++){
		 $strgal_album .= "<td width=\"150\" height=\"100\" align=\"center\" valign=\"top\">";
		 $strgal_album .= "";
		 $strgal_album .= "</td>";
		}
		
	  }
	  if($ncounter==$ncol)
	  $strgal_album .= "</tr>";
	  
	  $ncounter++;
	 }
   $strgal_album .= "</tbody>";
   $strgal_album .= "</table>";
 }
 else{
 $strgal_album = "<div style=\"width:100%;padding:5px 0;\" class=\"ac\">No hay resultados de videos en esta sección</div>";
 }
 
 return $strgal_album ;
}

/*********************************************************/
function videohome(){
 $SQL = "SELECT video.id, video.video_title, video.date_video, video.yt_id, video.yt_thumb, video.v_destacado FROM video WHERE  video.status =  '1' and video.v_destacado = '1'";
 
$Query = $GLOBALS['CONNECT_DB']->Query($SQL);
	if($GLOBALS['CONNECT_DB']->CountResult($Query)>0) {
	  $Fetch = $GLOBALS['CONNECT_DB']->Fetch($Query);
      $cls_yt = new YouTube(); 
	  $strgal_video .= "<div style=\"padding-left:18px;\">";
	  $strgal_video .= "<a class=\"play\"  title=\"".secure_sql($Fetch['video_title'])."\"href=\"http://www.youtube.com/watch?v={$Fetch['yt_id']}\" rel=\"YouTube\" > </a>";

	  
	  //$strgal_video .= "<a  href=\"videos.php#video-{$Fetch['id']}\" title=\"".secure_sql($Fetch['video_title'])."\" rel=\"YouTube\" class=\"zoom\">";
	  //$strgal_video .= "<img src=\"".$Fetch['yt_thumb']."\" height=\"260\" width=\"348\" />";
	  $strgal_video .= "<br><center>";
	  $strgal_video .= $cls_yt->EmbedVideo($Fetch['yt_id'],250,150);
	  //$strgal_video .= "</a>";
	  $strgal_video .= "</center>";
	  $strgal_video .="<table align=\"center\" width=\"100%\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\">";
	  $strgal_video .= "<tr>";
	  $strgal_video .= "<td style=\"color:#CCCCCC; font-weight:bold;padding:0 4px;\">".fewchars($Fetch['video_title'],50)."</td>";
	  $strgal_video .= "</tr>";
	   $strgal_video .= "<tr>";
        $strgal_video .= "<td align=\"right\" style=\"color:#FFFFFF; font-weight:bold;font-size:12px; text-align:right;\"><a href=\"videos.php\"><img border=0 src=\"images/boton_vermas.jpg\"></a></td>";
       $strgal_video .= "</tr>";	 
      $strgal_video .= "</table>";
	  $strgal_video .= "</div>";

	  
	  return $strgal_video ;
	}
}
/**********************************************************/
/**********************
* IFRAME VIDEO DEL CONTENIDO
**********************/
function IframeVideoContent(){

$SQL = "SELECT video.id, video.video_title, video.date_video, video.yt_id, video.yt_thumb, video.v_destacado FROM video WHERE video.status =  '1'
ORDER BY video.added DESC ";

$Query = $GLOBALS['CONNECT_DB']->Query($SQL);
$IsCount = $GLOBALS['CONNECT_DB']->CountResult($Query);

		if($IsCount>0) {
		   $ccount=0;
		   $str_frame = "";
		   $thisactive = "";
		   $this_right = "";
		   
		   $str_frame .= "<div id=\"video-frame\">"; #Contenedor absoluto del Video
		   $str_frame .= "<div class=\"video-left\">"; # Visualización del Video
		   
		   $this_right .= "<div class=\"video-right\">"; # A3
		   $this_right .= "<h2>ULTIMOS VIDEOS</h2>";
		   $this_right .= "<p>Haz click en los videos para ver...</p>";
		   $this_right .= "<div id=\"container-video\">";
		   $this_right .= "<ul class=\"idTabs\">"; # A4


		  while($Fetch = $GLOBALS['CONNECT_DB']->Fetch($Query)) {
		      $thisactive = ($ccount==0)?'style="display: block;"':'';
			  $thischecked = ($ccount==0)?'class="selected"':'';
		      
			  #Generación de Embed Video YouTube
			  $str_frame .= "<div id=\"video-{$Fetch['id']}\" $thisactive>";
			  $str_frame .= "<div class=\"video\">";
			  
			  $cls_yt = new YouTube();
			  $video_embed = $cls_yt->EmbedVideo($Fetch['yt_id'],560,330);
			  $str_frame .= $video_embed ;
			  //$str_frame .= $Fetch['v_embed'];
			  $str_frame .= "</div>";
			  
			  $str_frame .= "</div>";
			  #Generación de Embed Video YouTube
			  
			  $this_right .= "<li><a href=\"#video-{$Fetch['id']}\" $thischecked>{$Fetch['video_title']}</a></li>";
		     
			 $ccount++;
		   
		   }
		   
			  $str_frame .= "</div>";
			  
			  $this_right .= "</ul>";
		      $this_right .= "</div>";
			  
			  $this_right .= "</div><!--/video-right -->";
			  $str_frame .= $this_right ;

		      $str_frame .= "</div><!--/video-left -->";
			  
		
		}
		return $str_frame;

}


} // fin de la clase

?>