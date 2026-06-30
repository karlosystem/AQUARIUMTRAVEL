<?php

class cls_tbl_album{

var $pk_album; 
var $txt_datealbum;
var $int_estado;
var $txt_fecadd;

var $replace="y"; #Reemplaza el archivo 

var $upload_dir="";
var $pref_title = 'txt_titlealbum'; #-> txt_titlealbum[]
var $pref_description= 'txt_descriptionalbum'; #Nombre del archivo file


function cls_tbl_album($id=0)
{
	if($id!=0)
	{
		$sql = $GLOBALS['CONNECT_DB']->Query("SELECT * FROM [|PREFIX|]album WHERE pk_album = '".$id."' ORDER BY pk_album DESC");
		$fila = $GLOBALS['CONNECT_DB']->Fetch($sql);
		
		$this->setpk_album($fila['pk_album']);
		$this->settxt_datealbum($fila['album_fecha']);
		$this->setint_status($fila['album_status']);
		$this->setdate_fecadd($fila['album_dateadd']);
	}else{
		$this->setpk_album('');
		$this->settxt_datealbum('');
		$this->setint_status('');
		$this->setdate_fecadd('');
	}
}


function setpk_album($pk_album){  $this->pk_album = $pk_album;}
function getpk_album(){  return $this->pk_album; }

function settxt_datealbum($txt_datealbum){  $this->txt_datealbum = $txt_datealbum;}
function gettxt_datealbum(){  return $this->txt_datealbum; }

function setint_status($int_estado){  $this->int_estado = $int_estado;}
function getint_status(){  return $this->int_estado; }

function setdate_fecadd($txt_fecadd){  $this->txt_fecadd = $txt_fecadd;}
function getdate_fecadd(){  return $this->txt_fecadd; }



function IsExistAlbum(){
$SQL = "SELECT * FROM [|PREFIX|]album WHERE pk_album='".$this->getpk_album()."' ";
$QueryExist = $GLOBALS['CONNECT_DB']->Query($SQL);
$Count = $GLOBALS['CONNECT_DB']->CountResult($QueryExist);
if($Count==0)
return false ;
else
return true ;
}


function get_infolang_album($language_id = ''){

	$sql = "SELECT txt_title,txt_descripcion FROM [|PREFIX|]album_details ";
	$sql .= "WHERE fk_album ='".$this->getpk_album()."' AND language_id='".(int)$language_id."' ";
	
	
	$album_query = $GLOBALS['CONNECT_DB']->Query($sql)or die(mysql_error());
	
	while($FetchInfo = $GLOBALS['CONNECT_DB']->Fetch($album_query)){

	$get_data_array[] = array('title' => $FetchInfo['txt_title'],
							  'description' => $FetchInfo['txt_descripcion']
							   );
	}
	return  $get_data_array ;
}

function get_album_detail($album_id, $language_id = 0) {
    global $languages_id;

    if ($language_id == 0) $language_id = $languages_id;
    $album_query = "SELECT txt_title,txt_descripcion FROM [|PREFIX|]album_details WHERE";
	$album_query .= " fk_album = '" . (int)$album_id . "' and language_id = '" . (int)$language_id . "'" ;
	
	$Query = $GLOBALS['CONNECT_DB']->Query($album_query);
	
	
	while ($FetchAlbum = $GLOBALS['CONNECT_DB']->Fetch($Query)){

	$getalbum[] = array('album_txt_title'=>$FetchAlbum['txt_title'],
	                    'album_txt_descripcion'=>$FetchAlbum['txt_descripcion']
	                   );
	}					    
	return $getalbum;
  }
  
function actualiza()
{	
   $array_modify = array("album_fecha"=>$this->gettxt_datealbum(),
						  "album_status"=>$this->getint_status()
						  );
   $array_where = array("pk_album"=>$this->getpk_album());
   
   update($array_modify,"[|PREFIX|]album",$array_where);

}

function guarda()
{
	$array_content = array("album_fecha"=>$this->gettxt_datealbum(),
						   "album_status"=>$this->getint_status(),
						   "album_dateadd"=>$this->getdate_fecadd()
						   );
	insert($array_content,"[|PREFIX|]album");
	$id = $GLOBALS['CONNECT_DB']->LastId();
    $this->setpk_album($id);

}


function Album_US($IsMode='Create'){
		  $languages = language::tep_get_languages();
		   for ($i=0, $n=sizeof($languages); $i<$n; $i++) {
			 $album_id = $this->getpk_album();
			 $language_id = $languages[$i]['id'];
			 $title_album = secure_sql($_POST[$this->pref_title][$language_id]);
			 $description_album = secure_sql($_POST[$this->pref_description][$language_id]);
		     
			 $sql_data_array = array('fk_album' => $album_id,
				                     'language_id' => $language_id ,
				                     'txt_title' => $title_album,
									 'txt_descripcion' => $description_album
		                             );
			if($IsMode=='Update'){
				$arr_where = array("fk_album"=>$this->getpk_album(),
								   "language_id"=>$language_id
								   );
				
				$Query_exists = $GLOBALS['CONNECT_DB']->Query("SELECT * FROM [|PREFIX|]album_details WHERE fk_album ='".$album_id."' AND language_id='".(int)$language_id."'");
				
				if($GLOBALS['CONNECT_DB']->CountResult($Query_exists)==1)
				 update($sql_data_array,"[|PREFIX|]album_details",$arr_where);
				  else
				 insert($sql_data_array,"[|PREFIX|]album_details");
				
		    }else if($IsMode='Create'){
			    insert($sql_data_array,"[|PREFIX|]album_details");
			}
			
		   }

}

function elimina()
{
	
	$sql_models = "SELECT fotoalbum_big, fotoalbum_prev FROM [|PREFIX|]album_photo WHERE fk_album='".$this->getpk_album()."'"; 
	$Query_models = $GLOBALS['CONNECT_DB']->Query($sql_models);
	while($Fetch = $GLOBALS['CONNECT_DB']->Fetch($Query_models)) {
		deleteFiles(ADMIN_ALBUM_BIG,$Fetch['fotoalbum_big']);
		deleteFiles(ADMIN_ALBUM_MIN,$Fetch['fotoalbum_prev']);
	}

	$GLOBALS['CONNECT_DB']->Query("DELETE FROM [|PREFIX|]album_photo WHERE  fk_album = '".$this->getpk_album()."'");
	$GLOBALS['CONNECT_DB']->Query("DELETE FROM [|PREFIX|]album WHERE pk_album='".$this->getpk_album()."'");
	$GLOBALS['CONNECT_DB']->Query("DELETE FROM [|PREFIX|]album_details WHERE fk_album='".$this->getpk_album()."'");
	
}


function RemovePhoto($IsCPhoto=0){
 $SQL = "SELECT [|PREFIX|]album_photo.fotoalbum_big, [|PREFIX|]album_photo.fotoalbum_prev FROM [|PREFIX|]album_photo WHERE [|PREFIX|]album_photo.id_photoalbum = '".$IsCPhoto."' ";
 $Query_ = $GLOBALS['CONNECT_DB']->Query($SQL);
 $Fetch_ = $GLOBALS['CONNECT_DB']->Fetch($Query_);
    deleteFiles(ADMIN_ALBUM_BIG,$Fetch_['fotoalbum_big']);
	deleteFiles(ADMIN_ALBUM_MIN,$Fetch_['fotoalbum_prev']);
	$GLOBALS['CONNECT_DB']->Query("DELETE FROM [|PREFIX|]album_photo WHERE  id_photoalbum = '".$IsCPhoto."'");
}


function countgalleryalbum_list($QueryParam=''){
if(!tep_not_null($QueryParam)){
$SQL = "SELECT * FROM [|PREFIX|]album Inner Join [|PREFIX|]album_photo ON [|PREFIX|]album.pk_album = [|PREFIX|]album_photo.fk_album
WHERE [|PREFIX|]album_photo.fk_album =  '".$this->getpk_album()."' ORDER BY [|PREFIX|]album_photo.id_photoalbum ASC ";
}else{
$SQL = $QueryParam;
}
 
 $Query = $GLOBALS['CONNECT_DB']->Query($SQL)or die(mysql_error());
 $count = $GLOBALS['CONNECT_DB']->CountResult($Query);
 return $count ;
}


function generate_unique_id(){
	$unique_id = substr(md5(uniqid(time(), true)), 0, 10);
	$Query_unique = "SELECT * FROM [|PREFIX|]album_photo WHERE id_photoalbum='".$unique_id."' ";
	$Query = $GLOBALS['CONNECT_DB']->Query($Query_unique);
	$count = $GLOBALS['CONNECT_DB']->CountResult($Query) ;
	if ($count == 0) 
    { 
        return $unique_id; 
    }
	else 
    { 
        return $this->generate_unique_id(); 
    }
	
}

function existing_file($file_name) {
		if ($this->replace == "y") {
			return true;
		} else {
			if (file_exists($this->upload_dir.$file_name)) {
				return false;
			} else {
				return true;
			}
		}
}

function get_uploaded_file_info($name) 
{
		$str .= "<div id=\"main_infoupload\">";
		$str .= "<div id=\"rowinfo\"><span>&nbsp;Nombre del archivo:</span> ".basename($name).".</div><br>";
		$str .= "<div id=\"rowinfo\"><span>&nbsp;Tama&ntilde;o del archivo:</span> ".sizefile_server($name).".</div><br>";
		if (function_exists("mime_content_type")) {
			$str .= "<div id=\"rowinfo\"><span>&nbsp;Mime type:</span>".mime_content_type($name).".</div>";
		}

		$str .= "<div id=\"divition_inform\"></div>";
		
		return $str;
}
	
function save_images($file_upload){
  $code_new = "";
  $str_info = "";
  
  if(tep_not_null($_FILES[$file_upload])){

	 while(list($key,$value) = each($_FILES[$file_upload]['name']))
	 {
	   
	   if(!empty($value)){
	      $filename = $value;
		  $filename = str_replace(" ","_",$filename); # remuevo los caracteres especiales a tipo html : prueba_archivo_subido
		  $filename = remove_accents($filename);
		  $uploaded_socbig = ADMIN_ALBUM_BIG.'big_'.$filename;
		  $uploaded_socpreview = ADMIN_ALBUM_MIN.'min_'.$filename;
		  
		  $code_new = $this->generate_unique_id();
		  
		  # Proceso de subir archivo grande.
	if($this->existing_file($uploaded_socbig)) {
		      
		if(move_uploaded_file($_FILES[$file_upload]['tmp_name'][$key],$uploaded_socbig)) {
		 
		  #Proceso a redimensionar la imagen de la modelo
		  require_once("../include/class/thumbnail.inc.php");
		  #Vista Grande
		  
		  $resize_image = new Thumbnail($uploaded_socbig);
	      $resize_image->resize(WALBUMALBUM_BIG,HALBUMALBUM_BIG);
	      $resize_image->save($uploaded_socbig); 


		  #Vista lista
		  $resize_image = new Thumbnail($uploaded_socbig);
	      //$resize_image->crop(0,0,WALBUMALBUM_MIN,HALBUMALBUM_MIN);
	      $resize_image->resize(WALBUMALBUM_MIN,HALBUMALBUM_MIN);
		  $resize_image->save($uploaded_socpreview); 
		 
		 $array_content = array("id_photoalbum"=>$code_new,
						   "fk_album"=>$this->getpk_album(),
						   "fotoalbum_big"=>'big_'.$filename,
						   "fotoalbum_prev"=>'min_'.$filename
						   );
	     insert($array_content,"[|PREFIX|]album_photo");
		 
		 $str_info .= $this->get_uploaded_file_info($uploaded_socbig);
		     }
		  }
	   }
	 
	   
	  
	 }
   return $str_info ;
  }
}



function estado($estado)
{	$est=$estado;
	if($estado=="")
	{	$estado=($this->getint_status()=="1")?"0":"1";}

	$sql = "UPDATE [|PREFIX|]album
				SET album_status='".$estado."'
			WHERE pk_album = '".$this->getpk_album()."'";
	$GLOBALS['CONNECT_DB']->Query($sql);
	if($est=="")
	{
		$icono = "ico_estado".$estado.".gif";
		echo "<a href='javascript:UpdateStatus(".$this->getpk_album().")'>
 			  <img src='"._URL."admin/images/icons/".$icono."' border='0'></a>";
	}
}



function lista($sql="")
{
	if(!tep_not_null($sql)){
	$sql = $GLOBALS['CONNECT_DB']->Query("SELECT * FROM [|PREFIX|]album ORDER BY pk_album DESC");
	}else{
	$sql = $GLOBALS['CONNECT_DB']->Query($sql);
	}
	
	$i=0;
	while($Fetch = $GLOBALS['CONNECT_DB']->Fetch($sql))
	{
		$arreglo[$i]['pk_album'] = $Fetch['pk_album'];
		$arreglo[$i]['album_fecha'] = $Fetch['album_fecha'];
		$arreglo[$i]['album_status'] = $Fetch['album_status'];
		$arreglo[$i]['album_dateadd'] = $Fetch['album_dateadd'];
	 $i++;
	}
	return $arreglo;
}

function ImgAlbum_Rand($cid=0){
	$SQL = "SELECT id_photoalbum,fk_album,fotoalbum_big,fotoalbum_prev FROM [|PREFIX|]album_photo WHERE fk_album='".(int)$cid."'";
	$Query = $GLOBALS['CONNECT_DB']->Query($SQL);
	while($Fetch = $GLOBALS['CONNECT_DB']->Fetch($Query)){
		$array_imagesalbum[] = array("id_photoalbum"=>$Fetch['id_photoalbum'],
		                             "fk_album"=>$Fetch['fk_album'],
									 "fotoalbum_big"=>$Fetch['fotoalbum_big'],
									 "fotoalbum_prev"=>$Fetch['fotoalbum_prev']
									 );
	}
	return $array_imagesalbum;
}


function ListPhoto($from = 0, $to = 20, $page = 1){
  global $languages_code;
  
  $SQL = "SELECT pk_album, album_fecha  FROM [|PREFIX|]album WHERE album_status =  '1'";
  $SQL .= " ORDER BY album_fecha DESC LIMIT ".$from.", ".$to." ";
 
 $Query = $GLOBALS['CONNECT_DB']->Query($SQL)or die(mysql_error());
 $count = $GLOBALS['CONNECT_DB']->CountResult($Query);
 $strgal_album = "";
 
  if($count >= 1) {
    $strgal_album = "";
	 $j=1;
	 while($Fetch = $GLOBALS['CONNECT_DB']->Fetch($Query)) {
	  $InfoAl = $this->get_album_detail($Fetch['pk_album']);
	  $Url=_URL.'viewfoto.php?pid='.$Fetch['pk_album'];
      $Title=stripslashes_deep($InfoAl[0]['album_txt_title']);
	  $Title = utf8_decode($Title);
	  $DateAlbum = $Fetch['album_fecha'];
	  $ImgRand = $this->ImgAlbum_Rand($Fetch['pk_album']);
	  $cls_date = new dateconvert_language;
      $cls_date->language = $languages_code ;
	  $ThisDate = $cls_date->get_date_spanish(strtotime($DateAlbum));
	  
	  $folderimg_encode64 = $ImgRand;
	  $folderimg_encode64 = $folderimg_encode64[0]['fotoalbum_big'];
	  
	  $folderimg_encode64 = base64_encode(PUBLIC_ALBUM_BIG.$folderimg_encode64);

			$strgal_album .= "<li>";
			$strgal_album .= "<a class=\"bgcolor bordercolor\" href=\"$Url\" title=\"$Title\">";
			$strgal_album .= tep_image(_URL.'resize.php?image='.$folderimg_encode64.'&w=170&h=160&IsCrop=0',$Title,'','','class="bordercolor"');
			$strgal_album .= "<span>".$Title."</span>";
			$strgal_album .= "<strong></strong>";
			$strgal_album .= "</a>";
			$strgal_album .= "</li>";
	   
	  $j++;
	 }	 
  }
  $GLOBALS['CONNECT_DB']->FreeResult($Query);
  return $strgal_album ;
}



function ListPhoto_album(){
  global $languages_code;
  
 $SQL = "SELECT tbl_album_photo.id_photoalbum, tbl_album_photo.fotoalbum_big, tbl_album_photo.fotoalbum_prev FROM tbl_album Inner Join tbl_album_photo";
 $SQL .= " ON tbl_album.pk_album = tbl_album_photo.fk_album WHERE tbl_album.album_status =  '1' AND tbl_album_photo.fk_album =  '".$this->getpk_album()."'";
 $SQL .= " ORDER BY tbl_album_photo.id_photoalbum ASC ";
 
 $Query = $GLOBALS['CONNECT_DB']->Query($SQL)or die(mysql_error());
 $count = $GLOBALS['CONNECT_DB']->CountResult($Query);
 $strgal_album = "";
 
  if($count >= 1) {
    $strgal_album = "<div class=\"ImageListTop\">";
	 $j=0;
	 while($Fetch = $GLOBALS['CONNECT_DB']->Fetch($Query)) {
	  $InfoAl = $this->get_album_detail($Fetch['pk_album']);
	  $Url = _URL.PUBLIC_ALBUM_BIG.$Fetch['fotoalbum_big'];
	  $image_url = PUBLIC_ALBUM_MIN.$Fetch['fotoalbum_prev'];
	  $thisactive = ($j==0)?'style="display: block;"':'style="display: none;"';
	  $thischecked = ($j==0)?'class="selected"':'';

	  $strgal_album .= "<div id=\"album-{$Fetch['id_photoalbum']}\" $thisactive>";
	    $strgal_album .= "<div class=\"Img\">";
			$strgal_album .= tep_image($Url);
         $strgal_album .= "</div>";
	  $strgal_album .= "</div>"; 
	  $j++;
	  
	  #Link Bottom Images
	  $this_bottom .= "<li class=\"ThumbImage\"><a href=\"#album-{$Fetch['id_photoalbum']}\" $thischecked>".tep_image("resize.php?image=".$image_url."&w=80&h=55&IsCrop=0",$Title,'','','class="border_img"')."</a></li>";
	  
	 }
	 $strgal_album .= "</div>";#Cierra ImageListTop
	 
	 $strgal_album .= "<ul class=\"idTabs\">";
	   $strgal_album .= $this_bottom;
	 $strgal_album .= "</ul>";
	 	 
  }
  $GLOBALS['CONNECT_DB']->FreeResult($Query);
  return $strgal_album ;
}


}# Fin de la clase
?>