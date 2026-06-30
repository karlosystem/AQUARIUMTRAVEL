<?php

class cls_tbl_banner{

var $pk_banner; 
var $txt_url;
var $txt_destino;
var $int_orden;
var $int_estado;
var $txt_dateadd;

var $int_position;
var $txt_visibletitle;
var $int_fondo;
var $txt_colorfondo;

var $maxwidth;
var $maxheight;


var $path_ad = ""; # Ruta especifica del directorio banner
var $pref_title = 'name_banner'; #-> name_banner[]
var $pref_description = 'description_banner';#-> description_banner[]
var $pref_file = 'file_upads'; #Nombre del archivo file
var $pref_file_hidden = 'file_updas_hidden'; # Nombre del hidden file

var $position_int ;
var $width_container = 690;
var $height_container = 346;
var $position_int_aditional;

var $int_ispopup;
var $widthpopup=0;
var $heightpopup=0;
function cls_tbl_banner($id=0)
{

	if($id!=0)
	{
		$sql = $GLOBALS['CONNECT_DB']->Query("SELECT * FROM [|PREFIX|]banner WHERE pk_banner = '".$id."' ORDER BY pk_banner DESC");
		$fila = $GLOBALS['CONNECT_DB']->Fetch($sql);
		$this->setpk_banner($fila['pk_banner']);
		$this->settxt_url($fila['txt_url']);
		$this->settxt_destino($fila['txt_destino']);
		$this->setint_orden($fila['int_orden']);
		$this->setint_estado($fila['int_estado']);
		$this->setint_dateadd($fila['date_add']);
		$this->setint_position($fila['int_position']);
		$this->setint_titlevisible($fila['txt_visibletitle']);
		$this->setint_optfondo($fila['int_fondo']);
		$this->settxt_optcolor($fila['txt_colorfondo']);
		
		$this->setint_ispopup($fila['int_ispopup']);
		$this->setint_popupw($fila['txt_winwidth']);
		$this->setint_popuph($fila['txt_winheight']);
		
	}else{
		$this->setpk_banner('');
		$this->settxt_url('');
		$this->settxt_destino('');
		$this->setint_orden('');
		$this->setint_estado('');
		$this->setint_dateadd('');
		$this->setint_position('');
		$this->setint_titlevisible('');
		$this->setint_optfondo('');
		$this->settxt_optcolor('');
		
		$this->setint_ispopup('');
		$this->setint_popupw('');
		$this->setint_popuph('');
	}
}

function setpk_banner($pk_banner){  $this->pk_banner = $pk_banner;}
function getpk_banner(){  return $this->pk_banner; }

function settxt_url($txt_url){  $this->txt_url = $txt_url;}
function gettxt_url(){  return $this->txt_url; }

function settxt_destino($txt_destino){  $this->txt_destino = $txt_destino;}
function gettxt_destino(){  return $this->txt_destino; }

function setint_orden($int_orden){  $this->int_orden = $int_orden;}
function getint_orden(){  return $this->int_orden; }

function setint_estado($int_estado){  $this->int_estado = $int_estado;}
function getint_estado(){  return $this->int_estado; }

function setint_dateadd($txt_dateadd){  $this->txt_dateadd = $txt_dateadd;}
function getint_dateadd(){  return $this->txt_dateadd; }

function setint_position($int_position){  $this->int_position = $int_position;}
function getint_position(){  return $this->int_position; }

function setint_titlevisible($txt_visibletitle){  $this->txt_visibletitle = $txt_visibletitle;}
function getint_titlevisible(){  return $this->txt_visibletitle; }

function setint_optfondo($int_fondo){  $this->int_fondo = $int_fondo;}
function getint_optfondo(){  return $this->int_fondo; }

function settxt_optcolor($txt_colorfondo){  $this->txt_colorfondo = $txt_colorfondo;}
function gettxt_optcolor(){  return $this->txt_colorfondo; }

function setint_ispopup($int_ispopup){  $this->int_ispopup = $int_ispopup;}
function getint_ispopup(){  return $this->int_ispopup; }

function setint_popupw($widthpopup){  $this->widthpopup = $widthpopup;}
function getint_popupw(){  return $this->widthpopup; }

function setint_popuph($heightpopup){  $this->heightpopup = $heightpopup;}
function getint_popuph(){  return $this->heightpopup; }


function _Remove()
{

    $languages = language::tep_get_languages();
    
	for ($i=0, $n=sizeof($languages); $i<$n; $i++) {
		$SqlLang="";
		$PathFolder = DIR_WS_ADMIN_LANGUAGES.$languages[$i]['directory'].'/'._BANNERS;
		
		$SqlLang = "SELECT txt_imagen FROM [|PREFIX|]banners_details WHERE fk_banner = '".$this->getpk_banner()."' AND language_id='".$languages[$i]['id']."' ";
	    $QueryLang = $GLOBALS['CONNECT_DB']->Query($SqlLang);
		$CountBanner = $GLOBALS['CONNECT_DB']->CountResult($QueryLang);
		 if($CountBanner==1){
		   $FetchBanner = $GLOBALS['CONNECT_DB']->Fetch($QueryLang);
		   $ImgBanner = $FetchBanner['txt_imagen'];
		   
			if(tep_not_null($ImgBanner) && file_exists($PathFolder.$ImgBanner)){
		     deleteFiles($PathFolder,$ImgBanner);
			}
		 }
	}
	$GLOBALS['CONNECT_DB']->Query("DELETE FROM [|PREFIX|]banners_details WHERE fk_banner = '".$this->getpk_banner()."'");
	$GLOBALS['CONNECT_DB']->Query("DELETE FROM [|PREFIX|]banner WHERE pk_banner = '".$this->getpk_banner()."'");
	
}

function _Save()
{

	$array_content = array("txt_url"=>$this->gettxt_url(),
						   "txt_destino"=>$this->gettxt_destino(),
						   "int_orden"=>$this->getint_orden(),
						   "int_estado"=>$this->getint_estado(),
						   "date_add"=>$this->getint_dateadd(),
						   "int_position"=>$this->getint_position(),
						   "txt_visibletitle"=>$this->getint_titlevisible(),
						   "int_fondo"=>$this->getint_optfondo(),
						   "txt_colorfondo"=>$this->gettxt_optcolor(),
						   "int_ispopup"=>$this->getint_ispopup(),
						   "txt_winwidth"=>$this->getint_popupw(),
						   "txt_winheight"=>$this->getint_popuph()
						   );
	insert($array_content,"[|PREFIX|]banner");
	$id = $GLOBALS['CONNECT_DB']->LastId();
    $this->setpk_banner($id);

}

function _Update()
{
	
	$array_modify = array("txt_url"=>$this->gettxt_url(),
						  "txt_destino"=>$this->gettxt_destino(),
						  "int_orden"=>$this->getint_orden(),
						  "int_estado"=>$this->getint_estado(),
						  "int_position"=>$this->getint_position(),
						  "txt_visibletitle"=>$this->getint_titlevisible(),
						  "int_fondo"=>$this->getint_optfondo(),
						  "txt_colorfondo"=>$this->gettxt_optcolor(),
						  "int_ispopup"=>$this->getint_ispopup(),
						   "txt_winwidth"=>$this->getint_popupw(),
						   "txt_winheight"=>$this->getint_popuph()
						  );
	$array_where = array("pk_banner"=>$this->getpk_banner());
	
	update($array_modify,"[|PREFIX|]banner",$array_where);

}


function Banner_US($IsMode='Create'){#Banner_UpdateSave
		  $languages = language::tep_get_languages();
		   for ($i=0, $n=sizeof($languages); $i<$n; $i++) {
			 $banner_id = $this->getpk_banner();
			 $language_id = $languages[$i]['id'];
			 $name_banner = secure_sql($_POST[$this->pref_title][$language_id]);
			 $description_banner = secure_sql($_POST[$this->pref_description][$language_id]);
			 $file_banner = secure_sql($_POST[$this->pref_file_hidden][$language_id]);
		     
			
			#Subir el banner si a seleccionado  .....
			$NewFile = $_FILES[$this->pref_file]['name'][$language_id];
			$TempFile = $_FILES[$this->pref_file]['tmp_name'][$language_id];
			$UniqueId = generate_unique_id();

				$filename = $NewFile;
		        $filename = str_replace(" ","_",$filename);	
				$filename = remove_accents($filename);

				$save_folder_banner = DIR_WS_ADMIN_LANGUAGES.$languages[$i]['directory'].'/'._BANNERS.$UniqueId.'_'.$filename;
				
				  if(move_uploaded_file($TempFile,$save_folder_banner)) {
					 $file_banner = $UniqueId.'_'.$filename;
					
					
					
					#Subir el banner si a seleccionado  .....
					#Manipulamos las dimensiones de la imagen
					$cls_resize = new Thumbnail($save_folder_banner);
					$cls_resize->resize($this->maxwidth,$this->maxheight);
					$cls_resize->save($save_folder_banner);
					$img_temp = $_POST[$this->pref_file_hidden][$language_id];
					deleteFiles(DIR_WS_ADMIN_LANGUAGES.$languages[$i]['directory'].'/'._BANNERS,$img_temp);

			      }
					
			
			
			 			
			$sql_data_array = array('fk_banner' => $banner_id,
				                     'language_id' => $language_id ,
				                     'txt_title' => $name_banner,
									 'txt_description' => $description_banner,
									 'txt_imagen' => $file_banner
		                             );
			 
			if($IsMode=='Update'){
				$arr_where = array("fk_banner"=>$this->getpk_banner(),
								   "language_id"=>$language_id
								   );
				
				$Query_exists = $GLOBALS['CONNECT_DB']->Query("SELECT * FROM [|PREFIX|]banners_details WHERE fk_banner ='".$banner_id."' AND language_id='".(int)$language_id."'");
				
				if($GLOBALS['CONNECT_DB']->CountResult($Query_exists)==1)
				 update($sql_data_array,"[|PREFIX|]banners_details",$arr_where);
				  else
				 insert($sql_data_array,"[|PREFIX|]banners_details");
				
		    }else if($IsMode='Create'){
			     insert($sql_data_array,"[|PREFIX|]banners_details");
			}
			
		   }
}

	   
function get_infolang_banner($language_id = ''){

	$sql = "SELECT txt_title,txt_imagen,txt_description FROM [|PREFIX|]banners_details ";
	$sql .= "WHERE fk_banner ='".$this->getpk_banner()."' AND language_id='".(int)$language_id."' ";
	$article_query = $GLOBALS['CONNECT_DB']->Query($sql);
	
	while($FetchInfo = $GLOBALS['CONNECT_DB']->Fetch($article_query)){

	$get_data_array[] = array('title' => $FetchInfo['txt_title'],
	                          'description' => $FetchInfo['txt_description'],
							  'image' => $FetchInfo['txt_imagen']
							   );
	}
    return  $get_data_array ;
}

function estado($estado)
{	$est=$estado;
	if($estado=="")
	{	$estado=($this->getint_estado()=="1")?"0":"1";}

	$sql = "UPDATE [|PREFIX|]banner
				SET int_estado='".$estado."'
			WHERE pk_banner = '".$this->getpk_banner()."'";
	$GLOBALS['CONNECT_DB']->Query($sql);
	if($est=="")
	{
		$icono = "ico_estado".$estado.".gif";
		echo "<a href='javascript:UpdateStatus(".$this->getpk_banner().")'>
 			  <img src='"._URL."admin/images/icons/".$icono."' border='0'></a>";
	}
}

function lista($sql="")
{

	if(!tep_not_null($sql)){
	$sql = $GLOBALS['CONNECT_DB']->Query("SELECT * FROM [|PREFIX|]banner ORDER BY int_position DESC");
	}else{
	$sql = $GLOBALS['CONNECT_DB']->Query($sql);
	}
	
	$i=0;
	while($Fetch = $GLOBALS['CONNECT_DB']->Fetch($sql))
	{
		$arreglo[$i]['pk_banner'] = $Fetch['pk_banner'];
		$arreglo[$i]['txt_url'] = $Fetch['txt_url'];
		$arreglo[$i]['txt_destino'] = $Fetch['txt_destino'];
		$arreglo[$i]['int_orden'] = $Fetch['int_orden'];
		$arreglo[$i]['int_estado'] = $Fetch['int_estado'];
		$arreglo[$i]['date_add'] = $Fetch['date_add'];
		$arreglo[$i]['int_position'] = $Fetch['int_position'];
		$arreglo[$i]['txt_visibletitle'] = $Fetch['txt_visibletitle'];
		$arreglo[$i]['int_fondo'] = $Fetch['int_fondo'];
		$arreglo[$i]['txt_colorfondo'] = $Fetch['txt_colorfondo'];
		$arreglo[$i]['int_ispopup'] = $Fetch['int_ispopup'];
		$arreglo[$i]['txt_winwidth'] = $Fetch['txt_winwidth'];
		$arreglo[$i]['txt_winheight'] = $Fetch['txt_winheight'];
		$arreglo[$i]['reg_update'] = $Fetch['reg_update'];
	 $i++;
	}
	return $arreglo;
}

function IsExistAds(){
$SQL = "SELECT * FROM [|PREFIX|]banner WHERE pk_banner='".$this->getpk_banner()."' ";
$QueryExist = $GLOBALS['CONNECT_DB']->Query($SQL);
$Count = $GLOBALS['CONNECT_DB']->CountResult($QueryExist);
if($Count==0)
return false ;
else
return true ;
}



/*  Vista de Banner ::  */
function findexts ($filename) 
  { 
   $filename = strtolower($filename) ;  
   $exts = split("[/\\.]", $filename) ; 
   $n = count($exts)-1; 
   $exts = $exts[$n]; 
   return $exts; 
}



function AdsLRLink01(){
    global $languages_id,$language_dir;
    $languages = new language();
	
	if($languages->IsExistLanguage($languages_id)) {

	$SQL = "SELECT tbl_banner.txt_url, tbl_banner.txt_destino, tbl_banners_details.txt_title,tbl_banners_details.txt_imagen ";
	$SQL .= "FROM tbl_banner Inner Join tbl_banners_details ON tbl_banner.pk_banner = tbl_banners_details.fk_banner ";
	$SQL .= "WHERE tbl_banner.int_estado =  '1' AND tbl_banners_details.language_id =  '".$languages_id."' AND int_position = '".$this->position_int."' ORDER BY tbl_banner.int_orden ASC LIMIT 0,1";
    
	$Path = DIR_WS_LANGUAGES.$language_dir.'/'._BANNERS;
		
		$strpath = "";
		$Query = $GLOBALS['CONNECT_DB']->Query($SQL);
		
		  if($GLOBALS['CONNECT_DB']->CountResult($Query)>0) {
                while($Fetch = $GLOBALS['CONNECT_DB']->Fetch($Query) ) {
				
				if(tep_not_null($Fetch['txt_imagen']) && file_exists($Path.$Fetch['txt_imagen'])) {
				  
				  $file_ad = base64_encode($Path.$Fetch['txt_imagen']);
				  
				  $link_ad = $Fetch['txt_url'];
				  $nombre = secure_sql(utf8_decode($Fetch['txt_title']));
				  
				  $target_ad = $Fetch['txt_destino'];
				  				  
				  $strpath .= tep_image(_URL.'resize.php?image='.$file_ad.'&w=239&h=111&IsCrop=1',$nombre,'','','');
              } 
			  
		}
   }
   return $strpath ;
  }
}#Fin de la funcion


function AdsLRLink(){
    global $languages_id,$language_dir;
    $languages = new language();
	
	if($languages->IsExistLanguage($languages_id)) {

	$SQL = "SELECT tbl_banner.txt_url, tbl_banner.txt_destino, tbl_banners_details.txt_title,tbl_banners_details.txt_imagen ";
	$SQL .= "FROM tbl_banner Inner Join tbl_banners_details ON tbl_banner.pk_banner = tbl_banners_details.fk_banner ";
	$SQL .= "WHERE tbl_banner.int_estado =  '1' AND tbl_banners_details.language_id =  '".$languages_id."' AND int_position = '".$this->position_int."' ORDER BY tbl_banner.int_orden ASC";
    
	//$languages->tep_get_languages();
	$Path = DIR_WS_LANGUAGES.$language_dir.'/'._BANNERS;
	
	
		$strpath = "";
		$Query = $GLOBALS['CONNECT_DB']->Query($SQL);
		
		  if($GLOBALS['CONNECT_DB']->CountResult($Query)>0) {
                while($Fetch = $GLOBALS['CONNECT_DB']->Fetch($Query) ) {
				
				if(tep_not_null($Fetch['txt_imagen']) && file_exists($Path.$Fetch['txt_imagen'])) {
				  
				  $file_ad = base64_encode($Path.$Fetch['txt_imagen']);
				  
				  $link_ad = $Fetch['txt_url'];
				  $nombre = secure_sql(utf8_decode($Fetch['txt_title']));
				  
				  $target_ad = $Fetch['txt_destino'];
				  $strpath .= "<li>";
                  if(tep_not_null($Fetch['txt_url']))
				  
				  $strpath .= "<a href=\"$link_ad\" target=\"$target_ad\">";                  
				  $strpath .= tep_image(_URL.'resize.php?image='.$file_ad.'&w=220&h=297&IsCrop=0',$nombre,'','','');
				  if(tep_not_null($Fetch['txt_url']))
				  $strpath .= "</a>";
				 
                  
              } $strpath .= "</li>";
		}
   }
   return $strpath ;
  }
}#Fin de la funcion

function nivoSlider(){

	$SQL = "SELECT tbl_banner.txt_url, tbl_banner.txt_destino, tbl_banners_details.txt_title, tbl_banners_details.txt_description, tbl_banners_details.txt_imagen ";
	$SQL .= "FROM tbl_banner Inner Join tbl_banners_details ON tbl_banner.pk_banner = tbl_banners_details.fk_banner ";
	$SQL .= "WHERE tbl_banner.int_estado =  '1' AND tbl_banners_details.language_id =  '2' AND int_position = '".$this->position_int."' ORDER BY tbl_banner.int_orden ASC";
	
	$language_dir = "espanol";
	$Path = DIR_WS_LANGUAGES.$language_dir.'/'._BANNERS;
	
	
	$query_banner_bottom = $GLOBALS['CONNECT_DB']->Query($SQL);
	
	$str_bbottom = "";

	 while($Fetch_bottom = $GLOBALS['CONNECT_DB']->Fetch($query_banner_bottom) ) {
		 
	  if(tep_not_null($Fetch_bottom['txt_imagen']))  {
	  
	  if(file_exists($Path.$Fetch_bottom['txt_imagen'])) {
		
		$file_ad = _URL.$Path.$Fetch_bottom['txt_imagen'];

		if(tep_not_null($Fetch_bottom['txt_url'])) 
		 
		$str_bbottom .= "<div data-src=\"$file_ad\" data-link=\"#\" data-target=\"_parent\">";
        $str_bbottom .= "    <div class=\"camera_caption moveFromBottom\">";
        $str_bbottom .= "        <div class=\"relative\">";
        $str_bbottom .= "              <div class=\"txt1\">".$Fetch_bottom['txt_title']."</div>";
        $str_bbottom .= "                 <div class=\"txt2\">servicio todo incluido</div>";
		$str_bbottom .= "                        <div class=\"absolute\">$".$Fetch_bottom['txt_description']."</div>";
        $str_bbottom .= "         </div>";
        $str_bbottom .= "    </div>";
		$str_bbottom .= "</div>";        

		 }
		  
	 }
} #cierro if
		
	  echo $str_bbottom;		
} #cierro function


function nivoSlider2(){
    global $languages_id,$language_dir;
    
	$languages = new language();
	
	if($languages->IsExistLanguage($languages_id)) {

	$SQL = "SELECT tbl_banner.txt_url, tbl_banner.txt_destino, tbl_banners_details.txt_title,tbl_banners_details.txt_imagen ";
	$SQL .= "FROM tbl_banner Inner Join tbl_banners_details ON tbl_banner.pk_banner = tbl_banners_details.fk_banner ";
	$SQL .= "WHERE tbl_banner.int_estado =  '1' AND tbl_banners_details.language_id =  '".$languages_id."' AND int_position = '".$this->position_int."' ORDER BY tbl_banner.int_orden ASC";
	
	$Path = DIR_WS_LANGUAGES.$language_dir.'/'._BANNERS;
	
	
	$query_banner_bottom = $GLOBALS['CONNECT_DB']->Query($SQL);
	
	$str_bbottom = "";

	 while($Fetch_bottom = $GLOBALS['CONNECT_DB']->Fetch($query_banner_bottom) ) {
		 
	  if(tep_not_null($Fetch_bottom['txt_imagen']))  {
	  
	  if(file_exists($Path.$Fetch_bottom['txt_imagen'])) {
		
		$file_ad = _URL.$Path.$Fetch_bottom['txt_imagen'];

		
		if(tep_not_null($Fetch_bottom['txt_url'])) 
		 
		$str_bbottom .= "<a href='".$Fetch_bottom['txt_url']."' target='".$Fetch_bottom['txt_destino']."' >";
	  
		$str_bbottom .= "<img src=\"$file_ad\" alt='".$Fetch_bottom['txt_title']."' title='".$Fetch_bottom['txt_title']."' />";
	  
			if(tep_not_null($Fetch_bottom['txt_url'])) 
			 $str_bbottom .= "</a>";
			 
				}
			
		  }
		  
	 }
} #cierro if
		
	  echo $str_bbottom;		
} #cierro function


function BannerHome(){
    global $languages_id,$language_dir;
    
	$languages = new language();
	
	if($languages->IsExistLanguage($languages_id)) {

	$SQL = "SELECT tbl_banner.txt_url, tbl_banner.txt_destino, tbl_banners_details.txt_title,tbl_banners_details.txt_imagen ";
	$SQL .= "FROM tbl_banner Inner Join tbl_banners_details ON tbl_banner.pk_banner = tbl_banners_details.fk_banner ";
	$SQL .= "WHERE tbl_banner.int_estado =  '1' AND tbl_banners_details.language_id =  '".$languages_id."' AND int_position = '".$this->position_int."' ORDER BY tbl_banner.int_orden ASC";
    
	//$languages->tep_get_languages();
	$Path = DIR_WS_LANGUAGES.$language_dir.'/'._BANNERS;
	
	
		$strpath = "";
		$Query = $GLOBALS['CONNECT_DB']->Query($SQL);
		
		  if($GLOBALS['CONNECT_DB']->CountResult($Query)>0) {
                $j=0;
				while($Fetch = $GLOBALS['CONNECT_DB']->Fetch($Query) ) {
				
				if(tep_not_null($Fetch['txt_imagen']) && file_exists($Path.$Fetch['txt_imagen'])) {
				  
				  $file_ad = _URL.$Path.$Fetch['txt_imagen'];
				  $link_ad = url_validate($Fetch['txt_url']);
				  $nombre = secure_sql(utf8_decode($Fetch['txt_title']));
				  
				  $target_ad = $Fetch['txt_destino'];
				  
				  $strpath .= "<div id=\"list-flyer-{$Fetch['pk_banner']}\" style=\"width:".$this->width_container."px;height:".$this->height_container."px;text-align:center; \">";
				  
                  if(tep_not_null($Fetch['txt_url']))
				  $strpath .= "<a href=\"$link_ad\" target=\"$target_ad\" title=\"$nombre\">";
                  
				  $strpath .= "<img src=\"$file_ad\" title=\"$nombre\">";
                  //$strpath .= "<span>".$nombre."</span>";
				  
				  if(tep_not_null($Fetch['txt_url']))
				  $strpath .= "</a>";
                  
				  $strpath .= "</div>";
				  $j++;
              }
		  }
		if($j==1)$strpath .= $strpath;
   }
   return $strpath ;
  }
	
}



function BannerFooter(){
     global $languages_id,$language_dir;
    $languages = new language();
	
	if($languages->IsExistLanguage($languages_id)) {

	$SQL = "SELECT tbl_banner.txt_url, tbl_banner.txt_destino, tbl_banners_details.txt_title,tbl_banners_details.txt_imagen ";
	$SQL .= "FROM tbl_banner Inner Join tbl_banners_details ON tbl_banner.pk_banner = tbl_banners_details.fk_banner ";
	$SQL .= "WHERE tbl_banner.int_estado =  '1' AND tbl_banners_details.language_id =  '".$languages_id."' AND int_position = '".$this->position_int."' ORDER BY tbl_banner.int_orden ASC";
    
	//$languages->tep_get_languages();
	$Path = DIR_WS_LANGUAGES.$language_dir.'/'._BANNERS;
	
	
		$strpath = "";
		$Query = $GLOBALS['CONNECT_DB']->Query($SQL);
		  if($GLOBALS['CONNECT_DB']->CountResult($Query)>0) {
                
				$strpath = "<div id=\"BannerFooter\">";
				   
				   $strpath .= "<div class=\"InfoTitle\">";
				    $strpath .= _TITLEADS_FOOTER;
				   $strpath .= "</div>";
				   
				    $strpath .= "<div class=\"MainListAds\" >";
				
				while($Fetch = $GLOBALS['CONNECT_DB']->Fetch($Query) ) {
				
				if(tep_not_null($Fetch['txt_imagen']) && file_exists($Path.$Fetch['txt_imagen'])) {
				  
				  $file_ad = _URL.$Path.$Fetch['txt_imagen'];
				  $link_ad = url_validate($Fetch['txt_url']);
				  $nombre = secure_sql(utf8_decode($Fetch['txt_title']));
				  
				  $target_ad = $Fetch['txt_destino'];
                  
				  $strpath .= "<div class=\"BannerBottom\">";
					  if(tep_not_null($Fetch['txt_url']))
					  $strpath .= "<a href=\"$link_ad\" target=\"$target_ad\" title=\"$nombre\">";
                  
					  $strpath .= "<img src=\"$file_ad\" title=\"$nombre\">";
					  //$strpath .= "<span>".$nombre."</span>";
					  if(tep_not_null($Fetch['txt_url']))
					  $strpath .= "</a>";
				  $strpath .= "</div>";
                  
                 }
		     }
			       $strpath .= "</div>";
				    
			$strpath .= "</div>"; 
   }
   return $strpath ;
  }
	
}

function get_banner_detail($banner_id, $language_id = 0) {
    global $languages_id;

    if ($language_id == 0) $language_id = $languages_id;
    $banner_query = "SELECT txt_title,txt_imagen,txt_description FROM [|PREFIX|]banners_details WHERE";
	$banner_query .= " fk_banner = '" . (int)$banner_id . "' and language_id = '" . (int)$language_id . "'" ;
	$Query = $GLOBALS['CONNECT_DB']->Query($banner_query);
	
	while ($FetchBanner = $GLOBALS['CONNECT_DB']->Fetch($Query)){
    $getbanner[] = array('banner_txt_title'=>$FetchBanner['txt_title'],
	                     'banner_txt_imagen'=>$FetchBanner['txt_imagen'],
						 'description' => $FetchBanner['txt_description']
	                     );
	}
    return $getbanner;
  }


function BannerHomeLateralTop(){
    global $languages_id,$language_dir;
    
	$languages = new language();
	
	if($languages->IsExistLanguage($languages_id)) {

	$SQL = "SELECT tbl_banner.txt_url, tbl_banner.txt_destino, tbl_banners_details.txt_title,tbl_banners_details.txt_imagen ";
	$SQL .= "FROM tbl_banner Inner Join tbl_banners_details ON tbl_banner.pk_banner = tbl_banners_details.fk_banner ";
	$SQL .= "WHERE tbl_banner.int_estado =  '1' AND tbl_banners_details.language_id =  '".$languages_id."' AND int_position = '".$this->position_int."' ORDER BY tbl_banner.int_orden ASC";
    
	//$languages->tep_get_languages();
	$Path = DIR_WS_LANGUAGES.$language_dir.'/'._BANNERS;
	
	
		$strpath = "";
		$Query = $GLOBALS['CONNECT_DB']->Query($SQL);
		
		  if($GLOBALS['CONNECT_DB']->CountResult($Query)>0) {
                $j=0;
				while($Fetch = $GLOBALS['CONNECT_DB']->Fetch($Query) ) {
				
				if(tep_not_null($Fetch['txt_imagen']) && file_exists($Path.$Fetch['txt_imagen'])) {
				  
				  $file_ad = _URL.$Path.$Fetch['txt_imagen'];
				  $link_ad = url_validate(''._URL.$Fetch['txt_url']);
				  $nombre = secure_sql(utf8_decode($Fetch['txt_title']));
				  
				  $target_ad = $Fetch['txt_destino'];
				  
				  $strpath .= "<div class=\"BannerProm\">";
				  
                  if(tep_not_null($Fetch['txt_url']))
				  $strpath .= "<a href=\"$link_ad\" target=\"$target_ad\" title=\"$nombre\">";
                  
				  $strpath .= "<img src=\"$file_ad\" title=\"$nombre\">";
                  //$strpath .= "<span>".$nombre."</span>";
				  
				  if(tep_not_null($Fetch['txt_url']))
				  $strpath .= "</a>";
                  
				  $strpath .= "</div>";
				  $j++;
              }
		  }
   }
   return $strpath ;
  }
	
}


function BannerRight($OptHome=true){
 global $language_dir;
 global $languages_id;
 $ThisPage = basename($_SERVER['PHP_SELF']);;
 
 if($ThisPage=='index.php' || $ThisPage=='index_.php')
   $PositionOpt=" int_position='3' AND int_estado='1' ORDER BY int_orden ASC";
 else
   $PositionOpt=" (int_position='3' OR int_position='".$this->position_int_aditional."') AND int_estado='1' ORDER BY int_position DESC";
   
 $SQL = "SELECT int_ispopup, txt_winwidth, txt_winheight, pk_banner, txt_url, txt_destino, txt_visibletitle, int_fondo, txt_colorfondo FROM [|PREFIX|]banner";
 //$SQL .= " WHERE $PositionOpt AND int_estado='1' ORDER BY int_orden ASC";
 $SQL .= " WHERE $PositionOpt ";
 $Query = $GLOBALS['CONNECT_DB']->Query($SQL);
  $str_br = "";
  $bgclass_title = "";
  while($Fetch = $GLOBALS['CONNECT_DB']->Fetch($Query)){
	  $LangBanner = $this->get_banner_detail($Fetch['pk_banner'],$languages_id);
	  $str_br .= "<div id=\"sidebar_div\">";
	    if((int)$Fetch['txt_visibletitle']==1){
		  switch($Fetch['int_fondo']){
			 case 1: $bgclass_title = " bg_banner_title_rojo";break;
			 case 2: $bgclass_title = " bg_banner_title_naranja";break;
			 case 3: $bgclass_title = " bg_banner_title_verde";break;
			 break;
		   }

		  if($Fetch['int_fondo']==4){
			$colorbg = " style=\"background-color:{$Fetch['txt_colorfondo']}\"";   
		  }
		  
		  $str_br .= "<div class=\"title_ads";
		   if(tep_not_null($bgclass_title))$str_br .=  $bgclass_title;
		  $str_br .= "\"";
		  
		  if(tep_not_null($colorbg)){$str_br.= $colorbg;}
		  $str_br .= ">";
		  
		  $str_br .= $LangBanner[0]['banner_txt_title'];
		  
		  $str_br .= "</div>";
		}
		
		$link_ad = url_validate(''._URL.$Fetch['txt_url']);
		$target_ad = $Fetch['txt_destino'];
		
		if(tep_not_null($link_ad) && $Fetch['int_ispopup']=='0')
		  $str_br .= "<a href=\"$link_ad\" target=\"$target_ad\">";
        if(tep_not_null($link_ad) && $Fetch['int_ispopup']=='1')
		  $str_br .= "<a href=\"$link_ad\" onclick=\"javascript:open_window('$link_ad',{$Fetch['txt_winwidth']},{$Fetch['txt_winheight']});\">";
		
		$str_br .= "<img src=\""._URL.DIR_WS_LANGUAGES.$language_dir.'/'._BANNERS.$LangBanner[0]['banner_txt_imagen']."\" />";
        
		if(tep_not_null($link_ad))
		$str_br .= "</a>";
		   
		if(tep_not_null($LangBanner[0]['description'])){
		  $str_br .= "<div class=\"info_ads\">";
		   $str_br .= utf8_decode($LangBanner[0]['description']);
		  $str_br .= "</div>";
		}
		
	  $str_br .= "</div>";
  }
   return $str_br;
}



} // fin de la clase

?>