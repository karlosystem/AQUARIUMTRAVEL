<?php

class cls_tbl_paquete{

var $pk_paquete;
var $txt_datepaquete;
var $txt_bhoteles;
var $fk_categoria;
var $fk_destino;
var $fk_aeropuerto;
var $txt_youtube;
var $int_estado;
var $txt_dateadd;
var $txt_dateupdate;
var $txt_datefrom;
var $txt_dateto;
var $int_dias;
var $int_noches;
var $txt_precio;
var $txt_precio_soles;
var $txt_tipo_cambio;
var $txt_ishome ;
var $txt_isdestacado ;
var $txt_isagotado ;
var $txt_isnuevo ;
var $txt_isultimos ;
var $txt_tipo;

var $path_ad = ""; # Ruta especifica del directorio paquete  getfk_categoria
 
var $pref_title = 'name_paquete'; #-> name_banner[]
var $pref_presentacion = 'presentacion_paquete';
var $pref_tours = 'tours_paquete';
var $pref_incluye = 'incluye_paquete';
var $pref_content = 'content_paquete';
var $pref_titleyotube = 'titleyoutube_paquete';
var $pref_descyoutube = 'contentyoutbe_paquete';
var $pref_boleto = 'boleto_paquete';
var $pref_traslado = 'traslado_paquete';
# imagen
var $pref_file = 'file_uppaquete'; #Nombre del archivo file
var $pref_file_hidden = 'file_updpack_hidden'; # Nombre del hidden file

# archivo pdf
var $pref_file_pdf = 'file_uppaquete_pdf'; #Nombre del archivo file
var $pref_file_hidden_pdf = 'file_updpack_hidden_pdf'; # Nombre del hidden file

# metas para el paquete
var $pref_meta_title = 'meta_title_paquete'; 
var $pref_meta_keyword = 'meta_keyword_paquete';
var $pref_meta_description = 'meta_description_paquete';


function cls_tbl_paquete($id=0)
{

	if($id!=0)
	{
				$sql=$GLOBALS['CONNECT_DB']->Query("SELECT  [|PREFIX|]paquete.pk_paquete,  
													[|PREFIX|]paquete.txt_datepaquete,  
													[|PREFIX|]paquete.fk_categoria,
													[|PREFIX|]paquete.fk_destino,
													[|PREFIX|]paquete.fk_aeropuerto,
													[|PREFIX|]paquete.txt_youtube,
													[|PREFIX|]paquete.int_status,
													[|PREFIX|]paquete.txt_dateadd,
													[|PREFIX|]paquete.txt_dateupdate,
													[|PREFIX|]paquete.txt_date_from,  
													[|PREFIX|]paquete.txt_date_to,
													[|PREFIX|]paquete.int_dias,
													[|PREFIX|]paquete.int_noches,
													[|PREFIX|]paquete.txt_precio,
													[|PREFIX|]paquete.txt_precio_soles,
													[|PREFIX|]paquete.txt_tipo_cambio,
													[|PREFIX|]paquete.int_ishome,
													[|PREFIX|]paquete.int_isdestacado,
													[|PREFIX|]paquete.int_agotado,
													[|PREFIX|]paquete.int_isultimos,
													[|PREFIX|]paquete.txt_bhoteles,
													[|PREFIX|]paquete.int_isnuevo,
													[|PREFIX|]categoria.int_tipo		
		FROM [|PREFIX|]paquete INNER JOIN [|PREFIX|]categoria ON [|PREFIX|]paquete.fk_categoria = [|PREFIX|]categoria.pk_categoria WHERE [|PREFIX|]paquete.pk_paquete = '".$id."' ORDER BY pk_paquete ASC");
		
		
		$fila = $GLOBALS['CONNECT_DB']->Fetch($sql);
		$this->setpk_paquete($fila['pk_paquete']);
		$this->settxt_datepaquete($fila['txt_datepaquete']);
		$this->setfk_categoria($fila['fk_categoria']);
		$this->setfk_destino($fila['fk_destino']);
		$this->setfk_aeropuerto($fila['fk_aeropuerto']);
		$this->settxt_bhoteles($fila['txt_bhoteles']);
		$this->settxt_youtube($fila['txt_youtube']);
		$this->setint_status($fila['int_status']);
		$this->settxt_dateadd($fila['txt_dateadd']);
		$this->settxt_dateupdate($fila['txt_dateupdate']);
		$this->settxt_datefrom($fila['txt_date_from']);
		$this->settxt_dateto($fila['txt_date_to']);
		$this->setint_countdias($fila['int_dias']);
		$this->setint_countnoches($fila['int_noches']);
		$this->settxt_precio($fila['txt_precio']);
		$this->settxt_precio_soles($fila['txt_precio_soles']);
		$this->settxt_tipo_cambio($fila['txt_tipo_cambio']);
		$this->settxt_ishome($fila['int_ishome']);
		$this->settxt_isnuevo($fila['int_isnuevo']);
		$this->settxt_isultimos($fila['int_isultimos']);
		$this->settxt_isdestacado($fila['int_isdestacado']);
		$this->settxt_isagotado($fila['int_agotado']);
		$this->settxt_tipo($fila['int_tipo']);
	}else{
		$this->setpk_paquete('');
		$this->settxt_datepaquete('');
		$this->setfk_categoria('');
		$this->setfk_destino('');
		$this->setfk_aeropuerto('');
		$this->settxt_bhoteles('');
		$this->settxt_youtube('');
		$this->setint_status('');
		$this->settxt_dateadd('');
		$this->settxt_dateupdate('');
		$this->settxt_datefrom('');
		$this->settxt_dateto('');
		$this->setint_countdias('');
		$this->setint_countnoches('');
		$this->settxt_precio('');
		$this->settxt_precio_soles('');
		$this->settxt_tipo_cambio('');
		$this->settxt_ishome('');
		$this->settxt_isnuevo('');
		$this->settxt_isultimos('');
		$this->settxt_isdestacado('');
		$this->settxt_isagotado('');
		$this->settxt_tipo('');
	}

}

function setpk_paquete($pk_paquete){  $this->pk_paquete = $pk_paquete;}
function getpk_paquete(){  return $this->pk_paquete; }

function settxt_datepaquete($txt_datepaquete){  $this->txt_datepaquete = $txt_datepaquete;}
function gettxt_datepaquete(){  return $this->txt_datepaquete; }

function settxt_bhoteles($txt_bhoteles){  $this->txt_bhoteles = $txt_bhoteles;}
function gettxt_bhoteles(){  return $this->txt_bhoteles; }

function setfk_categoria($fk_categoria){  $this->fk_categoria = $fk_categoria;}
function getfk_categoria(){  return $this->fk_categoria; }

function setfk_destino($fk_destino){  $this->fk_destino = $fk_destino;}
function getfk_destino(){  return $this->fk_destino; }

function setfk_aeropuerto($fk_aeropuerto){  $this->fk_aeropuerto = $fk_aeropuerto;}
function getfk_aeropuerto(){  return $this->fk_aeropuerto; }

function settxt_youtube($txt_youtube){  $this->txt_youtube = $txt_youtube;}
function gettxt_youtube(){  return $this->txt_youtube; }

function setint_status($int_estado){  $this->int_estado = $int_estado;}
function getint_status(){  return $this->int_estado; }

function settxt_dateadd($txt_dateadd){  $this->txt_dateadd = $txt_dateadd;}
function gettxt_dateadd(){  return $this->txt_dateadd; }

function settxt_dateupdate($txt_dateupdate){  $this->txt_dateupdate = $txt_dateupdate;}
function gettxt_dateupdate(){  return $this->txt_dateupdate; }

function settxt_datefrom($txt_datefrom){  $this->txt_datefrom = $txt_datefrom;}
function gettxt_datefrom(){  return $this->txt_datefrom; }

function settxt_dateto($txt_dateto){  $this->txt_dateto = $txt_dateto;}
function gettxt_dateto(){  return $this->txt_dateto; }

function setint_countdias($int_dias){  $this->int_dias = $int_dias;}
function getint_countdias(){  return $this->int_dias; }

function setint_countnoches($int_noches){  $this->int_noches = $int_noches;}
function getint_countnoches(){  return $this->int_noches; }

function settxt_precio($txt_precio){  $this->txt_precio = $txt_precio;}
function gettxt_precio(){  return $this->txt_precio; }

function settxt_precio_soles($txt_precio_soles){  $this->txt_precio_soles = $txt_precio_soles;}
function gettxt_precio_soles(){  return $this->txt_precio_soles; }

function settxt_tipo_cambio($txt_tipo_cambio){  $this->txt_tipo_cambio = $txt_tipo_cambio;}
function gettxt_tipo_cambio(){  return $this->txt_tipo_cambio; }

function settxt_ishome($txt_ishome){  $this->txt_ishome = $txt_ishome;}
function gettxt_ishome(){  return $this->txt_ishome; }

function settxt_isnuevo($txt_isnuevo){  $this->txt_isnuevo = $txt_isnuevo;}
function gettxt_isnuevo(){  return $this->txt_isnuevo; }

function settxt_isultimos($txt_isultimos){  $this->txt_isultimos = $txt_isultimos;}
function gettxt_isultimos(){  return $this->txt_isultimos; }

function settxt_isdestacado($txt_isdestacado){  $this->txt_isdestacado = $txt_isdestacado;}
function gettxt_isdestacado(){  return $this->txt_isdestacado; }

function settxt_isagotado($txt_isagotado){  $this->txt_isagotado = $txt_isagotado;}
function gettxt_isagotado(){  return $this->txt_isagotado; }

function settxt_tipo($txt_tipo){  $this->txt_tipo = $txt_tipo;}
function gettxt_tipo(){  return $this->txt_tipo; }



function countgallerypaquetes_list($QueryParam=''){
if(!tep_not_null($QueryParam)){
$SQL = "SELECT * FROM [|PREFIX|]paquete Inner Join [|PREFIX|]reservas ON [|PREFIX|]paquete.pk_paquete = [|PREFIX|]reservas.fk_destino
WHERE [|PREFIX|]paquete.pk_paquete =  '".$this->getpk_paquete()."'";
}else{
$SQL = $QueryParam;
}
 
 $Query = $GLOBALS['CONNECT_DB']->Query($SQL);
 $count = $GLOBALS['CONNECT_DB']->CountResult($Query);
 return $count ;
}


function countreservaspaquetes_list($QueryParam=''){
if(!tep_not_null($QueryParam)){
	$SQL = "SELECT tbl_paquete.pk_paquete,
		   (SELECT COUNT(*) 
			  FROM tbl_reservas 
			 WHERE tbl_reservas.fk_destino = tbl_paquete.pk_paquete) AS cantidad 
	FROM tbl_paquete 
	GROUP BY tbl_paquete.pk_paquete
	HAVING tbl_paquete.pk_paquete = '".$this->getpk_paquete()."';";
}else{
	$SQL = $QueryParam;
}
 $Query = $GLOBALS['CONNECT_DB']->query($SQL);
 $Fetch = $GLOBALS['CONNECT_DB']->Fetch($Query);
 return $Fetch['cantidad'];
 
}

function _Save()
{
	
	$array_pack = array("txt_datepaquete"=>$this->gettxt_datepaquete(),
						"fk_categoria"=>$this->getfk_categoria(),
						"fk_destino"=>$this->getfk_destino(),
						"fk_aeropuerto"=>$this->getfk_aeropuerto(),
						"txt_bhoteles"=>$this->gettxt_bhoteles(),
						"txt_youtube"=>$this->gettxt_youtube(),
						"int_status"=>$this->getint_status(),
						"txt_dateadd"=>$this->gettxt_dateadd(),
						"txt_date_from"=>$this->gettxt_datefrom(),
						"txt_date_to"=>$this->gettxt_dateto(),
						"int_dias"=>$this->getint_countdias(),
						"int_noches"=>$this->getint_countnoches(),
						"txt_precio"=>$this->gettxt_precio(),
						"txt_precio_soles"=>$this->gettxt_precio_soles(),
						"txt_tipo_cambio"=>$this->gettxt_tipo_cambio(),
						"int_ishome"=>$this->gettxt_ishome(),
						"int_isnuevo"=>$this->gettxt_isnuevo(),
						"int_isultimos"=>$this->gettxt_isultimos(),
						"int_isdestacado"=>$this->gettxt_isdestacado(),
						"int_agotado"=>$this->gettxt_isagotado()
					   );
	insert($array_pack,"[|PREFIX|]paquete");
	$id = $GLOBALS['CONNECT_DB']->LastId();
    $this->setpk_paquete($id);

}

function _SaveImages_Product($file_upload='file_uploadimg_products'){
  $code_new = "";
  $str_info = "";
  
  if(tep_not_null($_FILES[$file_upload])){
	      $filename = $_FILES[$file_upload]['name'];
		  $filename = str_replace(" ","_",$filename); # remuevo los caracteres especiales a tipo html : prueba_archivo_subido
		  $uploaded_product = ADMIN_IMG_PROD.'big_'.$this->getpk_paquete().'_'.$filename;
		  $uploaded_pmin = ADMIN_IMG_PMIN.'medium_'.$this->getpk_paquete().'_'.$filename;
		  $uploaded_pthumb = ADMIN_IMG_PTHUMB.'min_'.$this->getpk_paquete().'_'.$filename;
		  
		if(move_uploaded_file($_FILES[$file_upload]['tmp_name'],$uploaded_product)){
		
		  require_once("../include/class/thumbnail.inc.php");
		  #Vista Grande
		  $resize_image = new Thumbnail($uploaded_product);
	      $resize_image->resize(WPROD_,HPROD_);
		  //$resize_image->watermark(PATH_WATERMARK,'LT');
	      $resize_image->save($uploaded_product); 

		  #Vista Min
		  $resize_image = new Thumbnail($uploaded_product);
	      $resize_image->resize(WPROD_MIN,HPROD_MIN);
	      $resize_image->save($uploaded_pmin); 

		  #Vista Thumb
		  $resize_image = new Thumbnail($uploaded_product);
	      $resize_image->resize(WPROD_THUMB,HPROD_THUMB);
	      $resize_image->save($uploaded_pthumb); 
         
		 
		 $array_pimages = array("prod_id"=>$this->getpk_paquete(),
						        "prod_imgbig"=>'big_'.$this->getpk_paquete().'_'.$filename,
						        "prod_imgmedium"=>'medium_'.$this->getpk_paquete().'_'.$filename,
								"prod_imgmin"=>'min_'.$this->getpk_paquete().'_'.$filename
						        );
	     insert($array_pimages,"[|PREFIX|]paquete_images");
		     }
		  }
 
}


function RemovePhoto($IsCPhoto){
 $SQL = "SELECT prod_imgbig, prod_imgmedium, prod_imgmin FROM [|PREFIX|]paquete_images WHERE pict_id = '$IsCPhoto'";
 $Query_ = $GLOBALS['CONNECT_DB']->Query($SQL);
 $Fetch_ = $GLOBALS['CONNECT_DB']->Fetch($Query_);
    deleteFiles(ADMIN_IMG_PROD,$Fetch_['prod_imgbig']);
	deleteFiles(ADMIN_IMG_PMIN,$Fetch_['prod_imgmedium']);
	deleteFiles(ADMIN_IMG_PTHUMB,$Fetch_['prod_imgmin']);
	$GLOBALS['CONNECT_DB']->Query("DELETE FROM [|PREFIX|]paquete_images WHERE pict_id = '".$IsCPhoto."'");
}

function _Update()
{	
	$array_pack = array("txt_datepaquete"=>$this->gettxt_datepaquete(),
						 "fk_categoria"=>$this->getfk_categoria(),
						 "fk_destino"=>$this->getfk_destino(),
						 "fk_aeropuerto"=>$this->getfk_aeropuerto(),
						 "txt_bhoteles"=>$this->gettxt_bhoteles(),
						 "txt_youtube"=>$this->gettxt_youtube(),
						 "int_status"=>$this->getint_status(),
						 "txt_dateupdate"=>$this->gettxt_dateupdate(),
						 "txt_date_from"=>$this->gettxt_datefrom(),
						 "txt_date_to"=>$this->gettxt_dateto(),
						 "int_dias"=>$this->getint_countdias(),
						 "int_noches"=>$this->getint_countnoches(),
						 "txt_precio"=>$this->gettxt_precio(),
						 "txt_precio_soles"=>$this->gettxt_precio_soles(),
						 "txt_tipo_cambio"=>$this->gettxt_tipo_cambio(),
						 "int_ishome"=>$this->gettxt_ishome(),
						 "int_isnuevo"=>$this->gettxt_isnuevo(),
						 "int_isultimos"=>$this->gettxt_isultimos(),
						 "int_isdestacado"=>$this->gettxt_isdestacado(),
						 "int_agotado"=>$this->gettxt_isagotado()
						);
   $array_where = array("pk_paquete"=>$this->getpk_paquete()) ;
   
   update($array_pack,"[|PREFIX|]paquete",$array_where)or die(mysql_error());

}


function _Remove()
{

    $languages = language::tep_get_languages();
    
	for ($i=0, $n=sizeof($languages); $i<$n; $i++) {
		$SqlLang="";
		$PathFolder = DIR_WS_ADMIN_LANGUAGES.$languages[$i]['directory'].'/'._PAQUETES;
		
		$SqlLang = "SELECT txt_imagen FROM [|PREFIX|]paquete_details WHERE fk_paquete = '".$this->getpk_paquete()."' AND language_id='".$languages[$i]['id']."' ";
	    $QueryLang = $GLOBALS['CONNECT_DB']->Query($SqlLang);
		$CountPack = $GLOBALS['CONNECT_DB']->CountResult($QueryLang);
		 if($CountPack==1){
		   $FetchPack = $GLOBALS['CONNECT_DB']->Fetch($QueryLang);
		   $ImgPack = $FetchPack['txt_imagen'];
		   
			if(tep_not_null($ImgPack) && file_exists($PathFolder.$ImgPack)){
		     deleteFiles($PathFolder,$ImgPack);
			}
		 }
	}
	$GLOBALS['CONNECT_DB']->Query("DELETE FROM [|PREFIX|]paquete_details WHERE fk_paquete = '".$this->getpk_paquete()."'");
	$GLOBALS['CONNECT_DB']->Query("DELETE FROM [|PREFIX|]paquete WHERE pk_paquete = '".$this->getpk_paquete()."'");
	
}


function estado($estado)
{	$est=$estado;
	if($estado=="")
	{	$estado=($this->getint_status()==1)?0:1;}

	$sql = "UPDATE [|PREFIX|]paquete
				SET int_status='".$estado."'
			WHERE pk_paquete = '".$this->getpk_paquete()."'";
	$GLOBALS['CONNECT_DB']->Query($sql);
	if($est=="")
	{
		$icono = "ico_estado".$estado.".gif";
		echo "<a href='javascript:UpdateStatus(".$this->getpk_paquete().")'>
 			  <img src='"._URL."paneldecontrol/images/icons/".$icono."' border='0'></a>";
	}
}


function ListaPaquetes($fk_paquete=''){
 $SQL = "SELECT * FROM [|PREFIX|]paquete_details ORDER BY txt_title ASC";
 $Query = $GLOBALS['CONNECT_DB']->Query($SQL);
 $str_cmb = "";
 while($Fetch = $GLOBALS['CONNECT_DB']->Fetch($Query)){
  
  $str_cmb .= "<option value=\"{$Fetch['fk_paquete']}\" ";
  if($Fetch['fk_paquete']==(int)$fk_paquete)
  $str_cmb .= "selected";
  
  $str_cmb .= ">";
  $str_cmb .= $Fetch['txt_title'];
  $str_cmb .= "</option>";
 }
 return $str_cmb ;
}


function lista($sql="")
{
	if(!tep_not_null($sql)){
	$sql = $GLOBALS['CONNECT_DB']->Query("SELECT pk_paquete, txt_datepaquete, fk_categoria, txt_youtube, int_status, txt_dateadd, txt_dateupdate, txt_date_from, txt_date_to, int_dias, int_noches, txt_precio, int_ishome, int_isnuevo, [|PREFIX|]paquete_details.txt_pdf, fk_destino, txt_precio_soles, txt_tipo_cambio, int_isdestacado, LENGTH(txt_meta_description) as caracteres FROM [|PREFIX|]paquete LEFT JOIN [|PREFIX|]paquete_details ON [|PREFIX|]paquete.pk_paquete = [|PREFIX|]paquete_details.fk_paquete ORDER BY int_status ASC");
	}else{
	$sql = $GLOBALS['CONNECT_DB']->Query($sql);
	}
	
	$i=0;
	while($Fetch = $GLOBALS['CONNECT_DB']->Fetch($sql))
	{
		$arreglo[$i]['pk_paquete'] = $Fetch['pk_paquete'];
		$arreglo[$i]['txt_datepaquete'] = $Fetch['txt_datepaquete'];
		$arreglo[$i]['fk_categoria'] = $Fetch['fk_categoria'];
		$arreglo[$i]['fk_destino'] = $Fetch['fk_destino'];
		$arreglo[$i]['txt_youtube'] = $Fetch['txt_youtube'];
		$arreglo[$i]['int_status'] = $Fetch['int_status'];
		$arreglo[$i]['caracteres'] = $Fetch['caracteres'];
		$arreglo[$i]['txt_dateadd'] = $Fetch['txt_dateadd'];
		$arreglo[$i]['txt_dateupdate'] = $Fetch['txt_dateupdate'];
		$arreglo[$i]['txt_date_from'] = $Fetch['txt_date_from'];
		$arreglo[$i]['txt_date_to'] = $Fetch['txt_date_to'];
		$arreglo[$i]['int_dias'] = $Fetch['int_dias'];
		$arreglo[$i]['int_noches'] = $Fetch['int_noches'];
		$arreglo[$i]['txt_precio'] = $Fetch['txt_precio'];
		$arreglo[$i]['txt_precio_soles'] = $Fetch['txt_precio_soles'];
		$arreglo[$i]['txt_tipo_cambio'] = $Fetch['txt_tipo_cambio'];
		$arreglo[$i]['int_ishome'] = $Fetch['int_ishome'];
		$arreglo[$i]['int_isnuevo'] = $Fetch['int_isnuevo'];
		$arreglo[$i]['int_isdestacado'] = $Fetch['int_isdestacado'];
		$arreglo[$i]['int_agotado'] = $Fetch['int_agotado'];
		$arreglo[$i]['txt_pdf'] = $Fetch['txt_pdf'];
	 $i++;
	}
	
	return $arreglo;
}


function lista_paquetes_expira($sql="")
{
	if(!tep_not_null($sql)){
	$sql = $GLOBALS['CONNECT_DB']->Query("SELECT tbl_paquete.pk_paquete, tbl_paquete_details.txt_title, txt_date_to from tbl_paquete Inner Join 	tbl_paquete_details ON tbl_paquete.pk_paquete = tbl_paquete_details.fk_paquete
		LEFT JOIN tbl_categoria ON tbl_paquete.fk_categoria = tbl_categoria.pk_categoria 
		WHERE txt_date_to >= DATE_ADD(DATE(now()), INTERVAL 1 WEEK)
		ORDER BY txt_date_to LIMIT 0, 10");
	}else{
	$sql = $GLOBALS['CONNECT_DB']->Query($sql);
	}
	
	$i=0;
	while($Fetch = $GLOBALS['CONNECT_DB']->Fetch($sql))
	{
		$arreglo[$i]['pk_paquete'] = $Fetch['pk_paquete'];
		$arreglo[$i]['txt_title'] = $Fetch['txt_title'];
		$arreglo[$i]['txt_date_to'] = $Fetch['txt_date_to'];
	 $i++;
	}	
	return $arreglo;
}

function Paquete_US($IsMode='Create'){#Banner_UpdateSave
		  $languages = language::tep_get_languages();
		   for ($i=0, $n=sizeof($languages); $i<$n; $i++) {
			 $language_id = $languages[$i]['id'];
			 
			 $paquete_id = $this->getpk_paquete();
			 $name_paquete = secure_sql($_POST[$this->pref_title][$language_id]);
			 $presentacion_paquete = secure_sql($_POST[$this->pref_presentacion][$language_id]);			
			 $incluye_paquete = secure_sql($_POST[$this->pref_incluye][$language_id]);
			 $meta_title_paquete = secure_sql($_POST[$this->pref_meta_title][$language_id]);
			 $meta_keyword_paquete = secure_sql($_POST[$this->pref_meta_keyword][$language_id]);
			 $meta_description_paquete = secure_sql($_POST[$this->pref_meta_description][$language_id]);
			 $description_paquete = secure_sql($_POST[$this->pref_content][$language_id]);
			 $titleyotube_paquete = secure_sql($_POST[$this->pref_titleyotube][$language_id]);
			 $descyoutube_paquete = secure_sql($_POST[$this->pref_descyoutube][$language_id]);
			 $boleto_paquete = secure_sql($_POST[$this->pref_boleto][$language_id]);
			 $traslado_paquete = secure_sql($_POST[$this->pref_traslado][$language_id]);
			 
			 $file_paquete = secure_sql($_POST[$this->pref_file_hidden][$language_id]);
		     
			 $file_paquete_pdf = secure_sql($_POST[$this->pref_file_hidden_pdf][$language_id]);
			 
			#Subir la imagen si a seleccionado  .....
			$NewFile = $_FILES[$this->pref_file]['name'][$language_id];
			$TempFile = $_FILES[$this->pref_file]['tmp_name'][$language_id];
			$UniqueId = generate_unique_id();

				$filename = $NewFile;
		        $filename = str_replace(" ","_",$filename);	
				$filename = remove_accents($filename);

				$folder_complete = DIR_WS_ADMIN_LANGUAGES.$languages[$i]['directory'].'/'._PAQUETES;
				$save_folder_paquete = DIR_WS_ADMIN_LANGUAGES.$languages[$i]['directory'].'/'._PAQUETES.$UniqueId.'_'.$filename;
				
				  if(move_uploaded_file($TempFile,$save_folder_paquete)) {
					 #Verificamos que no exceda el ancho de 450px
					 $InfoImg = getimagesize($save_folder_paquete);
					 $WImg = $InfoImg[0];
					  if($WImg>450){
						$resize_image = new SimpleImage();
					    $resize_image->load($save_folder_paquete);
					    $resize_image->resizeToWidth(450);
					    $resize_image->save($save_folder_paquete);
					  } 
					 
					 if(tep_not_null($file_paquete) && file_exists($folder_complete.$file_paquete)){
					   deleteFiles($folder_complete,$file_paquete);
					 }
					 $file_paquete = $UniqueId.'_'.$filename;
			      }
             
			 #Subir el pdf si a seleccionado  .....
			$NewFile_pdf = $_FILES[$this->pref_file_pdf]['name'][$language_id];
			$TempFile_pdf = $_FILES[$this->pref_file_pdf]['tmp_name'][$language_id];
			$UniqueId_pdf = generate_unique_id();
			
				$filename_pdf = $NewFile_pdf;
		        $filename_pdf = str_replace(" ","_",$filename_pdf);	
				$filename_pdf = remove_accents($filename_pdf);

				$folder_complete_pdf = DIR_WS_ADMIN_LANGUAGES.$languages[$i]['directory'].'/'._PDF;
				$save_folder_paquete_pdf = DIR_WS_ADMIN_LANGUAGES.$languages[$i]['directory'].'/'._PDF.$UniqueId_pdf.'_'.$filename_pdf;

				 if(move_uploaded_file($TempFile_pdf,$save_folder_paquete_pdf)) {
				 	 if(tep_not_null($file_paquete_pdf) && file_exists($folder_complete_pdf.$file_paquete_pdf)){
					   deleteFiles($folder_complete_pdf,$file_paquete_pdf);
					 }
					 $file_pdf = $UniqueId_pdf.'_'.$filename_pdf;
			      }





			$sql_data_array = array('fk_paquete' => $paquete_id,
				                    'language_id' => $language_id ,
				                    'txt_title' => $name_paquete,
									'txt_presentacion' => $presentacion_paquete,
									'txt_incluye' => $incluye_paquete,
									'txt_meta_title' => $meta_title_paquete,
									'txt_meta_keyword' => $meta_keyword_paquete,
									'txt_meta_description' => $meta_description_paquete,
									'txt_detalle' => $description_paquete,
									'txt_title_youtube' => $titleyotube_paquete,
									'txt_descyoutube' => $descyoutube_paquete,
									'txt_boleto' => $boleto_paquete,
									'txt_traslate' => $traslado_paquete,
									'txt_imagen' => $file_paquete,
									'txt_pdf' => $file_pdf
		                            );
			 
			if($IsMode=='Update'){
				$arr_where = array("fk_paquete"=>$this->getpk_paquete(),
								   "language_id"=>$language_id
								   );
				
				$Query_exists = $GLOBALS['CONNECT_DB']->Query("SELECT * FROM [|PREFIX|]paquete_details WHERE fk_paquete ='".$paquete_id."' AND language_id='".(int)$language_id."'");
				
				if($GLOBALS['CONNECT_DB']->CountResult($Query_exists)==1)
				 update($sql_data_array,"[|PREFIX|]paquete_details",$arr_where);
				  else
				 insert($sql_data_array,"[|PREFIX|]paquete_details");
				
		    }else if($IsMode='Create'){
			     insert($sql_data_array,"[|PREFIX|]paquete_details");
			}
			
		   }
}


function get_infolang_pack($language_id = ''){

	$sql = "SELECT txt_title, txt_incluye, txt_presentacion, txt_detalle,txt_title_youtube,txt_descyoutube,txt_boleto,txt_traslate,txt_imagen, txt_pdf, txt_meta_title, txt_meta_description, txt_meta_keyword, txt_tours FROM";
	$sql .= " [|PREFIX|]paquete_details ";
	$sql .= "WHERE fk_paquete ='".$this->getpk_paquete()."' AND language_id='".(int)$language_id."' ";
	$article_query = $GLOBALS['CONNECT_DB']->Query($sql);
	
	while($FetchInfo = $GLOBALS['CONNECT_DB']->Fetch($article_query)){

	$get_data_array[] = array('title' => $FetchInfo['txt_title'],
							  'presentacion' => $FetchInfo['txt_presentacion'],
							  'incluye' => $FetchInfo['txt_incluye'],
							  'meta_title' => $FetchInfo['txt_meta_title'],	
							  'meta_description' => $FetchInfo['txt_meta_description'],	
							  'meta_keyword' => $FetchInfo['txt_meta_keyword'],	
							  'image' => $FetchInfo['txt_imagen'],
							  'pdf' => $FetchInfo['txt_pdf'],
							  'description' => $FetchInfo['txt_detalle'],
							  'title_youtube' => $FetchInfo['txt_title_youtube'],
							  'desc_youtube' => $FetchInfo['txt_descyoutube'],
							  'boleto' => $FetchInfo['txt_boleto'],
							  'traslate' => $FetchInfo['txt_traslate']							  
							   );
	}
    return  $get_data_array ;
}


public static function get_paquete_detail($pak_id, $language_id = 2) {
    global $languages_id;

    if ($language_id == 0) $language_id = $languages_id;
    $paquete_query = "SELECT txt_title, txt_presentacion,txt_detalle,txt_title_youtube,txt_descyoutube,txt_boleto,txt_traslate,txt_imagen, txt_pdf, txt_meta_title, txt_meta_description, txt_meta_keyword, txt_tours, txt_incluye FROM ";
	$paquete_query .= "[|PREFIX|]paquete_details WHERE";
	$paquete_query .= " fk_paquete = '" . (int)$pak_id . "' and language_id = '" . (int)$language_id . "' " ;

	$Query = $GLOBALS['CONNECT_DB']->Query($paquete_query) or die(mysql_error());
	
	while ($FetchPaquete = $GLOBALS['CONNECT_DB']->Fetch($Query)){
    $getpaquete[] = array('title' => $FetchPaquete['txt_title'],
						 'presentacion' => $FetchPaquete['txt_presentacion'],
						 'incluye' => $FetchPaquete['txt_incluye'],
						 'image' => $FetchPaquete['txt_imagen'],
						 'pdf' => $FetchPaquete['txt_pdf'],
						 'description' => $FetchPaquete['txt_detalle'],
						 'title_youtube' => $FetchPaquete['txt_title_youtube'],
						 'desc_youtube' => $FetchPaquete['txt_descyoutube'],
						 'boleto' => $FetchPaquete['txt_boleto'],
						 'traslate' => $FetchPaquete['txt_traslate'],
						 'meta_title' => $FetchPaquete['txt_meta_title'],
						 'meta_description' => $FetchPaquete['txt_meta_description'],
						 'meta_keyword' => $FetchPaquete['txt_meta_keyword']
						 );
	}					    
    return $getpaquete;
  }
  
  
function title_contentpage (){
 if(tep_not_null($this->getpk_paquete()) && validar_numero($this->getpk_paquete()) && $this->getpk_paquete()>0){ 
  $SQL = "SELECT txt_titulo FROM contenido WHERE pk_contenido='".$this->getpk_paquete()."' ";
  $Query = $GLOBALS['CONNECT_DB']->query($SQL) ;
   if($GLOBALS['CONNECT_DB']->num_rows($Query)==1){
    $Fetch = $GLOBALS['CONNECT_DB']->Fetch($Query);
	return utf8_encode($Fetch['txt_titulo']).TITLE_ADD;
   }else{
    return "No se ha encontrado el contenido .";
   }
  
 }
}

function TipoCambioDolares($valor){
	$SQL = "UPDATE tbl_configuration
				SET configuration_value='".$valor."'
			 WHERE configuration_key='_TIPOCAMBIO_DOL'"; 
	$Query = $GLOBALS['CONNECT_DB']->Query($SQL)or die(mysql_error());	
	
	$SQL2 = "UPDATE tbl_paquete 
				SET txt_tipo_cambio='".$valor."'"; 
	$Query = $GLOBALS['CONNECT_DB']->Query($SQL2)or die(mysql_error());		
	
	$SQL3 = "UPDATE tbl_paquete 
				SET txt_precio_soles = format(txt_precio * txt_tipo_cambio,2)"; 
	$Query = $GLOBALS['CONNECT_DB']->Query($SQL3)or die(mysql_error());			
}


function IsExistPaquete($IsStatus=false){
$SQLAND = "";
if($IsStatus==true)
$SQLAND = " int_status='1' ";

$SQL = "SELECT * FROM [|PREFIX|]paquete WHERE pk_paquete='".$this->getpk_paquete()."' $SQLAND";
$QueryExist = $GLOBALS['CONNECT_DB']->Query($SQL);
$Count = $GLOBALS['CONNECT_DB']->CountResult($QueryExist);
if($Count==0)
return false ;
else
return true ;
}



function listphoto_product(){

if(tep_not_null($this->getpk_paquete()) && validar_numero($this->getpk_paquete()) && $this->getpk_paquete()>0){

/*$SQL = $GLOBALS['CONNECT_DB']->Query("SELECT modelo_image.img_preview, modelo_image.pk_imgmodelo FROM modelo Inner Join modelo_image ON modelo.pk_modelo = modelo_image.fk_modelo WHERE modelo.pk_modelo =  '".$this->getpk_paquete()."' ORDER BY modelo_image.img_big ASC");
*/ 
 $SQL = $GLOBALS['CONNECT_DB']->Query("SELECT [|PREFIX|]paquete_image.pk_paqueteimg, [|PREFIX|]paquete_image.txt_imagemin FROM [|PREFIX|]paquete Inner Join [|PREFIX|]paquete_image ON [|PREFIX|]paquete.pk_paquete = [|PREFIX|]paquete_image.fk_producto WHERE [|PREFIX|]paquete_image.fk_producto =  '".$this->getpk_paquete()."' ORDER BY [|PREFIX|]paquete_image.pk_paqueteimg ASC");

 $count = $GLOBALS['CONNECT_DB']->CountResult($SQL);
   if($count>0){
      $str_photo = "";
      $fileimage = "";
	  while($Fetch = $GLOBALS['CONNECT_DB']->Fetch($SQL)) {
	      
	      $fileimage = base64_encode(ADMIN_IMG_PMIN.$Fetch['txt_imagemin']);
	      $str_photo .= "<div id=\"photo_list\">
				          <div id=\"image_model\"><img src='thumb-img.php?image=$fileimage&w=54&h=81' ></div>
				          <div id=\"input_listmodel\"><input name=\"chk_photoproduct[]\" id=\"chk_photoproduct[]\" type=\"checkbox\" value=\"{$Fetch['pk_paqueteimg']}\" /></div>
				         </div>";
	  }
	  return $str_photo;
   }
 }
 
} #fin de la funcion



function ImageRandProduct(){
$SQL = "SELECT txt_imagemin, txt_imagebig FROM [|PREFIX|]paquete_image WHERE fk_producto='".$this->getpk_paquete()."' ORDER BY pk_paqueteimg ASC" ;

$Query = $GLOBALS['CONNECT_DB']->Query($SQL);
$Count = $GLOBALS['CONNECT_DB']->CountResult($Query);
	while($Fetch = $GLOBALS['CONNECT_DB']->Fetch($Query)) 
	{
	   $model_data_array[] = array('imageprev' => $Fetch['txt_imagemin'],
	                               'imagebig' => $Fetch['txt_imagebig']
							   );
	}
  return  $model_data_array ;
}

# Paquete Internacional
function ListPaqInternacionales($from = 0, $to = 20, $page = 1){
  	global $language_dir;
	if(!$page)	$page = 1;
	
	$SQL = "SELECT pk_paquete,  txt_datepaquete,  [|PREFIX|]paquete.fk_categoria, [|PREFIX|]categoria.txt_nombre, [|PREFIX|]categoria.int_tipo, txt_youtube,  int_status,  [|PREFIX|]paquete.txt_dateadd,  txt_dateupdate,  txt_date_from,  txt_date_to,  int_dias,  int_noches,  txt_precio, int_ishome FROM [|PREFIX|]paquete LEFT JOIN [|PREFIX|]categoria ON [|PREFIX|]paquete.fk_categoria = [|PREFIX|]categoria.pk_categoria WHERE int_status='1' AND [|PREFIX|]categoria.int_tipo='2' ORDER BY txt_datepaquete DESC LIMIT ".$from.",".$to." ";
	
	$Query = $GLOBALS['CONNECT_DB']->Query($SQL);
    $count = $GLOBALS['CONNECT_DB']->CountResult($Query);
	$strgal_paquete = "";
    $ArrayDetails = "";
 
 if($count >= 1) {
	 if($count >= 1) {
		 $strgal_paquete .= "<ul class=\"ProductListInternacional\">";
    $j=1;
 	$class = "";
	while($Fetch = $GLOBALS['CONNECT_DB']->Fetch($Query)) {
	     $ArrayDetails = $this->get_paquete_detail($Fetch['pk_paquete']);
		 $ImgPaq = $ArrayDetails[0]['image'];
		 
		 $Title = stripslashes_deep($ArrayDetails[0]['title']);
	     $Title = utf8_decode($Title);
		 
	     
		 /*$link_paquete = _URL.'paquete_details.php?pid='.$Fetch['pk_paquete'];*/
		 
		 	
		if(_SEOMOD==1){
			$link_paquete = _URL."paquete/details-".safename($Title)."-pid-".$Fetch['pk_paquete']."."._FEXT;
		}else{
			$link_paquete = _URL.'paquete_details.php?pid='.$Fetch['pk_paquete'];
		}
		
		 
		 $folder_complete = DIR_WS_LANGUAGES.$language_dir.'/'._PAQUETES;
		 $img_thumb = $folder_complete.$ImgPaq;
		 
		 $strgal_paquete .= "<li style=\"height: 231px;\">";
		  $strgal_paquete .= "<div class=\"ProductImage\">";
		    $strgal_paquete .= "<a href=\"$link_paquete\" title=\"$Title\">";
			  $strgal_paquete .= tep_image(_URL.'resize.php?image='.$img_thumb.'&w=120&h=100&IsCrop=0',$Title,'','','');
			$strgal_paquete .= "</a>";  
		  $strgal_paquete .= "</div>";
		  
		  $strgal_paquete .= "<div class=\"ProductDetails\">";
		   $strgal_paquete .= "<strong>";
		    $strgal_paquete .= "<a href=\"$link_paquete\" title=\"$Title\" style=\"text-transform:uppercase\">";
			$strgal_paquete .= $Title;
			$strgal_paquete .= "</a>";
		   $strgal_paquete .= "</strong>";
			if(tep_not_null($Fetch['txt_precio'])) {
			$strgal_paquete .= "<em>Desde: {$Fetch['txt_precio']}</em>";
			}
		    $strgal_paquete .= "<span class=\"MoreView\">";
			$strgal_paquete .= "<a href=\"$link_paquete\" title=\"$Title\">";
			 $strgal_paquete .= _VIEWPAQS;
			 $strgal_paquete .= "</a>";
		    $strgal_paquete .= "</span>";
		  $strgal_paquete .= "</div>";
		 $strgal_paquete .= "</li>";
		 
		 if($j%4==0)$strgal_paquete .= "<div class=\"bot\"></div>";
		 
	   $j++;
	  }
	}
 }
 return $strgal_paquete;	  
}

function SearchPaquete($q='',$from = 0, $to = 20, $page = 1){
global $languages_id,$language_dir;
$languages = new language();
if($languages->IsExistLanguage($languages_id)) {
	
	$searchstring_search = $q;
	$searchstring_search = trim($searchstring_search);
	$searchstring_search = str_replace("%", '', $searchstring_search);
	$searchstring_search = htmlspecialchars($searchstring_search, ENT_NOQUOTES);
	$searchstring_search = secure_sql($searchstring_search);

	$sql_search = "SELECT [|PREFIX|]paquete.pk_paquete, [|PREFIX|]paquete.txt_precio, [|PREFIX|]paquete_details.fk_paquete, [|PREFIX|]paquete.int_ishome, [|PREFIX|]paquete_details.txt_detalle, [|PREFIX|]paquete_details.txt_title, [|PREFIX|]paquete_details.txt_incluye, [|PREFIX|]paquete_details.txt_imagen FROM [|PREFIX|]paquete ";
 $sql_search .= "Inner Join [|PREFIX|]paquete_details ON [|PREFIX|]paquete.pk_paquete = [|PREFIX|]paquete_details.fk_paquete WHERE [|PREFIX|]paquete_details.txt_title LIKE '%".$searchstring_search."%' ";
 $sql_search .= "AND [|PREFIX|]paquete_details.language_id = '".$languages_id."' AND int_status='1' ORDER BY [|PREFIX|]paquete.txt_datepaquete DESC LIMIT ".$from.", ".$to." ";	
 	
	$result_search = $GLOBALS['CONNECT_DB']->Query($sql_search);
	
	if(tep_not_null($searchstring_search))
		$num_rows = $GLOBALS['CONNECT_DB']->CountResult($result_search) ;
	else
		$num_rows = 0;
	
	$str_search = "";

	if($num_rows>0){
		$j=1;
		while($Fetch = $GLOBALS['CONNECT_DB']->Fetch($result_search)) {

		 	 $ImgPaq = $Fetch['txt_imagen'];		 
		 	 $Title = stripslashes_deep($Fetch['txt_title']);
			 
			 if(_SEOMOD==1){
				$link_paquete = _URL."paquete/oferta-".clean_url($Title)."-pid-".$Fetch['pk_paquete']."."._FEXT;
			 }else{
				$link_paquete = _URL.'paquete_detalle.php?pid='.$Fetch['pk_paquete'];
			 }
			 $folder_complete = DIR_WS_LANGUAGES.$language_dir.'/'._PAQUETES;
		 	 $img_thumb = $folder_complete.$ImgPaq;
			 
		$strgal_paquete .= "	<div align=\"center\" class=\"product_box margin_r_10\">";
		$strgal_paquete .= "		<a href=\"$link_paquete\">";
		$strgal_paquete .= tep_image(_URL.'resize.php?image='.$img_thumb.'&w=115&h=100&IsCrop=0',$Title,'','','class="imagen_cuadro"');
		$strgal_paquete .= "		</a>";
		$strgal_paquete .= "		<h3>";
		$strgal_paquete .= 				$Title;
		$strgal_paquete .= "		</h3>";
		
		$strgal_paquete .= "		<h2>";
		$strgal_paquete .= 				"DESDE: ";
		$strgal_paquete .= 				$Fetch['txt_precio'];
		$strgal_paquete .= "		</h2>";
		
		$botom = _URL."images/vermas.jpg";
		
		$strgal_paquete .= "		<h3>";
		$strgal_paquete .= "		<a title=\"$Title\" href=\"$link_paquete\">";
		$strgal_paquete .= "			<img src=\"$botom\"> ";
		$strgal_paquete .= "		</a>";
		$strgal_paquete .= "		</h3>";
		
		$strgal_paquete .= "	</div>";
		$j++;	 	
		
		} #cierro bucle while
	} #cierro $num_rows
 return $strgal_paquete;
 }
}#fin de la funcion



# Listado de Paquetes en General - Llamado por la categoria del Producto , no por el campo int_type
function ListPaquetesCategoria($from = 0, $to = 20){
  	global $language_dir;
	
	$SQL = "SELECT [|PREFIX|]paquete.pk_paquete,  [|PREFIX|]paquete.txt_datepaquete,  [|PREFIX|]paquete.fk_categoria, [|PREFIX|]categoria.txt_nombre, [|PREFIX|]categoria.int_tipo, txt_youtube,  int_status,  [|PREFIX|]paquete.txt_dateadd,  txt_dateupdate,  txt_date_from,  txt_date_to,  int_dias,  int_noches,  txt_precio, int_ishome, int_isdestacado, int_agotado, txt_precio_soles FROM [|PREFIX|]paquete LEFT JOIN [|PREFIX|]categoria ON [|PREFIX|]paquete.fk_categoria = [|PREFIX|]categoria.pk_categoria WHERE tbl_paquete.fk_categoria =  '".$this->getfk_categoria()."' AND int_status='1' ORDER BY txt_precio_soles ASC LIMIT ".$from.",".$to." ";
	
	$Query = $GLOBALS['CONNECT_DB']->Query($SQL);
    $count = $GLOBALS['CONNECT_DB']->CountResult($Query);
	 $strgal_paquete = "";
    $ArrayDetails = "";
 
 if($count >= 1) {
    $j=1;
 	$class = "";
	while($Fetch = $GLOBALS['CONNECT_DB']->Fetch($Query)) {
	     $ArrayDetails = $this->get_paquete_detail($Fetch['pk_paquete']);
		 $ImgPaq = $ArrayDetails[0]['image'];
		 
		 $Title = strtoupper(stripslashes_deep($ArrayDetails[0]['title']));
		 $Meta = removeEvilTags(stripslashes_deep($ArrayDetails[0]['presentacion']));
	     $Boleto = stripslashes_deep($ArrayDetails[0]['boleto']);
		 $Traslado = stripslashes_deep($ArrayDetails[0]['traslate']);	
		 $Incluye = stripslashes_deep($ArrayDetails[0]['incluye']);
		 
		 $Dias = $Fetch['int_dias']." Dias";
		 $Noches = $Fetch['int_noches']." Noches";
		
			if(_SEOMOD==1){
			$link_paquete = _URL."paquetes-".clean_url($Title)."-pid-".$Fetch['pk_paquete']."."._FEXT;
				}else{
			$link_paquete = _URL.'paquete_detalle.php?pid='.$Fetch['pk_paquete'];
			}

		 $folder_complete = DIR_WS_LANGUAGES.$language_dir.'/'._PAQUETES;
		 $img_thumb = base64_encode($folder_complete.$ImgPaq);
		 
		 $strgal_paquete .= "<div class=\"row odd\">";             
		 $strgal_paquete .= "	<div class=\"product1 floatleft width100\">";
		 $strgal_paquete .= "	  <div class=\"spacer\">";									
		 $strgal_paquete .= "		<div class=\"floatright col-2\">";
		 $strgal_paquete .= "			<div class=\"product-price marginbottom12\" id=\"productPrice6\">";		 
		 $strgal_paquete .= "               <div class=\"PricepriceWithoutTax\" style=\"display : block;\" >";
     $strgal_paquete .= "                  <span class=\"PricepriceWithoutTax\" style=\"color:#d10c51;\">Tarifas Desde:</span>";
     $strgal_paquete .= "              </div>";				 
		 $strgal_paquete .= "				<div class=\"PricesalesPrice\" style=\"display : block;\">";
		 $strgal_paquete .= "		<span class=\"PricesalesPrice\" style=\"color:#d10c51; font-weight:bold; font-size:22px\">$ ";
		 $strgal_paquete .= 				round(str_replace(',', '', $Fetch['txt_precio']))." &oacute; S/.".round(str_replace(',', '', $Fetch['txt_precio_soles']));
		 $strgal_paquete .= "		</span>";
     $strgal_paquete .= "               </div>";									
		 $strgal_paquete .= "		    </div>";
		 								
         $strgal_paquete .= "			<div class=\"addtocart-area\">";
         $strgal_paquete .= "           <form method=\"post\" class=\"product\" action=\"$link_paquete\" id=\"addtocartproduct6\">";
         $strgal_paquete .= "           <div class=\"addtocart-bar\">";
         $strgal_paquete .= "              <label for=\"quantity\" class=\"quantity_box\">Por Persona </label>";
         $strgal_paquete .= "              <span class=\"quantity-controls\">";
		 $strgal_paquete .= "              </span>";
 		 $strgal_paquete .= "			   <div class=\"clear\"></div>";
			$strgal_paquete .= "				<span class=\"addtocart-button\">";
			$strgal_paquete .= "					 <button class=\"btn-hover color-11\">";
			$strgal_paquete .= "						<a style=\"color:inherit\" href=\"$link_paquete\">VER OFERTA</a>";
			$strgal_paquete .= " 				</button>";
			$strgal_paquete .= "				</span>";	
         $strgal_paquete .= "              </div>";                                              
         $strgal_paquete .= "			</form>";
         $strgal_paquete .= "           </div>";                                    
		 $strgal_paquete .= "		  </div>";
         $strgal_paquete .= "		<div class=\"floatleft col-1\">";
		 $strgal_paquete .= "			<div class=\"browseProductImageContainer\">";
 		 $strgal_paquete .= "				<a href=\"$link_paquete\" class=\"img-scr\">";
         $strgal_paquete .= tep_image(_URL.'resize.php?image='.$img_thumb.'&w=220&h=220&IsCrop=0',$Title,'','','');
         $strgal_paquete .= "               </a>";
         $strgal_paquete .= "			</div>";                                    
		 $strgal_paquete .= "			<div class=\"padding-stock\">";
         $strgal_paquete .= "               <span class=\"vmicon vm2-normalstock\">";
		 $strgal_paquete .= "				</span>";
         $strgal_paquete .= "           </div>";																		
		 $strgal_paquete .= "	   </div>";					
		 
		 $strgal_paquete .= "<div class=\"floatleft col-3\">";
		 $strgal_paquete .= "	<div class=\"title-indent\">";
		 $strgal_paquete .= "	<h2><a style=\"font-weight:normal; color:#671E77; !important; font-size: 17px\" href=\"$link_paquete\">".$denominacion.$Title."</a></h2>";
		 #$strgal_paquete .= "	<p>".fewchars($Meta,100)."</p>";
		 $strgal_paquete .= "	<p>Incluye: ".fewchars($Incluye,1000)."</p>";																					
		 $strgal_paquete .= "	<div class=\"rating\">";
		 $strgal_paquete .= "		<span class=\"vote\">";
		 $strgal_paquete .= "		<span class=\"vmicon ratingbox\" style=\"display:inline-block;\">";
		 $strgal_paquete .= "		<span class=\"stars-orange\" style=\"width:0%\">";
		 $strgal_paquete .= "		</span>";
		 $strgal_paquete .= "		</span>";
		 $strgal_paquete .= "		</span>";
		 $strgal_paquete .= "</div>"; 	                                            
		 $strgal_paquete .= "		<div class=\"detal\">";
		 $strgal_paquete .= "			<a style=\"font-size:18px; color:#671E77; !important;\" href=\"$link_paquete\">".$Dias." - ".$Noches."</a>";
		 $strgal_paquete .= "		</div>";                                            
		 $strgal_paquete .= "	</div>";
		 $strgal_paquete .= "</div>";
		 $strgal_paquete .= "<div class=\"clear\"></div>";
		 $strgal_paquete .= "</div>";
		 $strgal_paquete .= "	</div>";
		 $strgal_paquete .= "<div class=\"clear\"></div>";
		 $strgal_paquete .= "</div>";
		 $strgal_paquete .= "<div class=\"horizontal-separator2\"></div>";
		 
	   $j++;
	  }
 }
 return $strgal_paquete;	  
}


#Paquete Nacional
function ListPaqNacionales($from = 0, $to = 20, $page = 1){
  	global $language_dir;
	if(!$page)	$page = 1;
	
	$SQL = "SELECT [|PREFIX|]paquete.pk_paquete,  [|PREFIX|]paquete.txt_datepaquete,  [|PREFIX|]paquete.fk_categoria, [|PREFIX|]categoria.txt_nombre, [|PREFIX|]categoria.int_tipo, txt_youtube,  int_status,  [|PREFIX|]paquete.txt_dateadd,  txt_dateupdate,  txt_date_from,  txt_date_to,  int_dias,  int_noches,  txt_precio, int_ishome FROM [|PREFIX|]paquete LEFT JOIN [|PREFIX|]categoria ON [|PREFIX|]paquete.fk_categoria = [|PREFIX|]categoria.pk_categoria WHERE int_status='1' AND [|PREFIX|]categoria.int_tipo='1' ORDER BY txt_datepaquete DESC LIMIT ".$from.",".$to." ";
	
	$Query = $GLOBALS['CONNECT_DB']->Query($SQL);
    $count = $GLOBALS['CONNECT_DB']->CountResult($Query);
	$strgal_paquete = "";
    $ArrayDetails = "";
 
 if($count >= 1) {
	 if($count >= 1) {
		 $strgal_paquete .= "<div class=\"ProductListNacional\">";
    $j=1;
 	$class = "";
	while($Fetch = $GLOBALS['CONNECT_DB']->Fetch($Query)) {
	     $ArrayDetails = $this->get_paquete_detail($Fetch['pk_paquete']);
		 $ImgPaq = $ArrayDetails[0]['image'];
		 
		 $Title = stripslashes_deep($ArrayDetails[0]['title']);
	     $Title = utf8_decode($Title);
	     
		 /*$link_paquete = _URL.'paquete_details.php?pid='.$Fetch['pk_paquete'];*/
		 
		 	
		if(_SEOMOD==1){
			$link_paquete = _URL."paquete/details-".safename($Title)."-pid-".$Fetch['pk_paquete']."."._FEXT;
		}else{
			$link_paquete = _URL.'paquete_details.php?pid='.$Fetch['pk_paquete'];
		}
		 
		 
		 $folder_complete = DIR_WS_LANGUAGES.$language_dir.'/'._PAQUETES;
		 $img_thumb = $folder_complete.$ImgPaq;
		 
		 $strgal_paquete .= "<div class=\"MainDivPaq";
		 if($j==3)$strgal_paquete .= " Last";
		 $strgal_paquete .= "\">";
		  $strgal_paquete .= "<div class=\"Title\">";
		    $strgal_paquete .= $Title;
		  $strgal_paquete .= "</div>";
		  
			  $strgal_paquete .= "<div align=\"center\" class=\"ImDiv\">";
	             $strgal_paquete .= tep_image(_URL.'resize.php?image='.$img_thumb.'&w=200&h=100&IsCrop=0',$Title,'','','class="border_img"');
			  $strgal_paquete .= "</div>";
			  
			 $strgal_paquete .= "<div align=\"center\" class=\"LinkBottom\">";
			  $strgal_paquete .= "<a href=\"$link_paquete\" title=\"$Title\">"._VIEWPAQS."</a>";
			 $strgal_paquete .= "</div>";
			  
			  
		 $strgal_paquete .= "</div>";#MainDiv
		 
		 if($j%3==0){$strgal_paquete .= "<div class=\"bot\"></div>";$j=0;}
		 
	   $j++;
	  }
	   $strgal_paquete .= "</div>";
	}
 }
 return $strgal_paquete;	  
}

#Paquete Lunas de Miel
function ListPaqLunasMiel($from = 0, $to = 20, $page = 1){
  	global $language_dir;
	if(!$page)	$page = 1;
	
	$SQL = "SELECT pk_paquete,  txt_datepaquete,  [|PREFIX|]paquete.fk_categoria, [|PREFIX|]categoria.txt_nombre, [|PREFIX|]categoria.int_tipo, txt_youtube,  int_status,  [|PREFIX|]paquete.txt_dateadd,  txt_dateupdate,  txt_date_from,  txt_date_to,  int_dias,  int_noches,  txt_precio, int_ishome FROM [|PREFIX|]paquete LEFT JOIN [|PREFIX|]categoria ON [|PREFIX|]paquete.fk_categoria = [|PREFIX|]categoria.pk_categoria WHERE int_status='1' AND [|PREFIX|]categoria.int_tipo='5' ORDER BY txt_datepaquete DESC LIMIT ".$from.",".$to." ";
	
	$Query = $GLOBALS['CONNECT_DB']->Query($SQL);
    $count = $GLOBALS['CONNECT_DB']->CountResult($Query);
	$strgal_paquete = "";
    $ArrayDetails = "";
 
 if($count >= 1) {
	 if($count >= 1) {
		 $strgal_paquete .= "<div class=\"ProductListNacional\">";
    $j=1;
 	$class = "";
	while($Fetch = $GLOBALS['CONNECT_DB']->Fetch($Query)) {
	     $ArrayDetails = $this->get_paquete_detail($Fetch['pk_paquete']);
		 $ImgPaq = $ArrayDetails[0]['image'];
		 
		 $Title = stripslashes_deep($ArrayDetails[0]['title']);
	     $Title = utf8_decode($Title);
	     
		 /*$link_paquete = _URL.'paquete_details.php?pid='.$Fetch['pk_paquete'];*/
		
		if(_SEOMOD==1){
			$link_paquete = _URL."paquete/details-".safename($Title)."-pid-".$Fetch['pk_paquete']."."._FEXT;
		}else{
			$link_paquete = _URL.'paquete_details.php?pid='.$Fetch['pk_paquete'];
		}
		 
		 $folder_complete = DIR_WS_LANGUAGES.$language_dir.'/'._PAQUETES;
		 $img_thumb = $folder_complete.$ImgPaq;
		 
		 $strgal_paquete .= "<div class=\"MainDivPaq";
		 if($j==3)$strgal_paquete .= " Last";
		 $strgal_paquete .= "\">";
		  $strgal_paquete .= "<div class=\"Title\">";
		    $strgal_paquete .= $Title;
		  $strgal_paquete .= "</div>";
		  
			  $strgal_paquete .= "<div align=\"center\" class=\"ImDiv\">";
	             $strgal_paquete .= tep_image(_URL.'resize.php?image='.$img_thumb.'&w=200&h=100&IsCrop=0',$Title,'','','class="border_img"');
			  $strgal_paquete .= "</div>";
			  
			 $strgal_paquete .= "<div class=\"LinkBottom\">";
			  $strgal_paquete .= "<a href=\"$link_paquete\" title=\"$Title\">"._VIEWPAQS."</a>";
			 $strgal_paquete .= "</div>";
			  
			  
		 $strgal_paquete .= "</div>";#MainDiv
		 
		 if($j%3==0){$strgal_paquete .= "<div class=\"bot\"></div>";$j=0;}
		 
	   $j++;
	  }
	   $strgal_paquete .= "</div>";
	}
 }
 return $strgal_paquete;	  
}

#Paquete Cruceros
function ListPaqCruceros($from = 0, $to = 20, $page = 1){
  	global $language_dir;
	if(!$page)	$page = 1;
	
	$SQL = "SELECT pk_paquete,  txt_datepaquete,  [|PREFIX|]paquete.fk_categoria, [|PREFIX|]categoria.txt_nombre, [|PREFIX|]categoria.int_tipo, txt_youtube,  int_status,  [|PREFIX|]paquete.txt_dateadd,  txt_dateupdate,  txt_date_from,  txt_date_to,  int_dias,  int_noches,  txt_precio, int_ishome FROM [|PREFIX|]paquete LEFT JOIN [|PREFIX|]categoria ON [|PREFIX|]paquete.fk_categoria = [|PREFIX|]categoria.pk_categoria WHERE int_status='1' AND [|PREFIX|]categoria.int_tipo='6' ORDER BY txt_datepaquete DESC LIMIT ".$from.",".$to." ";
	
	$Query = $GLOBALS['CONNECT_DB']->Query($SQL);
    $count = $GLOBALS['CONNECT_DB']->CountResult($Query);
	$strgal_paquete = "";
    $ArrayDetails = "";
 
 if($count >= 1) {
	 if($count >= 1) {
		 $strgal_paquete .= "<div class=\"ProductListNacional\">";
    $j=1;
 	$class = "";
	while($Fetch = $GLOBALS['CONNECT_DB']->Fetch($Query)) {
	     $ArrayDetails = $this->get_paquete_detail($Fetch['pk_paquete']);
		 $ImgPaq = $ArrayDetails[0]['image'];
		 
		 $Title = stripslashes_deep($ArrayDetails[0]['title']);
	     $Title = utf8_decode($Title);
	     $link_paquete = _URL.'paquete_details.php?pid='.$Fetch['pk_paquete'];
		 $folder_complete = DIR_WS_LANGUAGES.$language_dir.'/'._PAQUETES;
		 $img_thumb = $folder_complete.$ImgPaq;
		 
		 $strgal_paquete .= "<div class=\"MainDivPaq";
		 if($j==3)$strgal_paquete .= " Last";
		 $strgal_paquete .= "\">";
		  $strgal_paquete .= "<div class=\"Title\">";
		    $strgal_paquete .= $Title;
		  $strgal_paquete .= "</div>";
		  
			  $strgal_paquete .= "<div align=\"center\" class=\"ImDiv\">";
	             $strgal_paquete .= tep_image(_URL.'resize.php?image='.$img_thumb.'&w=200&h=100&IsCrop=0',$Title,'','','class="border_img"');
			  $strgal_paquete .= "</div>";
			  
			 $strgal_paquete .= "<div class=\"LinkBottom\">";
			  $strgal_paquete .= "<a href=\"$link_paquete\" title=\"$Title\">"._VIEWPAQS."</a>";
			 $strgal_paquete .= "</div>";
			  
			  
		 $strgal_paquete .= "</div>";#MainDiv
		 
		 if($j%3==0){$strgal_paquete .= "<div class=\"bot\"></div>";$j=0;}
		 
	   $j++;
	  }
	   $strgal_paquete .= "</div>";
	}
 }
 return $strgal_paquete;	  
}


#Paquete School Strips
function ListPaqSchool($from = 0, $to = 20, $page = 1){
  	global $language_dir;
	if(!$page)	$page = 1;
	
	$SQL = "SELECT pk_paquete,  txt_datepaquete,  [|PREFIX|]paquete.fk_categoria, [|PREFIX|]categoria.txt_nombre, [|PREFIX|]categoria.int_tipo, txt_youtube,  int_status,  [|PREFIX|]paquete.txt_dateadd,  txt_dateupdate,  txt_date_from,  txt_date_to,  int_dias,  int_noches,  txt_precio, int_ishome FROM [|PREFIX|]paquete LEFT JOIN [|PREFIX|]categoria ON [|PREFIX|]paquete.fk_categoria = [|PREFIX|]categoria.pk_categoria WHERE int_status='1' AND [|PREFIX|]categoria.int_tipo='7' ORDER BY txt_datepaquete DESC LIMIT ".$from.",".$to." ";
	
	$Query = $GLOBALS['CONNECT_DB']->Query($SQL);
    $count = $GLOBALS['CONNECT_DB']->CountResult($Query);
	$strgal_paquete = "";
    $ArrayDetails = "";
 
 if($count >= 1) {
	 if($count >= 1) {
		 $strgal_paquete .= "<div class=\"ProductListNacional\">";
    $j=1;
 	$class = "";
	while($Fetch = $GLOBALS['CONNECT_DB']->Fetch($Query)) {
	     $ArrayDetails = $this->get_paquete_detail($Fetch['pk_paquete']);
		 $ImgPaq = $ArrayDetails[0]['image'];
		 
		 $Title = stripslashes_deep($ArrayDetails[0]['title']);
	     $Title = utf8_decode($Title);
	     $link_paquete = _URL.'paquete_details.php?pid='.$Fetch['pk_paquete'];
		 $folder_complete = DIR_WS_LANGUAGES.$language_dir.'/'._PAQUETES;
		 $img_thumb = $folder_complete.$ImgPaq;
		 
		 $strgal_paquete .= "<div class=\"MainDivPaq";
		 if($j==3)$strgal_paquete .= " Last";
		 $strgal_paquete .= "\">";
		  $strgal_paquete .= "<div class=\"Title\">";
		    $strgal_paquete .= $Title;
		  $strgal_paquete .= "</div>";
		  
			  $strgal_paquete .= "<div align=\"center\" class=\"ImDiv\">";
	             $strgal_paquete .= tep_image(_URL.'resize.php?image='.$img_thumb.'&w=200&h=100&IsCrop=0',$Title,'','','class="border_img"');
			  $strgal_paquete .= "</div>";
			  
			 $strgal_paquete .= "<div class=\"LinkBottom\">";
			  $strgal_paquete .= "<a href=\"$link_paquete\" title=\"$Title\">"._VIEWPAQS."</a>";
			 $strgal_paquete .= "</div>";
			  
			  
		 $strgal_paquete .= "</div>";#MainDiv
		 
		 if($j%3==0){$strgal_paquete .= "<div class=\"bot\"></div>";$j=0;}
		 
	   $j++;
	  }
	   $strgal_paquete .= "</div>";
	}
 }
 return $strgal_paquete;	  
}


#Paquete Promociones
function ListPaqPromociones($from = 0, $to = 20, $page = 1){
  	global $language_dir;
	if(!$page)	$page = 1;
	
	$SQL = "SELECT pk_paquete,  txt_datepaquete,  [|PREFIX|]paquete.fk_categoria, [|PREFIX|]categoria.txt_nombre, [|PREFIX|]categoria.int_tipo, txt_youtube,  int_status,  [|PREFIX|]paquete.txt_dateadd,  txt_dateupdate,  txt_date_from,  txt_date_to,  int_dias,  int_noches,  txt_precio, int_ishome FROM [|PREFIX|]paquete LEFT JOIN [|PREFIX|]categoria ON [|PREFIX|]paquete.fk_categoria = [|PREFIX|]categoria.pk_categoria WHERE int_status='1' AND [|PREFIX|]categoria.int_tipo='3' ORDER BY txt_datepaquete DESC LIMIT ".$from.",".$to." ";
	
	$Query = $GLOBALS['CONNECT_DB']->Query($SQL);
    $count = $GLOBALS['CONNECT_DB']->CountResult($Query);
	$strgal_paquete = "";
    $ArrayDetails = "";
 
 if($count >= 1) {
	 if($count >= 1) {
		 $strgal_paquete .= "<div class=\"ProductListProm\">";

 	$class = "";
	while($Fetch = $GLOBALS['CONNECT_DB']->Fetch($Query)) {
	     $ArrayDetails = $this->get_paquete_detail($Fetch['pk_paquete']);
		 $ImgPaq = $ArrayDetails[0]['image'];
		 
		 $Title = stripslashes_deep($ArrayDetails[0]['title']);
	     $Title = utf8_decode($Title);
		 
		 $Traslado = stripslashes_deep($ArrayDetails[0]['traslate']);
	     $Traslado = utf8_decode($Traslado);
		 
		 
		 $Description = $ArrayDetails[0]['description'];
	     $Description = removeEvilTags($Description);
	     $Description = fewchars($Description,200);
		 
		 
		 /*$link_paquete = _URL.'paquete_details.php?pid='.$Fetch['pk_paquete'];*/
		 
		 	
		if(_SEOMOD==1){
			$link_paquete = _URL."paquete/details-".safename($Title)."-pid-".$Fetch['pk_paquete']."."._FEXT;
		}else{
			$link_paquete = _URL.'paquete_details.php?pid='.$Fetch['pk_paquete'];
		}
		 
		 
		 $folder_complete = DIR_WS_LANGUAGES.$language_dir.'/'._PAQUETES;
		 $img_thumb = $folder_complete.$ImgPaq;
		 
		 $strgal_paquete .= "<div class=\"MainProm\">";
		  
		  
			 #Inicio del Left Col
			 $strgal_paquete .= "<div class=\"LeftCol\">";
               $strgal_paquete .= "<div class=\"Title\">";
			    $strgal_paquete .= $Title;
			   $strgal_paquete .= "</div>";#Title
			   
			   $strgal_paquete .= "<div class=\"Img\">";
			      $strgal_paquete .= tep_image(_URL.'resize.php?image='.$img_thumb.'&w=138&h=90&IsCrop=0',$Title,'','','class="border_img"');
			   $strgal_paquete .= "</div>";
			 
			 $strgal_paquete .= "</div>";#LeftCol
			 #Fin del Left Col
			 
			 
			 #Inicio del RightCol
			  $strgal_paquete .= "<div class=\"RightCol\">";
			  
			    $strgal_paquete .= "<div class=\"MainPrice\">";
				  $strgal_paquete .= "<div class=\"AllTitle\">";
				    $strgal_paquete .= TITLE_TRAVELTO; # Viaje desde
				  $strgal_paquete .= "</div>";
				  $strgal_paquete .= "<div class=\"Price\">";
				   $strgal_paquete .= $Fetch['txt_precio'];
				  $strgal_paquete .= "</div>";				  
				$strgal_paquete .= "</div>";#Main Price
				
				#Linea Derecha / Precio
				$strgal_paquete .= "<div class=\"LineRight\"></div>";
				
			 
				 $strgal_paquete .= "<div class=\"AllTitle\">";
					$strgal_paquete .= TITLE_PROM_TRASLATE;
				 $strgal_paquete .= "</div>";
				 $strgal_paquete .= "<div class=\"Traslado\">";
				  $strgal_paquete .= $Traslado;
				 $strgal_paquete .= "</div>";#Traslado
			 	
			
			$strgal_paquete .= "<div class=\"LineBottom\"></div>";
			
			
			#Info Right
			
			  $strgal_paquete .= "<div class=\"AllTitle\">";
			    $strgal_paquete .= TITLE_PROMRIGHT;
			  $strgal_paquete .= "</div>";
			
			$strgal_paquete .= "<div class=\"Info\">";
			  $strgal_paquete .= $Description;
			$strgal_paquete .= "</div>";
			#Info Right
			
			#View Paq
			$strgal_paquete .= "<div class=\"ViewPaq\">";
			  $strgal_paquete .= "<a href=\"$link_paquete\" title=\"$Title\">";
			   $strgal_paquete .= _VIEWPAQS;
			  $strgal_paquete .= "</a>";
			$strgal_paquete .= "</div>";
			
			
				
			  $strgal_paquete .= "</div>";
			 #Fin del RightCol
			  
		 $strgal_paquete .= "</div>";#MainProm
		 
	  }
	   $strgal_paquete .= "</div>";#ProductListProm
	}
 }
 return $strgal_paquete;	  
}


#Paquete Promociones
function ListPaqSalidas($from = 0, $to = 20, $page = 1){
  	global $language_dir;
	if(!$page)	$page = 1;
	
	$SQL = "SELECT pk_paquete,  txt_datepaquete,  [|PREFIX|]paquete.fk_categoria, [|PREFIX|]categoria.txt_nombre, [|PREFIX|]categoria.int_tipo, txt_youtube,  int_status,  [|PREFIX|]paquete.txt_dateadd,  txt_dateupdate,  txt_date_from,  txt_date_to,  int_dias,  int_noches,  txt_precio, int_ishome FROM [|PREFIX|]paquete LEFT JOIN [|PREFIX|]categoria ON [|PREFIX|]paquete.fk_categoria = [|PREFIX|]categoria.pk_categoria WHERE int_status='1' AND [|PREFIX|]categoria.int_tipo='4' ORDER BY txt_datepaquete DESC LIMIT ".$from.",".$to." ";
	
	$Query = $GLOBALS['CONNECT_DB']->Query($SQL);
    $count = $GLOBALS['CONNECT_DB']->CountResult($Query);
	$strgal_paquete = "";
    $ArrayDetails = "";
 
 if($count >= 1) {
	 if($count >= 1) {
		 $strgal_paquete .= "<div class=\"ProductListProm\">";

 	$class = "";
	while($Fetch = $GLOBALS['CONNECT_DB']->Fetch($Query)) {
	     $ArrayDetails = $this->get_paquete_detail($Fetch['pk_paquete']);
		 $ImgPaq = $ArrayDetails[0]['image'];
		 
		 $Title = stripslashes_deep($ArrayDetails[0]['title']);
	     $Title = utf8_decode($Title);
		 
		 $Traslado = stripslashes_deep($ArrayDetails[0]['traslate']);
	     $Traslado = utf8_decode($Traslado);
		 
		 
		 $Description = $ArrayDetails[0]['description'];
	     $Description = removeEvilTags($Description);
	     $Description = fewchars($Description,200);
		 
		 
		 /*$link_paquete = _URL.'paquete_details.php?pid='.$Fetch['pk_paquete'];*/
		 
		 if(_SEOMOD==1){
			$link_paquete = _URL."paquete/details-".safename($Title)."-pid-".$Fetch['pk_paquete']."."._FEXT;
		}else{
			$link_paquete = _URL.'paquete_details.php?pid='.$Fetch['pk_paquete'];
		}
		 
		 
		 
		 $folder_complete = DIR_WS_LANGUAGES.$language_dir.'/'._PAQUETES;
		 $img_thumb = $folder_complete.$ImgPaq;
		 
		 $strgal_paquete .= "<div class=\"MainProm\">";
		  
		  
			 #Inicio del Left Col
			 $strgal_paquete .= "<div class=\"LeftCol\">";
               $strgal_paquete .= "<div class=\"Title\">";
			    $strgal_paquete .= $Title;
			   $strgal_paquete .= "</div>";#Title
			   
			   $strgal_paquete .= "<div class=\"Img\">";
			      $strgal_paquete .= tep_image(_URL.'resize.php?image='.$img_thumb.'&w=138&h=90&IsCrop=0',$Title,'','','class="border_img"');
			   $strgal_paquete .= "</div>";
			 
			 $strgal_paquete .= "</div>";#LeftCol
			 #Fin del Left Col
			 
			 
			 #Inicio del RightCol
			  $strgal_paquete .= "<div class=\"RightCol\">";
			  
			    $strgal_paquete .= "<div class=\"MainPrice\">";
				  $strgal_paquete .= "<div class=\"AllTitle\">";
				    $strgal_paquete .= TITLE_TRAVELTO; # Viaje desde
				  $strgal_paquete .= "</div>";
				  $strgal_paquete .= "<div class=\"Price\">";
				   $strgal_paquete .= $Fetch['txt_precio'];
				  $strgal_paquete .= "</div>";				  
				$strgal_paquete .= "</div>";#Main Price
				
				#Linea Derecha / Precio
				$strgal_paquete .= "<div class=\"LineRight\"></div>";
				
			 
				 $strgal_paquete .= "<div class=\"AllTitle\">";
					$strgal_paquete .= TITLE_PROM_TRASLATE;
				 $strgal_paquete .= "</div>";
				 $strgal_paquete .= "<div class=\"Traslado\">";
				  $strgal_paquete .= $Traslado;
				 $strgal_paquete .= "</div>";#Traslado
			 	
			
			$strgal_paquete .= "<div class=\"LineBottom\"></div>";
			
			
			#Info Right
			
			  $strgal_paquete .= "<div class=\"AllTitle\">";
			    $strgal_paquete .= TITLE_PROMRIGHT;
			  $strgal_paquete .= "</div>";
			
			$strgal_paquete .= "<div class=\"Info\">";
			  $strgal_paquete .= $Description;
			$strgal_paquete .= "</div>";
			#Info Right
			
			#View Paq
			$strgal_paquete .= "<div class=\"ViewPaq\">";
			  $strgal_paquete .= "<a href=\"$link_paquete\" title=\"$Title\">";
			   $strgal_paquete .= _VIEWPAQS;
			  $strgal_paquete .= "</a>";
			$strgal_paquete .= "</div>";
			
			
				
			  $strgal_paquete .= "</div>";
			 #Fin del RightCol
			  
		 $strgal_paquete .= "</div>";#MainProm
		 
	  }
	   $strgal_paquete .= "</div>";#ProductListProm
	}
 }
 return $strgal_paquete;	  
}




#LISTA DE PAQUETES
function ListPaquete($from = 0, $to = 20, $page = 1, $nivel){
global $language_dir;
if(!$page)	$page = 1;
 
 switch($nivel){
	 case 1:
	 $PackagesTravel = $this->ListPaqNacionales($from,$to,$page);
	 break;
	 case 3:
	 $PackagesTravel = $this->ListPaqPromociones($from,$to,$page);
	 break;
	 case 2:
	 $PackagesTravel = $this->ListPaqInternacionales($from,$to,$page);
	 break;
	 case 4:
	 $PackagesTravel = $this->ListPaqSalidas($from,$to,$page);
	 break;
	 case 5:
	 $PackagesTravel = $this->ListPaqLunasMiel($from,$to,$page);
	 break;
	 case 6:
	 $PackagesTravel = $this->ListPaqCruceros($from,$to,$page);
	 break;
	 case 7:
	 $PackagesTravel = $this->ListPaqSchool($from,$to,$page);
	 break;
	 
 }
 return $PackagesTravel;
}


function ListaPaquete_PlanConfirmado(){
global $languages_id,$language_dir;

$languages = new language();

if($languages->IsExistLanguage($languages_id)) {

$SQL = "SELECT tbl_paquete.txt_precio, tbl_paquete_details.fk_paquete, tbl_paquete.int_ishome, tbl_paquete_details.txt_detalle, tbl_paquete_details.txt_title, tbl_paquete_details.txt_incluye FROM tbl_paquete
INNER JOIN tbl_paquete_details ON tbl_paquete.pk_paquete = tbl_paquete_details.fk_paquete
WHERE tbl_paquete.fk_categoria = '124' AND tbl_paquete_details.language_id = '2' AND int_status = '1' AND int_isnuevo = '1' ORDER BY tbl_paquete.txt_datepaquete DESC LIMIT 0 , 5";

$Query = $GLOBALS['CONNECT_DB']->Query($SQL);

$str_vacaciones = "";
$j=1;
$ArrayDetails = "";
while($Fetch = $GLOBALS['CONNECT_DB']->Fetch($Query)){

	$title_paquete = tep_output_string($Fetch['txt_title']);
	$title_paquete = $title_paquete;
	
	$folder_complete = DIR_WS_LANGUAGES.$language_dir.'/'._PAQUETES;	
	
	$ArrayDetails = $this->get_paquete_detail($Fetch['fk_paquete']);
	
	$ImgPaq = $ArrayDetails[0]['image'];
	
	if(_SEOMOD==1){
			$link_paquete = _URL."paquete/oferta-".safename($title_paquete)."-pid-".$Fetch['fk_paquete']."."._FEXT;
		}else{
			$link_paquete = _URL.'paquete_detalle.php?pid='.$Fetch['fk_paquete'];
	}
	
	if($ImgPaq=='' || !file_exists($folder_complete.$ImgPaq))
	  $img_thumb = $folder_complete.'img_noavailable.jpg';
	else
	  $img_thumb = $folder_complete.$ImgPaq;

		$str_vacaciones .= "<li>";
		$str_vacaciones .= "		<div class=\"thumbnail\">";
		$str_vacaciones .= tep_image(_URL.'resize.php?image='.$img_thumb.'&w=40&h=40&IsCrop=0',$Title,'','','');
		$str_vacaciones .= "		</div>";
		$str_vacaciones .= "		<div class=\"info\">";
		$str_vacaciones .= "			<span class=\"cat\"><a title=\"$title_paquete\" href=\"$link_paquete\">";
		$str_vacaciones .= 					fewchars($title_paquete,135);
		$str_vacaciones .= "			</a></span>";
		$str_vacaciones .= "		</div>";
		$str_vacaciones .= "		<div class=\"clear\"></div>";
		$str_vacaciones .= "</li>";


	 $j++; 	 
	}
   return   $str_vacaciones;                     
   }                    	
 }


function ListaPaquete_ToursPeru(){
global $languages_id,$language_dir;

$languages = new language();

if($languages->IsExistLanguage($languages_id)) {

$SQL = "SELECT tbl_paquete.txt_precio, tbl_paquete_details.fk_paquete, tbl_paquete.int_ishome, tbl_paquete_details.txt_detalle, tbl_paquete_details.txt_title, tbl_paquete_details.txt_incluye FROM tbl_paquete
INNER JOIN tbl_paquete_details ON tbl_paquete.pk_paquete = tbl_paquete_details.fk_paquete
WHERE tbl_paquete.fk_categoria = '45' AND tbl_paquete_details.language_id = '2' AND int_status = '1' AND int_isnuevo = '1' ORDER BY tbl_paquete.txt_datepaquete DESC LIMIT 0 , 5";

$Query = $GLOBALS['CONNECT_DB']->Query($SQL);

$str_vacaciones = "";
$j=1;
$ArrayDetails = "";
while($Fetch = $GLOBALS['CONNECT_DB']->Fetch($Query)){

	$title_paquete = tep_output_string($Fetch['txt_title']);
	$title_paquete = utf8_decode($title_paquete);
	
	$folder_complete = DIR_WS_LANGUAGES.$language_dir.'/'._PAQUETES;	
	$ArrayDetails = $this->get_paquete_detail($Fetch['fk_paquete']);	
	$ImgPaq = $ArrayDetails[0]['image'];
	
	if(_SEOMOD==1){
			$link_paquete = _URL."paquete/oferta-".safename($title_paquete)."-pid-".$Fetch['fk_paquete']."."._FEXT;
		}else{
			$link_paquete = _URL.'paquete_detalle.php?pid='.$Fetch['fk_paquete'];
	}
	
	if($ImgPaq=='' || !file_exists($folder_complete.$ImgPaq))
	  $img_thumb = $folder_complete.'img_noavailable.jpg';
	else
	  $img_thumb = $folder_complete.$ImgPaq;
	  

		$str_vacaciones .= "<li>";
		$str_vacaciones .= "		<div class=\"thumbnail\">";
		$str_vacaciones .= tep_image(_URL.'resize.php?image='.$img_thumb.'&w=40&h=40&IsCrop=0',$Title,'','','');
		$str_vacaciones .= "		</div>";
		$str_vacaciones .= "		<div class=\"info\">";
		$str_vacaciones .= "			<span class=\"cat\"><a title=\"$title_paquete\" href=\"$link_paquete\">";
		$str_vacaciones .= 					fewchars($title_paquete,135);
		$str_vacaciones .= "			</a></span>";
		$str_vacaciones .= "		</div>";
		$str_vacaciones .= "		<div class=\"clear\"></div>";
		$str_vacaciones .= "</li>";


	 $j++; 	 
	}
   return   $str_vacaciones;                     
   }                    	
 }

function ListaPaquete_PortadaSuperior(){
global $languages_id,$language_dir;

$languages = new language();

if($languages->IsExistLanguage($languages_id)) {

$SQL = "SELECT tbl_paquete.txt_precio, tbl_paquete_details.fk_paquete, tbl_paquete.int_ishome, tbl_paquete_details.txt_detalle, tbl_paquete_details.txt_title, tbl_paquete_details.txt_incluye FROM tbl_paquete
INNER JOIN tbl_paquete_details ON tbl_paquete.pk_paquete = tbl_paquete_details.fk_paquete
WHERE tbl_paquete.fk_categoria = '107' AND tbl_paquete_details.language_id = '".$languages_id."' AND int_status = '1' ORDER BY tbl_paquete.txt_datepaquete DESC LIMIT 0 , 30";

$Query = $GLOBALS['CONNECT_DB']->Query($SQL);

$str_vacaciones = "";
$j=1;
$ArrayDetails = "";
while($Fetch = $GLOBALS['CONNECT_DB']->Fetch($Query)){

	$title_paquete = tep_output_string($Fetch['txt_title']);
	$title_paquete = $title_paquete;	
	
	$folder_complete = DIR_WS_LANGUAGES.$language_dir.'/'._PAQUETES;	
	
	$ArrayDetails = $this->get_paquete_detail($Fetch['fk_paquete']);
	
	$ImgPaq = $ArrayDetails[0]['image'];
	
	if(_SEOMOD==1){
			$link_paquete = _URL."paquete/oferta-".safename($title_paquete)."-pid-".$Fetch['fk_paquete']."."._FEXT;
		}else{
			$link_paquete = _URL.'paquete_detalle.php?pid='.$Fetch['fk_paquete'];
	}
	
	if($ImgPaq=='' || !file_exists($folder_complete.$ImgPaq))
	  $img_thumb = $folder_complete.'img_noavailable.jpg';
	else
	  $img_thumb = $folder_complete.$ImgPaq;

		$str_vacaciones .= "<div>";
		$str_vacaciones .= " <a href=\"$link_paquete\" title=\"Project 1\" class=\"alignright_block\">";		
		$str_vacaciones .= 		tep_image(_URL.'resize.php?image='.$img_thumb.'&w=291&h=148&IsCrop=1',$Title,'','','class="gray-frame padding-5"');
		$str_vacaciones .= "</a>";
		$str_vacaciones .= " <h3 class=\"heading h3\">";
				$str_vacaciones .= 					fewchars($title_paquete,195);
		$str_vacaciones .= " </h3>";
		$str_vacaciones .= " <p>";
		$str_vacaciones .= "Para m&aacute;s informaci&oacute;n de este destino: precios, itinerario, hoteles etc... <br><center><a href=\"$link_paquete\"><img src=\"images/mas_info.gif\"></a></center></p>";
		$str_vacaciones .= "</div>";
	 $j++; 	 
	}
   return   $str_vacaciones;                     
   }                    	
 }


function ListaPaquete_VacacionesConfirmadas(){
global $languages_id,$language_dir;

$languages = new language();

if($languages->IsExistLanguage($languages_id)) {

$SQL = "SELECT tbl_paquete.txt_precio, tbl_paquete_details.fk_paquete, tbl_paquete.int_ishome, tbl_paquete_details.txt_detalle, tbl_paquete_details.txt_title, tbl_paquete_details.txt_incluye FROM tbl_paquete
INNER JOIN tbl_paquete_details ON tbl_paquete.pk_paquete = tbl_paquete_details.fk_paquete
WHERE tbl_paquete.fk_categoria = '122' AND tbl_paquete_details.language_id = '".$languages_id."' AND int_status = '1' AND int_isnuevo = '1' ORDER BY tbl_paquete.txt_datepaquete DESC LIMIT 0 , 30";

$Query = $GLOBALS['CONNECT_DB']->Query($SQL);

$str_vacaciones = "";
$j=1;
$ArrayDetails = "";
$str_vacaciones .= "<ul>";
while($Fetch = $GLOBALS['CONNECT_DB']->Fetch($Query)){

	$title_paquete = tep_output_string($Fetch['txt_title']);
	$title_paquete = utf8_decode($title_paquete);	
	
	$folder_complete = DIR_WS_LANGUAGES.$language_dir.'/'._PAQUETES;	
	
	$ArrayDetails = $this->get_paquete_detail($Fetch['fk_paquete']);
	
	$ImgPaq = $ArrayDetails[0]['image'];
	
	if(_SEOMOD==1){
			$link_paquete = _URL."paquete/oferta-".safename($title_paquete)."-pid-".$Fetch['fk_paquete']."."._FEXT;
		}else{
			$link_paquete = _URL.'paquete_detalle.php?pid='.$Fetch['fk_paquete'];
	}
	
	if($ImgPaq=='' || !file_exists($folder_complete.$ImgPaq))
	  $img_thumb = $folder_complete.'img_noavailable.jpg';
	else
	  $img_thumb = $folder_complete.$ImgPaq;

		$str_vacaciones .= "<li>";
		$str_vacaciones .= "		<div class=\"thumbnail\">";
		$str_vacaciones .= tep_image(_URL.'resize.php?image='.$img_thumb.'&w=40&h=40&IsCrop=0',$Title,'','','');
		$str_vacaciones .= "		</div>";
		$str_vacaciones .= "		<div class=\"info\">";
		$str_vacaciones .= "			<span class=\"cat\"><a title=\"$title_paquete\" href=\"$link_paquete\">";
		$str_vacaciones .= 					fewchars($title_paquete,135);
		$str_vacaciones .= "			</a></span>";
		$str_vacaciones .= "		</div>";
		$str_vacaciones .= "		<div class=\"clear\"></div>";
		$str_vacaciones .= "</li>";

	 $j++; 	 
	}
	$str_vacaciones .= "</ul>";
   return   $str_vacaciones;                     
   }                    	
 }



function DestacadosPaquete($from = 0,$to = 0, $categoria){
global $languages_id,$language_dir;

$languages = new language();
	
if($languages->IsExistLanguage($languages_id)) {
	
 $SQL = "SELECT [|PREFIX|]paquete.txt_precio, [|PREFIX|]paquete_details.fk_paquete, [|PREFIX|]paquete.int_ishome, [|PREFIX|]paquete_details.txt_detalle, [|PREFIX|]paquete_details.txt_title, [|PREFIX|]paquete_details.txt_incluye FROM [|PREFIX|]paquete ";
 $SQL .= "Inner Join [|PREFIX|]paquete_details ON [|PREFIX|]paquete.pk_paquete = [|PREFIX|]paquete_details.fk_paquete WHERE [|PREFIX|]paquete_details.language_id = '".$languages_id."' AND int_status='1' AND [|PREFIX|]paquete.fk_categoria = '$categoria' ORDER BY [|PREFIX|]paquete.pk_paquete DESC LIMIT ".$from.",".$to." ";
 
 $Query = 	$GLOBALS['CONNECT_DB']->Query($SQL);
 
 $str_destacado = "";
 
 $j=1;
 $ArrayDetails = "";
 while($Fetch = $GLOBALS['CONNECT_DB']->Fetch($Query)){
  	$ArrayDetails = $this->get_paquete_detail($Fetch['fk_paquete']);

	$folder_complete = DIR_WS_LANGUAGES.$language_dir.'/'._PAQUETES;
	
	$ImgPaq = $ArrayDetails[0]['image'];
	
	$title_paquete = tep_output_string($Fetch['txt_title']);
	$title_paquete = utf8_decode($title_paquete);
	
	if(_SEOMOD==1){
			$link_paquete = _URL."paquete/oferta-".safename($title_paquete)."-pid-".$Fetch['fk_paquete']."."._FEXT;
		}else{
			$link_paquete = _URL.'paquete_detalle.php?pid='.$Fetch['fk_paquete'];
	}
	     
	if($ImgPaq=='' || !file_exists($folder_complete.$ImgPaq))
	  $img_thumb = $folder_complete.'img_noavailable.jpg';
	else
	  $img_thumb = $folder_complete.$ImgPaq;

	
	$str_destacado .= "<div class=\"paquete\">";
	$str_destacado .= "			<div align=\"center\" class=\"imagen\">";
	$str_destacado .= "<center>";
	$str_destacado .= tep_image(_URL.'resize.php?image='.$img_thumb.'&w=125&h=84&IsCrop=0',$Title,'','','');
	$str_destacado .= "</center>";
	$str_destacado .= "			</div>";
	$str_destacado .= "			<h3><a href=\"$link_paquete\">".$title_paquete."</a></h3>";
	$str_destacado .= "			<a class=\"button\" href=\"$link_paquete\"><span>Ver M&aacute;s</span></a>";	
	$str_destacado .= "</div>";
	

  $j++; 	 
 }

   return   $str_destacado;                     
   }                    	
 }

/*-------------------*/

function DestacadosPaqueteIquitos(){
	global $languages_id,$language_dir;
	$languages = new language();
	if($languages->IsExistLanguage($languages_id)) {
		 $SQL = "SELECT [|PREFIX|]paquete.txt_precio, [|PREFIX|]paquete_details.fk_paquete, [|PREFIX|]paquete.int_ishome, [|PREFIX|]paquete_details.txt_detalle, [|PREFIX|]paquete_details.txt_title, [|PREFIX|]paquete_details.txt_incluye, [|PREFIX|]paquete.fk_categoria, txt_precio_soles FROM [|PREFIX|]paquete ";
		 $SQL .= "Inner Join [|PREFIX|]paquete_details ON [|PREFIX|]paquete.pk_paquete = [|PREFIX|]paquete_details.fk_paquete WHERE [|PREFIX|]paquete.fk_categoria = '66'";
		 $SQL .= " AND [|PREFIX|]paquete_details.language_id = '".$languages_id."' AND int_status='1' ORDER BY [|PREFIX|]paquete.pk_paquete DESC;";
		 
		 $Query = 	$GLOBALS['CONNECT_DB']->Query($SQL);
		 $Count = $GLOBALS['CONNECT_DB']->CountResult($Query);

		 $str_destacado = "";
		 $ArrayDetails = "";

		 if($Count>0) { 
			$ncol = 3 ;#Cantidad de Columnas
			$ncounter = 1;
			while($Fetch = $GLOBALS['CONNECT_DB']->Fetch($Query)){
				$title_paquete = tep_output_string($Fetch['txt_title']);
				if(_SEOMOD==1){
						$link_paquete = _URL."paquetes-".clean_url($title_paquete)."-pid-".$Fetch['fk_paquete']."."._FEXT;
					}else{
						$link_paquete = _URL.'paquete_detalle.php?pid='.$Fetch['fk_paquete'];
				}		

				$ArrayDetails = $this->get_paquete_detail($Fetch['fk_paquete']);
				$folder_complete = _URL.DIR_WS_LANGUAGES.$language_dir.'/'._PAQUETES;
				$ImgPaq = $ArrayDetails[0]['image'];	

				$img_thumb = base64_encode($folder_complete.$ImgPaq);
				$ruta = $folder_complete.$ImgPaq;

				$str_destacado .= "<li class=\"item col-xs-3\">";
				$str_destacado .= "<div class=\"grid_wrap\">";
				$str_destacado .= "	<a href=\"$link_paquete\" title=\"$title_paquete\" class=\"product-image\">";
				#$str_destacado .=			tep_image(_URL.'resize.php?image='.$img_thumb.'&w=270&h=270&IsCrop=0',$title_paquete,'','','');
				$str_destacado .= "<img	src=\"$ruta\">";
				$str_destacado .= "	</a>";
				$str_destacado .= "	<div class=\"product-shop\">";
				$str_destacado .= "		<h3 class=\"product-name\">";
				$str_destacado .= "			<a href=\"$link_paquete\" title=\"$title_paquete\">".$title_paquete."</a>";
				$str_destacado .= "		</h3>";
				$str_destacado .= "		<div class=\"desc_grid\">".$Fetch['txt_incluye']."</div>";
				$str_destacado .= "		<div class=\"price-box\">";
				$str_destacado .= "			<span class=\"regular-price\" id=\"product-price-6-new\">";
				$str_destacado .= "				<span class=\"price\">S/. ".round(str_replace(',', '', $Fetch['txt_precio_soles']))."</span>"; 
				$str_destacado .= "			</span>";
				$str_destacado .= "		</div>";
				$str_destacado .= "		<div class=\"actions\">";
				$str_destacado .= "			<button type=\"button\" title=\"$title_paquete\" class=\"button btn-cart\">";
				$str_destacado .= "				<span><span><a style=\"color: #fff;\" href=\"$link_paquete\">Detalles</a></span></span>";
				$str_destacado .= "			</button>";
				$str_destacado .= "		</div>";
				$str_destacado .= "	</div>";
				$str_destacado .= "	<div class=\"label-product\"></div>";
			    $str_destacado .= "</div>";
				$str_destacado .= "</li>";



				 $ncounter++; 
			}#cierro while
			return   $str_destacado;
		 }#cierro if
	}#cierro languages
}#cierro funcion

function DestacadosPaquetePortada($from = 0,$to = 0){
global $languages_id,$language_dir;

$languages = new language();
	
if($languages->IsExistLanguage($languages_id)) {
	
 $SQL = "SELECT [|PREFIX|]paquete.txt_precio, [|PREFIX|]paquete_details.fk_paquete, [|PREFIX|]paquete.int_ishome, [|PREFIX|]paquete_details.txt_detalle, [|PREFIX|]paquete_details.txt_title, [|PREFIX|]paquete_details.txt_incluye, [|PREFIX|]paquete.fk_categoria, txt_precio_soles, int_dias, int_noches FROM [|PREFIX|]paquete ";
 $SQL .= "Inner Join [|PREFIX|]paquete_details ON [|PREFIX|]paquete.pk_paquete = [|PREFIX|]paquete_details.fk_paquete WHERE [|PREFIX|]paquete.int_isdestacado = '1' ";
 $SQL .= "AND [|PREFIX|]paquete_details.language_id = '".$languages_id."' AND int_status='1' ORDER BY [|PREFIX|]paquete.pk_paquete DESC LIMIT ".$from.",".$to." ";
 
 $Query = 	$GLOBALS['CONNECT_DB']->Query($SQL);
 $Count = $GLOBALS['CONNECT_DB']->CountResult($Query);
 
 $str_destacado = "";

 $ArrayDetails = "";
 
 if($Count>0) { 
   $ncol = 3 ;#Cantidad de Columnas
   $ncounter = 1;
 while($Fetch = $GLOBALS['CONNECT_DB']->Fetch($Query)){
	
	$title_paquete = tep_output_string($Fetch['txt_title']);
	if(_SEOMOD==1){
			$link_paquete = _URL."paquetes-".clean_url($title_paquete)."-pid-".$Fetch['fk_paquete']."."._FEXT;
		}else{
			$link_paquete = _URL.'paquete_detalle.php?pid='.$Fetch['fk_paquete'];
	}
	 
	if($ncounter==1 || $ncounter>3){$str_destacado .= "<li class=\"item\">";$ncounter = 1;}
	 
		$ArrayDetails = $this->get_paquete_detail($Fetch['fk_paquete']);
		$folder_complete = DIR_WS_LANGUAGES.$language_dir.'/'._PAQUETES;
		$ImgPaq = $ArrayDetails[0]['image'];	
	     
	if($ImgPaq=='' || !file_exists($folder_complete.$ImgPaq))
	  $img_thumb = $folder_complete.'img_noavailable.jpg';
	else
	  $img_thumb = base64_encode($folder_complete.$ImgPaq);
	
	$str_destacado .= "<div class=\"product-box spacer\" style=\"height: 300px;\">";

	$str_destacado .= "	<div class=\"fleft\">";
	$str_destacado .= "		<div class=\"description\" style=\"padding: 5px;\">";
	$str_destacado .= "			<p>".$title_paquete."</p>";
	$str_destacado .= "		</div>";
	$str_destacado .= "	</div>";

	$str_destacado .= "	<div class=\"browseImage\">";
	$str_destacado .= "		<div class=\"sale\"></div>";
	$str_destacado .= "		<a href=\"$link_paquete\">";
	$str_destacado .= tep_image(_URL.'resize.php?image='.$img_thumb.'&w=210&h=220&IsCrop=0',$title_paquete,'','','class="browseProductImage featuredProductImage"');	
	$str_destacado .= "	    </a>";
	$str_destacado .= "	</div>";

	$str_destacado .= "	<div style=\"background-color: #eeeeee; padding-top:5px; margin-top:-15px !important;\">";
	$str_destacado .= "		<div class=\"Price\">";
	$str_destacado .= "		<span class=\"sales\" style=\"margin-top:1px !important; padding-top: 5px;\">";
	$str_destacado .= "    Desde $ <span style=\"font-size:18px; font-weight:bold\">";
	$str_destacado .= 				round(str_replace(',', '', $Fetch['txt_precio']))."</span>";
	$str_destacado .= 			" &oacute; S/. <span style=\"font-size:18px; font-weight:bold\">".round(str_replace(',', '', $Fetch['txt_precio_soles'])). "</span>";
	$str_destacado .= "		</span>";
	$str_destacado .= "		<span class=\"frecuencia\">";
	$str_destacado .= 				$Fetch['int_dias']." Dias / ".$Fetch['int_noches']." Noches" ;
	$str_destacado .= "		</span>";		
	$str_destacado .= " </div>";
	
	$str_destacado .= "		<div class=\"wrapper\">";
	$str_destacado .= "			<div style=\"margin-left:25px;\" class=\"addtocart-area2\">";	
	$str_destacado .= "				<span class=\"addtocart-button\">";
	$str_destacado .= "					 <button class=\"btn-hover color-11\">";
	$str_destacado .= "						<a style=\"color:inherit\" href=\"$link_paquete\">VER OFERTA</a>";
	$str_destacado .= " 				</button>";
	$str_destacado .= "				</span>";									
	$str_destacado .= "				<div class=\"clear\"></div>";
	$str_destacado .= "			</div>";
	$str_destacado .= "		</div>";

	$str_destacado .= "	</div>";
	$str_destacado .= "</div>";
	
	if($ncounter==$ncol) $str_destacado .= "</li>";
  $ncounter++; 	 
 }

   return   $str_destacado;     
   	} #cierro count                
   } #cierro languages            	
 } #cierro funcion



function HomePaquete(){
global $languages_id,$language_dir;

$languages = new language();
	
if($languages->IsExistLanguage($languages_id)) {
	
 $SQL = "SELECT [|PREFIX|]paquete.txt_precio, [|PREFIX|]paquete_details.fk_paquete, [|PREFIX|]paquete.int_ishome, [|PREFIX|]paquete_details.txt_detalle, [|PREFIX|]paquete_details.txt_title, [|PREFIX|]paquete_details.txt_incluye FROM [|PREFIX|]paquete ";
 $SQL .= "Inner Join [|PREFIX|]paquete_details ON [|PREFIX|]paquete.pk_paquete = [|PREFIX|]paquete_details.fk_paquete WHERE [|PREFIX|]paquete.int_ishome = '1' ";
 $SQL .= "AND [|PREFIX|]paquete_details.language_id = '".$languages_id."' AND int_status='1' ORDER BY [|PREFIX|]paquete.txt_datepaquete DESC";
 
 $Query = 	$GLOBALS['CONNECT_DB']->Query($SQL);
 
 $str_home = "";
 
 $j=1;
 $ArrayDetails = "";
 while($Fetch = $GLOBALS['CONNECT_DB']->Fetch($Query)){
  	$ArrayDetails = $this->get_paquete_detail($Fetch['fk_paquete']);

	$folder_complete = DIR_WS_LANGUAGES.$language_dir.'/'._PAQUETES;
	
	$ImgPaq = $ArrayDetails[0]['image'];
	
	$title_paquete = tep_output_string($Fetch['txt_title']);
	$title_paquete = utf8_decode($title_paquete);
	
	if(_SEOMOD==1){
			$link_paquete = _URL."paquete/oferta-".safename($title_paquete)."-pid-".$Fetch['fk_paquete']."."._FEXT;
		}else{
			$link_paquete = _URL.'paquete_detalle.php?pid='.$Fetch['fk_paquete'];
	}
	     
	if($ImgPaq=='' || !file_exists($folder_complete.$ImgPaq))
	  $img_thumb = $folder_complete.'img_noavailable.jpg';
	else
	  $img_thumb = $folder_complete.$ImgPaq;

	
	$str_home .= "<li>";
	$str_home .= "	 <div class=\"jcarousel-item\">";
	$str_home .= "		<div align=\"center\" class=\"paquete\">";
	$str_home .= "		<a class=\"thumb\" href=\"$link_paquete\">";
	$str_home .= 			tep_image(_URL.'resize.php?image='.$img_thumb.'&w=85&h=75',$Title,'','','');
	$str_home .= "  	</a>";
	$str_home .= "		</div>";
	$str_home .= "			<div class=\"descripcion\">";
	$str_home .= "				<h3>$title_paquete</h3>";
	$str_home .= "				<p>";
	$str_home .= 			$Fetch['txt_precio'];
	$str_home .= "				</p>";
	$str_home .= "			</div>";
	$str_home .= "	 </div>";
	$str_home .= " </li>";
	
			
  $j++; 	 
 }

   return    $str_home;                     
   }                    	
 }
 

function paquetes_relacionados_animado($categoria,$from=0,$to){
	 global $languages_id,$language_dir;

  	 $languages = new language();
  
	 $SQL = "SELECT tbl_paquete.txt_precio, tbl_paquete_details.fk_paquete, tbl_paquete.int_ishome, tbl_paquete_details.txt_detalle, tbl_paquete_details.txt_title, tbl_paquete_details.txt_incluye, tbl_paquete.int_dias, tbl_paquete.int_noches FROM tbl_paquete ";
	 $SQL .= "Inner Join tbl_paquete_details ON tbl_paquete.pk_paquete = tbl_paquete_details.fk_paquete WHERE ";
	 $SQL .= " tbl_paquete_details.language_id = '2' AND int_status='1' AND tbl_paquete.fk_categoria = '".$categoria."' ORDER BY RAND() LIMIT ".$from.",".$to." ";

	 
	 $Query = $GLOBALS['CONNECT_DB']->Query($SQL)or die(mysql_error());
	 $count = $GLOBALS['CONNECT_DB']->CountResult($Query);

	  $strgal_paquete = "";

	 if($count >= 1) {
		$class = "";
	
		while($Fetch = $GLOBALS['CONNECT_DB']->Fetch($Query)) {
			$ArrayDetails = $this->get_paquete_detail($Fetch['fk_paquete']);
			$folder_complete = DIR_WS_LANGUAGES.$language_dir.'/'._PAQUETES;
			
			$noches = $Fetch['int_noches'];
			$dias = $Fetch['int_dias'];
			
			$ImgPaq = $ArrayDetails[0]['image'];
			$Boleto = $ArrayDetails[0]['boleto'];
			$Traslate = $ArrayDetails[0]['traslate'];
			$Presentacion = removeEvilTags(stripslashes_deep(fewchars($ArrayDetails[0]['presentacion'],270)));
			
			$title_paquete = tep_output_string($Fetch['txt_title']);
			$title_paquete = $title_paquete;	
			
			if(_SEOMOD==1){
			$link_paquete = _URL."paquetes-".clean_url($title_paquete)."-pid-".$Fetch['fk_paquete']."."._FEXT;
				}else{
			$link_paquete = _URL.'paquete_detalle.php?pid='.$Fetch['pk_paquete'];
			}   
			
			if($ImgPaq=='' || !file_exists($folder_complete.$ImgPaq))
			  $img_thumb = $folder_complete.'img_noavailable.jpg';
			else
			  $img_thumb = base64_encode($folder_complete.$ImgPaq);
		  
			$strgal_paquete .= "<div class=\"product_box margin_r_10\">";
			$strgal_paquete .= "	<a href=\"$link_paquete\">";
			$strgal_paquete .= 		tep_image(_URL.'resize.php?image='.$img_thumb.'&w=210&h=158&IsCrop=0',$title_paquete,'','','');
			$strgal_paquete .= "	</a>";
			$strgal_paquete .= "	<h3>Desde: US$ ".$Fetch['txt_precio']." - ".$dias." Dias</h3>";
			$strgal_paquete .= "	<p>".$title_paquete."</p>";
			$strgal_paquete .= "</div>";
		  
		} #cierro while
	  } #cierro count
 	return $strgal_paquete ;

 
}#cierro funcion



function lista_categorias_ul($categoria)
{
	 $Query_cruceros = "SELECT pk_categoria, fk_categoria, int_tipo, txt_nombre, txt_descripcion, txt_meta, txt_imagen, int_estado, int_orden, txt_dateadd,  txt_linkexterno, fk_languages FROM tbl_categoria WHERE tbl_categoria.fk_categoria='$categoria' and int_estado = '1' ORDER BY tbl_categoria.txt_nombre ASC";
	 
	 $SQL = $GLOBALS['CONNECT_DB']->Query($Query_cruceros);
	 $count = $GLOBALS['CONNECT_DB']->CountResult($SQL);
	 if($count>0){
	 	$string = "";
		$i=0;
	 		while($Fetch = $GLOBALS['CONNECT_DB']->Fetch($SQL)){
				 $title_categoria = secure_sql($Fetch['txt_nombre']);
				 $categoria = $Fetch['fk_categoria'];
				if(_SEOMOD==1){
					$SafeName = safename($title_categoria);
					$link_categoria = _URL.'paquetes-turisticos-'.$SafeName.'-desde-lima-pid-'.$Fetch['pk_categoria'].'.'._FEXT;
				}else{
					$link_categoria = _URL.'categorias.php?pid='.$Fetch['pk_categoria'];
				}
				 					
				 $string .= "<li><a title=\"$title_categoria\" href=\"$link_categoria\" target=\"_self\">".ucfirst(fewchars($title_categoria,60))."</a></li>";	
				 $i++;
			} #while
			return $string;
	 } #if
}

function lista_categorias_ul_tours($categoria)
{
	 $Query_cruceros = "SELECT pk_categoria, fk_categoria, int_tipo, txt_nombre, txt_descripcion, txt_meta, txt_imagen, int_estado, int_orden, txt_dateadd,  txt_linkexterno, fk_languages FROM tbl_categoria WHERE tbl_categoria.fk_categoria='$categoria' and int_estado = '1' ORDER BY tbl_categoria.txt_nombre ASC";
	 
	 $SQL = $GLOBALS['CONNECT_DB']->Query($Query_cruceros);
	 $count = $GLOBALS['CONNECT_DB']->CountResult($SQL);
	 if($count>0){
	 	$string = "";
		$i=0;
	 		while($Fetch = $GLOBALS['CONNECT_DB']->Fetch($SQL)){
				 $title_categoria = secure_sql($Fetch['txt_nombre']);
				 $categoria = $Fetch['fk_categoria'];
				if(_SEOMOD==1){
					$SafeName = safename($title_categoria);
					$link_categoria = _URL.'tours-en-'.$SafeName.'-pid-'.$Fetch['pk_categoria'].'.'._FEXT;
				}else{
					$link_categoria = _URL.'categorias.php?pid='.$Fetch['pk_categoria'];
				}
				 					
				 $string .= "<li><a title=\"$title_categoria\" href=\"$link_categoria\" target=\"_self\">".ucfirst(fewchars($title_categoria,60))."</a></li>";	
				 $i++;
			} #while
			return $string;
	 } #if
}


 function ListPaquetesLeft(){
  global $languages_id,$language_dir;

  $languages = new language();
		
  if($languages->IsExistLanguage($languages_id)) {
	$SQL = "SELECT pk_paquete FROM [|PREFIX|]paquete WHERE int_status='1' AND int_type='1'";
	$Query = $GLOBALS['CONNECT_DB']->Query($SQL);
	 $str_left_paq .= "<div class=\"LeftMoraPaq\">";
	   $str_left_paq .= "<div class=\"LeftPaqTitleDetails\">PAQUETES PER&Uacute;, TRAVEL VACATIONS</div>";
	   $str_left_paq .= "<ul>";
	 while($Fetch = $GLOBALS['CONNECT_DB']->Fetch($Query)){
		$link_paquete= "";
		$title_paquete = "";
		
		$cls_lang_paq = $this->get_paquete_detail($Fetch['pk_paquete']);
		
		$title_paquete = tep_output_string($cls_lang_paq[0]['title']);
		$title_paquete = utf8_decode($title_paquete);
		$link_paquete = _URL.'paquete_details.php?pid='.$Fetch['pk_paquete'];
	
		$str_left_paq .= "<li>";
		  $str_left_paq .= "<a href=\"$link_paquete\" target=\"_self\" title=\"$title_paquete\">".$title_paquete."</a>";
		$str_left_paq .= "</li>";
	 }#[While]
	   $str_left_paq .= "</ul>";
	 $str_left_paq .= "</div>";
  }#[If]
 return $str_left_paq;  
}

} // fin de la clase

?>