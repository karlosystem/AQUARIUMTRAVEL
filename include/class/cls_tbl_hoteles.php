<?php

class cls_tbl_hoteles{

var $pk_hoteles; 
var $fk_departamento; 
var $fk_cadena; 
var $txt_link;
var $txt_direccion;
var $txt_imagen;

var $txt_precio_nino;
var $txt_precio_simple;
var $txt_precio_doble;
var $txt_precio_triple;

var $txt_fechahoteles;
var $int_estado;
var $int_estrellas;
var $int_destacado;
var $txt_fecharegistro;

var $inst_txttitle = "get_titlehoteles";
var $inst_txt_content = "get_contenthoteles";
var $inst_txtservicios = "get_servicioshoteles";
var $inst_txthabitacion = "get_habitacionhoteles";

var $txt_photoportada;

function cls_tbl_hoteles($id=0)
{

	if($id!=0)
	{
		$sql = $GLOBALS['CONNECT_DB']->Query("SELECT * FROM [|PREFIX|]hoteles WHERE pk_hoteles = '".$id."' ORDER BY pk_hoteles DESC");
		$fila = $GLOBALS['CONNECT_DB']->Fetch($sql);
		$this->setpk_hoteles($fila['pk_hoteles']);
		$this->setfk_departamento($fila['fk_departamento']);
		$this->setfk_cadena($fila['fk_cadena']);
		$this->settxt_imagen($fila['txt_image']);
		$this->settxt_link($fila['txt_link']);
		$this->settxt_direccion($fila['txt_direccion']);
		
		$this->settxt_precio_simple($fila['txt_precio_simple']);
		$this->settxt_precio_doble($fila['txt_precio_doble']);
		$this->settxt_precio_triple($fila['txt_precio_triple']);
		$this->settxt_precio_nino($fila['txt_precio_nino']);
		
		$this->settxt_fecha($fila['txt_datehoteles']);
		$this->settxt_estado($fila['int_status']);
		$this->settxt_destacado($fila['int_destacado']);
		$this->settxt_estrellas($fila['int_estrellas']);
		$this->setdate_fecregistro($fila['txt_dateadd']);
		$this->settxt_photoportada($fila['mm_photoportada']);
	}else{
		$this->setpk_hoteles('');
		$this->setfk_departamento('');
		$this->settxt_direccion('');
		$this->setfk_cadena('');
		$this->settxt_imagen('');
		$this->settxt_link('');
		$this->settxt_precio_simple('');
		$this->settxt_precio_doble('');
		$this->settxt_precio_triple('');
		$this->settxt_precio_nino('');
		
		$this->settxt_fecha('');
		$this->settxt_estado('');
		$this->settxt_destacado('');
		$this->settxt_estrellas('');
		$this->setdate_fecregistro('');
		$this->settxt_photoportada('');
	}

}


function setpk_hoteles($pk_hoteles){  $this->pk_hoteles = $pk_hoteles;}
function getpk_hoteles(){  return $this->pk_hoteles; }

function setfk_departamento($fk_departamento){  $this->fk_departamento = $fk_departamento;}
function getfk_departamento(){  return $this->fk_departamento; }

function setfk_cadena($fk_cadena){  $this->fk_cadena = $fk_cadena;}
function getfk_cadena(){  return $this->fk_cadena; }

function settxt_imagen($txt_imagen){  $this->txt_imagen = $txt_imagen;}
function gettxt_imagen(){  return $this->txt_imagen; }

function settxt_link($txt_link){  $this->txt_link = $txt_link;}
function gettxt_link(){  return $this->txt_link; }

function settxt_direccion($txt_direccion){  $this->txt_direccion = $txt_direccion;}
function gettxt_direccion(){  return $this->txt_direccion; }

function settxt_precio_simple($txt_precio_simple){  $this->txt_precio_simple = $txt_precio_simple;}
function gettxt_precio_simple(){  return $this->txt_precio_simple; }

function settxt_precio_doble($txt_precio_doble){  $this->txt_precio_doble = $txt_precio_doble;}
function gettxt_precio_doble(){  return $this->txt_precio_doble; }

function settxt_precio_triple($txt_precio_triple){  $this->txt_precio_triple = $txt_precio_triple;}
function gettxt_precio_triple(){  return $this->txt_precio_triple; }

function settxt_precio_nino($txt_precio_nino){  $this->txt_precio_nino = $txt_precio_nino;}
function gettxt_precio_nino(){  return $this->txt_precio_nino; }

function settxt_fecha($txt_fechahoteles){  $this->txt_fechahoteles = $txt_fechahoteles;}
function gettxt_fecha(){  return $this->txt_fechahoteles; }

function settxt_estado($int_estado){  $this->int_estado = $int_estado;}
function gettxt_estado(){  return $this->int_estado; }

function settxt_destacado($int_destacado){  $this->int_destacado = $int_destacado;}
function gettxt_destacado(){  return $this->int_destacado; }

function settxt_estrellas($int_estrellas){  $this->int_estrellas = $int_estrellas;}
function gettxt_estrellas(){  return $this->int_estrellas; }

function setdate_fecregistro($txt_fecharegistro){  $this->txt_fecharegistro = $txt_fecharegistro;}
function getdate_fecregistro(){  return $this->txt_fecharegistro; }

function settxt_photoportada($txt_photoportada){  $this->txt_photoportada = $txt_photoportada;}
function gettxt_photoportada(){  return $this->txt_photoportada; }


function _Delete()
{
	$ImgBig = $this->gettxt_imagen();
	deleteFiles(ADMIN_PHOTOBIG_HOTELES,$ImgBig);
	
	$GLOBALS['CONNECT_DB']->Query("DELETE FROM [|PREFIX|]hoteles WHERE  pk_hoteles = '".$this->getpk_hoteles()."'");
	$GLOBALS['CONNECT_DB']->Query("DELETE FROM [|PREFIX|]hoteles_details WHERE  fk_hoteles = '".$this->getpk_hoteles()."'");

}

function _Save()
{
	$array_hoteles = array("txt_image"=>$this->gettxt_imagen(),
						   "fk_departamento"=>$this->getfk_departamento(),
						   "fk_cadena"=>$this->getfk_cadena(),
						   "txt_datehoteles"=>$this->gettxt_fecha(),
						   "txt_link"=>$this->gettxt_link(),
						   "txt_direccion"=>$this->gettxt_direccion(),
						   "int_status"=>$this->gettxt_estado(),
						   "int_destacado"=>$this->gettxt_destacado(),
						   "int_estrellas"=>$this->gettxt_estrellas(),
						   "txt_dateadd"=>$this->getdate_fecregistro(),
						   "txt_precio_simple"=>$this->gettxt_precio_simple(),
						   "txt_precio_doble"=>$this->gettxt_precio_doble(),
						   "txt_precio_triple"=>$this->gettxt_precio_triple(),
						   "txt_precio_nino"=>$this->gettxt_precio_nino(),
						   "mm_photoportada"=>$this->gettxt_photoportada()
						   );
	insert($array_hoteles,"[|PREFIX|]hoteles");
	$id = $GLOBALS['CONNECT_DB']->LastId();
    $this->setpk_hoteles($id);

}


function graba_galeria($file_upload){
  $code_new = "";
  if(tep_not_null($_FILES[$file_upload])){
     
	 while(list($key,$value) = each($_FILES[$file_upload]['name']))
	 {
	   
	   if(!empty($value)){
	      $filename = $value;
		  $filename = str_replace(" ","_",$filename); # remuevo los caracteres especiales a tipo html : prueba_archivo_subido
		  $new_name_big = 'big_'.strtotime("now").$filename;
		  $uploaded_modelbig = ADMIN_PHOTOBIG_HOTELESGALLERY.$new_name_big;

		  $new_name_pw = 'pw_'.strtotime("now").$filename;
		  $uploaded_modelpreview = ADMIN_PHOTOMIN_HOTELESPREVIEW.$new_name_pw;
		  
		  # Proceso de subir archivo grande.
		  if(move_uploaded_file($_FILES[$file_upload]['tmp_name'][$key],$uploaded_modelbig)) {
		  
		  #Proceso a redimensionar la imagen de la modelo
		  require_once("../include/class/thumbnail.inc.php");
		  #Vista Grande
		  
		  $resize_image = new Thumbnail($uploaded_modelbig);
	      $resize_image->resize(WHOTELMES_BIG,HHOTELMES_BIG);
	      $resize_image->save($uploaded_modelbig); 
		  
		  #Vista previa
		  $resize_image = new Thumbnail($uploaded_modelbig);
	      $resize_image->resize(WHOTELMES_PREVIEW,HHOTELMES_PREVIEW);
	      $resize_image->save($uploaded_modelpreview); 

		 $array_content = array("fk_hoteles"=>$this->getpk_hoteles(),
							    "mm_filenamebig"=>$new_name_big,
							    "mm_filenamemin"=>$new_name_pw
						   );
	     insert($array_content,"[|PREFIX|]hoteles_gallery");
		  
		  }
	   }
	 }
  }
 
}

function _Update()
{	
	$array_modify = array("txt_image"=>$this->gettxt_imagen(),
						  "fk_departamento"=>$this->getfk_departamento(),
						  "fk_cadena"=>$this->getfk_cadena(),
						  "txt_datehoteles"=>$this->gettxt_fecha(),
						  "txt_link"=>$this->gettxt_link(),
						  "txt_direccion"=>$this->gettxt_direccion(),
						  "int_status"=>$this->gettxt_estado(),
						  "int_estrellas"=>$this->gettxt_estrellas(),
						  "int_destacado"=>$this->gettxt_destacado(),
						  "txt_dateadd"=>$this->getdate_fecregistro(),
						  "txt_precio_simple"=>$this->gettxt_precio_simple(),
						  "txt_precio_doble"=>$this->gettxt_precio_doble(),
						  "txt_precio_triple"=>$this->gettxt_precio_triple(),
						  "txt_precio_nino"=>$this->gettxt_precio_nino(),
						  "mm_photoportada"=>$this->gettxt_photoportada()
						  );
   $array_where = array("pk_hoteles"=>$this->getpk_hoteles());
   
   update($array_modify,"[|PREFIX|]hoteles",$array_where);

}

function SU_Hoteles($IsMode='Create'){
		  $languages = language::tep_get_languages();
		   for ($i=0, $n=sizeof($languages); $i<$n; $i++) {
			 $hoteles_id = $this->getpk_hoteles();
			 $language_id = $languages[$i]['id'];
			 $name_page = secure_sql($_POST[$this->inst_txttitle][$language_id]);
			 $description_hoteles = secure_sql($_POST[$this->inst_txt_content][$language_id]);
			 $servicios_hotel = secure_sql($_POST[$this->inst_txtservicios][$language_id]);
			 $habitacion_hotel = secure_sql($_POST[$this->inst_txthabitacion][$language_id]);
		     
			 $sql_data_array = array('fk_hoteles' => $hoteles_id,
				                     'language_id' => $language_id ,
				                     'txt_title' => $name_page,
									 'txt_content' => $description_hoteles,
									 'txt_servicios' => $servicios_hotel,
									 'txt_habitacion' => $habitacion_hotel
		                             );
			if($IsMode=='Update'){
				$arr_where = array("fk_hoteles"=>$this->getpk_hoteles(),
								   "language_id"=>$language_id
								   );
				
				$Query_exists = $GLOBALS['CONNECT_DB']->Query("SELECT * FROM [|PREFIX|]hoteles_details WHERE fk_hoteles ='".$hoteles_id."' AND language_id='".(int)$language_id."'");
				
				if($GLOBALS['CONNECT_DB']->CountResult($Query_exists)==1)
				 update($sql_data_array,"[|PREFIX|]hoteles_details",$arr_where);
				else
				insert($sql_data_array,"[|PREFIX|]hoteles_details");
				
		    }else if($IsMode='Create'){
			    insert($sql_data_array,"[|PREFIX|]hoteles_details");
			}
			
		   }

}


function estado($estado)
{	$est=$estado;
	if($estado=="")
	{	$estado=($this->gettxt_estado()=="1")?"0":"1";}

	$sql = "UPDATE [|PREFIX|]hoteles
				SET int_status='".$estado."'
			WHERE pk_hoteles = '".$this->getpk_hoteles()."'";
	$GLOBALS['CONNECT_DB']->Query($sql);
	if($est=="")
	{
		$icono = "ico_estado".$estado.".gif";
		echo "<a href='javascript:UpdateStatus(".$this->getpk_hoteles().")'>
 			  <img src='"._URL."admin/images/icons/".$icono."' border='0'></a>";
	}
}


function counthoteles_list($QueryParam=''){
if(!tep_not_null($QueryParam)){
$SQL = "SELECT * FROM [|PREFIX|]hoteles Inner Join [|PREFIX|]hoteles_gallery ON [|PREFIX|]hoteles.pk_hoteles = [|PREFIX|]hoteles_gallery.fk_hoteles
WHERE [|PREFIX|]hoteles_gallery.fk_hoteles =  '".$this->getpk_hoteles()."' ORDER BY [|PREFIX|]hoteles_gallery.pk_mmimage ASC ";
}else{
$SQL = $QueryParam;
}
 
 $Query = $GLOBALS['CONNECT_DB']->Query($SQL);
 $count = $GLOBALS['CONNECT_DB']->CountResult($Query);
 return $count ;
}


function listphotohoteles_gallery($TypeOption='radiobutton'){

 $SQL = $GLOBALS['CONNECT_DB']->query("SELECT tbl_hoteles_gallery.mm_filenamemin, tbl_hoteles_gallery.pk_mmimage FROM
tbl_hoteles Inner Join tbl_hoteles_gallery ON tbl_hoteles.pk_hoteles = tbl_hoteles_gallery.fk_hoteles WHERE tbl_hoteles.pk_hoteles =  '".$this->getpk_hoteles()."' ORDER BY tbl_hoteles_gallery.pk_mmimage ASC");
 
 $count = $GLOBALS['CONNECT_DB']->CountResult($SQL);
   if($count>0){
      $str_photo = "";
      $fileimage = "";
	  while($Fetch = $GLOBALS['CONNECT_DB']->Fetch($SQL)) {
	      
	      $fileimage = base64_encode(ADMIN_PHOTOMIN_HOTELESPREVIEW.$Fetch['mm_filenamemin']);
	      $str_photo .= "<div id=\"photo_list\">
				          <div id=\"image_model\"><img src='th_photo_hotelesfrm.php?image=$fileimage' ></div>
				          <div id=\"input_listmodel\">";
			
			if($TypeOption=='radiobutton'){			  
			$str_photo .= "<input name=\"chk_photohoteles[]\" id=\"chk_photohoteles[]\" type=\"checkbox\" value=\"{$Fetch['pk_mmimage']}\" />";
			}else{
			$rb_checked = ($this->gettxt_photoportada()==$Fetch['mm_filenamemin'])?'checked':'';
			
			$str_photo .= "<input name=\"opt_photoportada\" id=\"opt_photoportada\" type=\"radio\" value=\"{$Fetch['mm_filenamemin']}\" $rb_checked />";
			}
			
			$str_photo .= "</div>";
						  
		  $str_photo .= "</div>";
	  }
	  return $str_photo;
   }
 
} #fin de la funcion


function lista($sql="")
{
	if(!tep_not_null($sql)){
	$sql = $GLOBALS['CONNECT_DB']->Query("SELECT pk_hoteles, fk_departamento, fk_cadena, int_estrellas, tbl_hoteles.int_status, tbl_hoteles.txt_image, tbl_hoteles.txt_datehoteles, tbl_hoteles.txt_dateadd, tbl_hoteles.txt_dateupdate,  mm_photoportada, tbl_departamento.txt_descripcion as departamento,
tbl_hoteles.txt_precio_simple, tbl_hoteles.txt_precio_doble,tbl_hoteles.txt_precio_triple, 
tbl_hoteles.txt_precio_nino, tbl_cadena.txt_nombre as cadena, txt_link, txt_direccion FROM tbl_hoteles 
LEFT JOIN tbl_departamento ON tbl_hoteles.fk_departamento = tbl_departamento.pk_departamento 
LEFT JOIN tbl_cadena       ON tbl_hoteles.fk_cadena = tbl_cadena.pk_cadena
ORDER BY txt_datehoteles DESC");
	}else{
	$sql = $GLOBALS['CONNECT_DB']->Query($sql);
	}
	
	$i=0;
	while($Fetch = $GLOBALS['CONNECT_DB']->Fetch($sql))
	{
		$arreglo[$i]['pk_hoteles'] = $Fetch['pk_hoteles'];
		$arreglo[$i]['departamento'] = $Fetch['departamento'];
		$arreglo[$i]['cadena'] = $Fetch['cadena'];
		$arreglo[$i]['txt_image'] = $Fetch['txt_image'];
		$arreglo[$i]['txt_link'] = $Fetch['txt_link'];
		$arreglo[$i]['txt_direccion'] = $Fetch['txt_direccion'];
		$arreglo[$i]['txt_precio_simple'] = $Fetch['txt_precio_simple'];
		$arreglo[$i]['txt_precio_doble'] = $Fetch['txt_precio_doble'];
		$arreglo[$i]['txt_precio_triple'] = $Fetch['txt_precio_triple'];
		$arreglo[$i]['txt_precio_nino'] = $Fetch['txt_precio_nino'];
		$arreglo[$i]['txt_datehoteles'] = $Fetch['txt_datehoteles'];
		$arreglo[$i]['int_status'] = $Fetch['int_status'];
		$arreglo[$i]['int_destacado'] = $Fetch['int_destacado'];
		$arreglo[$i]['int_estrellas'] = $Fetch['int_estrellas'];
		$arreglo[$i]['txt_dateadd'] = $Fetch['txt_dateadd'];
	 $i++;
	}
	
	return $arreglo;
}

function URLHoteles($idhoteles=0){
 
 $InfLang = $this->get_hoteles_detail($idhoteles);
 
 $SQL = "SELECT pk_hoteles FROM [|PREFIX|]hoteles WHERE int_status =  '1' AND pk_hoteles='".$idhoteles."'";
 
 $Query = $GLOBALS['CONNECT_DB']->Query($SQL);
 $Count = $GLOBALS['CONNECT_DB']->CountResult($Query);

 $URL = "";
 if($Count >= 1) {
  $Fetch = 	$GLOBALS['CONNECT_DB']->Fetch($Query);
  if(_SEOMOD==1) {
   $title_hoteles = $InfLang[0]['hoteles_txt_title'];
     //$URL = _URL.'noticia/read-'.safename($title_notice).'-cid-'.$Fetch['pk_hoteles'].'.'._FEXT;
     $URL = _URL.'read_destino.php?cid='.$Fetch['pk_hoteles'];
  }else{
   $URL = _URL.'read_destino.php?cid='.$Fetch['pk_hoteles'];
   }
 }
 return $URL;
 
}

function IsExistHoteles($IsActive=false){
$arr_and = "";
if($IsActive==true)	
$arr_and = "AND int_status='1' ";

$SQL = "SELECT * FROM [|PREFIX|]hoteles WHERE pk_hoteles='".$this->getpk_hoteles()."' $arr_and";
$QueryExist = $GLOBALS['CONNECT_DB']->Query($SQL);
$Count = $GLOBALS['CONNECT_DB']->CountResult($QueryExist);
if($Count==0)
return false ;
else
return true ;
}



function get_infolang_hoteles($language_id = ''){

	$sql = "SELECT txt_title,txt_content FROM [|PREFIX|]hoteles_details ";
	$sql .= "WHERE fk_hoteles ='".$this->getpk_hoteles()."' AND language_id='".(int)$language_id."' ";
	
	$notice_query = $GLOBALS['CONNECT_DB']->Query($sql);
	
	while($FetchInfo = $GLOBALS['CONNECT_DB']->Fetch($notice_query)){

	$get_data_array[] = array('title' => $FetchInfo['txt_title'],
							  'details' => $FetchInfo['txt_content']
							   );
	}
    return  $get_data_array ;
}


function listado_hoteles_depa(){
	
	global $languages_id,$language_dir;
	$languages = new language();
	if($languages->IsExistLanguage($languages_id)) {
	
	$SQL_HOTELES = "SELECT pk_departamento,  txt_descripcion,  txt_imagen,  int_estado,  txt_creacion,  fecha_registro FROM [|PREFIX|]departamento WHERE int_estado = '1' AND pk_departamento IN (SELECT fk_departamento FROM [|PREFIX|]hoteles)";
	$Query_Hoteles = $GLOBALS['CONNECT_DB']->Query($SQL_HOTELES);
	
	
	$Count = $GLOBALS['CONNECT_DB']->CountResult($Query_Hoteles);
	$str_hoteles = "";
	
	if($Count>0){
		while($Fetch_Ubicacion = $GLOBALS['CONNECT_DB']->Fetch($Query_Hoteles)){
			$str_hoteles .= "<div id=\"subcategories\" class=\"clearfix\">";
			$str_hoteles .= "<h2>";
				$str_hoteles .= "Hoteles en: ".$Fetch_Ubicacion['txt_descripcion'];
			$str_hoteles .= "</h2>";
	
	
					$SQL = "SELECT pk_hoteles, fk_departamento, int_estrellas, int_status, txt_image, txt_datehoteles, txt_dateadd, txt_dateupdate, mm_photoportada,  [|PREFIX|]departamento.txt_descripcion as departamento, " ;
					$SQL .= " [|PREFIX|]hoteles_details.txt_title FROM [|PREFIX|]hoteles ";
					$SQL .= " INNER JOIN [|PREFIX|]hoteles_details ";
					$SQL .= " ON [|PREFIX|]hoteles.pk_hoteles = [|PREFIX|]hoteles_details.fk_hoteles ";
					$SQL .= " INNER JOIN [|PREFIX|]departamento";
					$SQL .= " ON [|PREFIX|]hoteles.fk_departamento = [|PREFIX|]departamento.pk_departamento ";
					$SQL .= " WHERE [|PREFIX|]departamento.pk_departamento = '".$Fetch_Ubicacion['pk_departamento']."' ";
					$SQL .= " ORDER BY [|PREFIX|]departamento.txt_descripcion ASC";
					
					$Query = $GLOBALS['CONNECT_DB']->Query($SQL);
					$string = "";
					$j=1;
					$ArrayDetails = "";	
					$str_hoteles .= "<ul>";
						  while($Fetch = $GLOBALS['CONNECT_DB']->Fetch($Query)){
							$ArrayDetails = $this->get_hoteles_detail($Fetch['pk_hoteles']);
							$Title = stripslashes_deep($ArrayDetails[0]['hoteles_txt_title']);
							if(_SEOMOD==1){
								$link_promociones = _URL."hoteles/peru-".safename($Title)."-pid-".$Fetch['pk_hoteles']."."._FEXT;
							}else{
								$link_promociones = _URL.'hoteles_detalle.php?pid='.$Fetch['pk_hoteles'];
							}
							
							$resize_img = base64_encode(PUBLIC_PHOTOBIG_HOTELES.$Fetch['txt_image']);
							
							$str_hoteles .= "<li>";
							$str_hoteles .= "<a class=\"bgcolor bordercolor\" href=\"$link_hoteles\" title=\"$Title\">";
							$str_hoteles .= tep_image(_URL.'resize.php?image='.$resize_img.'&w=170&h=160&IsCrop=0',$Title,'','','class="bordercolor"');
							$str_hoteles .= "<span>".$Title."</span>";
							$str_hoteles .= "<strong></strong>";
							$str_hoteles .= "</a>";
							$str_hoteles .= "</li>";
					
						} #cierro while	
					$str_hoteles .= "</ul>";
				
				 $str_hoteles .= "</div>"; 
				} #cierro while	de hoteles	
				
			} #cierro if count	
		
		
		
		return    $str_hoteles;
	}#cierro if
} #cierro la funcion


function listpaquetes_hoteles($selected="")
{     
		
	$SQL = "SELECT pk_hoteles, fk_departamento, int_estrellas, int_status, txt_image, txt_datehoteles, txt_dateadd, txt_dateupdate, mm_photoportada,  [|PREFIX|]departamento.txt_descripcion as departamento, " ;
	$SQL .= " [|PREFIX|]hoteles_details.txt_title FROM [|PREFIX|]hoteles ";
	$SQL .= " INNER JOIN [|PREFIX|]hoteles_details ";
	$SQL .= " ON [|PREFIX|]hoteles.pk_hoteles = [|PREFIX|]hoteles_details.fk_hoteles ";
	$SQL .= " INNER JOIN [|PREFIX|]departamento";
	$SQL .= " ON [|PREFIX|]hoteles.fk_departamento = [|PREFIX|]departamento.pk_departamento";
	$SQL .= " ORDER BY [|PREFIX|]departamento.txt_descripcion ASC, [|PREFIX|]hoteles_details.txt_title ASC";
	
	#echo $SQL;
	#exit();
	
	$Query = $GLOBALS['CONNECT_DB']->Query($SQL);
	$string = "";
	$j=1;
	$ArrayDetails = "";	
	
	while ($Fetch = $GLOBALS['CONNECT_DB']->Fetch($Query))
	{	
		$string.="<option value='{$Fetch['pk_hoteles']}'";
		
		if (tep_not_null($selected))
		{
			$selected_content = explode(",", $selected);
			
			if(in_array($Fetch['pk_hoteles'], $selected_content))
				$string.=" selected";
		}
		
		$string.=">" . "[ " .ucwords($Fetch['departamento'])." ] ".ucwords($Fetch['txt_title']). "";
		$string.="</option>";
		$j++;
	}
	
	return $string;
} #CIERRO FUNCION


function Paquetes_Hoteles($hoteles=""){
	global $languages_id,$language_dir;
	$languages = new language();
	if($languages->IsExistLanguage($languages_id)) {

	$SQL_HOTELES = "SELECT sum(fk_departamento) as depa, fk_departamento, [|PREFIX|]hoteles.int_status, [|PREFIX|]departamento.txt_descripcion as departamento ";
	$SQL_HOTELES .= "FROM [|PREFIX|]hoteles LEFT JOIN [|PREFIX|]departamento ON [|PREFIX|]hoteles.fk_departamento = [|PREFIX|]departamento.pk_departamento ";
	$SQL_HOTELES .= "WHERE [|PREFIX|]hoteles.pk_hoteles IN (".$hoteles.") AND [|PREFIX|]hoteles.int_status = '1' ";
	$SQL_HOTELES .= "GROUP BY fk_departamento";
	
	$Query_Hoteles = $GLOBALS['CONNECT_DB']->Query($SQL_HOTELES);
	
	$Count = $GLOBALS['CONNECT_DB']->CountResult($Query_Hoteles);
		if($Count>0){
			while($Fetch_Ubicacion = $GLOBALS['CONNECT_DB']->Fetch($Query_Hoteles)){
					  $str_hoteles .= "<div id=\"quantityDiscount\" class=\"bgcolor bordercolor\">";
	 				  		$str_hoteles .= "<h3>HOTELES DISPONIBLES EN : ".$Fetch_Ubicacion['departamento']." (click en 'ver m&aacute;s' para m&aacute;s detalles del Hotel)</h3>";
							  $str_hoteles .= "<table class=\"std\">";
							  $str_hoteles .= "<thead>";
							  $str_hoteles .= "	<tr>";
							  $str_hoteles .= "	<th>ALOJAMIENTO</th>";
							   $str_hoteles .= "<th>INFO</th>";
							  $str_hoteles .= "	<th>CATEGORIA</th>";
							  $str_hoteles .= "	<th>FOTOS</th>";
							  $str_hoteles .= "	</tr>";
							  $str_hoteles .= " </thead>";
							  $str_hoteles .= "<tbody>";
							  
							$SQL = "SELECT pk_hoteles, fk_departamento, int_estrellas, [|PREFIX|]hoteles.int_status, [|PREFIX|]hoteles.txt_image, [|PREFIX|]hoteles.txt_datehoteles, ";
	$SQL .= "[|PREFIX|]hoteles.txt_dateadd, [|PREFIX|]hoteles.txt_dateupdate,  mm_photoportada, [|PREFIX|]departamento.txt_descripcion as departamento, [|PREFIX|]hoteles.txt_precio_simple, [|PREFIX|]hoteles.txt_precio_doble, [|PREFIX|]hoteles.txt_precio_triple, [|PREFIX|]hoteles.txt_precio_nino FROM ";
	$SQL .= "[|PREFIX|]hoteles LEFT JOIN [|PREFIX|]departamento ON [|PREFIX|]hoteles.fk_departamento = [|PREFIX|]departamento.pk_departamento";
	$SQL .= " WHERE [|PREFIX|]hoteles.pk_hoteles IN (".$hoteles.") AND fk_departamento='".$Fetch_Ubicacion['fk_departamento']."'";
	$SQL .= " ORDER BY txt_datehoteles DESC";
	
							 $Query = 	$GLOBALS['CONNECT_DB']->Query($SQL);
							 $j=1;
							 $ArrayDetails = "";
							  while($Fetch = $GLOBALS['CONNECT_DB']->Fetch($Query)){
							 		$ArrayDetails = $this->get_hoteles_detail($Fetch['pk_hoteles']);
									
									$Title = stripslashes_deep(ucwords($ArrayDetails[0]['hoteles_txt_title']));
									
									if(_SEOMOD==1){
										$link_hoteles = _URL."hoteles/popup-".safename($Title)."-pid-".$Fetch['pk_hoteles']."."._FEXT;
									}else{
										$link_hoteles = _URL.'hoteles_popup.php?pid='.$Fetch['pk_hoteles'];
									}
									
									if(_SEOMOD==1){
										$link_galeria = _URL."hoteles/galeria-".safename($Title)."-pid-".$Fetch['pk_hoteles']."."._FEXT;
									}else{
										$link_galeria = _URL.'hoteles_galeria.php?pid='.$Fetch['pk_hoteles'];
									}
									
									$Foto = $Fetch['txt_image'];
									
									$str_hoteles .= "<tr id=\"quantityDiscount_0\">";
									
							 		$str_hoteles .= "	<td>";
									
									$str_hoteles .= "	<div class=\"thumbnail-item\">";
									$str_hoteles .= "		<a href=\"$link_hoteles\" rel=\"#overlay\">".$Title."</a>";
									$str_hoteles .= "		<div class=\"tooltip\">";
									  if(tep_not_null($Foto) && file_exists(PUBLIC_PHOTOBIG_HOTELES.$Foto)){
									  	 $img_thumb = base64_encode(PUBLIC_PHOTOBIG_HOTELES.$Foto);
									  	 $str_hoteles .= tep_image(_URL.'resize.php?image='.$img_thumb.'&w=330&h=185&IsCrop=0','','','','');
									  }								
									$str_hoteles .= "			<span class=\"overlay\"></span>";
									$str_hoteles .= "		</div> ";
									$str_hoteles .= "	</div> ";
									$str_hoteles .= " </td>";
									
									$str_hoteles .= " <td>";
									$str_hoteles .= "  <a href=\"$link_hoteles\" rel=\"#overlay\" style=\"text-decoration:none\"><img src=\""._URL."/images/ver-mas.png\" title=\"ver m&aacute;s\" /></a>";
									$str_hoteles .= " </td>";
									
									
									$str_hoteles .= "	<td>";
									  switch ((int)$Fetch['int_estrellas']){
										 case 1:$str_hoteles .= "<img src=\""._URL."/images/1star.png\" title=\"1 estrellas\" />";break;
										 case 2:$str_hoteles .= "<img src=\""._URL."/images/2star.png\" title=\"2 estrellas\"/>";break;
										 case 3:$str_hoteles .= "<img src=\""._URL."/images/3star.png\" title=\"3 estrellas\"/>";break;
										 case 4:$str_hoteles .= "<img src=\""._URL."/images/4star.png\" title=\"4 estrellas\"/>";break;
										 case 5:$str_hoteles .= "<img src=\""._URL."/images/5star.png\" title=\"5 estrellas\"/>";break;
										 default:$str_hoteles .= "&nbsp;";break;
									  }
			  
									  #$str_hoteles .= " <img src='"._URL."admin/images/icons/".$icono."' border='0'></a>";
									
									$str_hoteles .= 	"</td>";
									$str_hoteles .= "	<td>";
									$str_hoteles .= "  <a href=\"$link_galeria\" rel=\"#overlay\" style=\"text-decoration:none; font-size:12px; text-align:center; color: #69AD2C; font-weight: bold;\">";
									#$str_hoteles .= "<img src=\""._URL."/images/ver-mas.png\" title=\"ver m&aacute;s\" /></a>";	
									$str_hoteles .= "FOTOS";								
									$str_hoteles .= "</td>";
									/*$str_hoteles .= "	<td>".$Fetch['txt_precio_doble']."</td>";
									$str_hoteles .= "	<td>".$Fetch['txt_precio_triple']."</td>";
									$str_hoteles .= "	<td>".$Fetch['txt_precio_nino']."</td>";*/
									$str_hoteles .= "</tr>";
							  
							  } #cierro while
							  $str_hoteles .= "</tbody>";
						      $str_hoteles .= "</table>";
					  $str_hoteles .= "</div><br>";
					  
			} # CIERRO WHILE DEPARTAMENTOS
		} #cierro if departamentos
	
		 return    $str_hoteles;
	} #CIERRO LANGUAGE	
} #CIERRO FUNCION



function Listado_Hoteles(){
	global $languages_id,$language_dir;
	$languages = new language();
	if($languages->IsExistLanguage($languages_id)) {
		$SQL = "SELECT pk_hoteles, fk_departamento, int_estrellas, [|PREFIX|]hoteles.int_status, [|PREFIX|]hoteles.txt_image, [|PREFIX|]hoteles.txt_datehoteles, [|PREFIX|]hoteles.txt_dateadd, [|PREFIX|]hoteles.txt_dateupdate,  mm_photoportada, [|PREFIX|]departamento.txt_descripcion as departamento FROM [|PREFIX|]hoteles LEFT JOIN [|PREFIX|]departamento ON [|PREFIX|]hoteles.fk_departamento = [|PREFIX|]departamento.pk_departamento ORDER BY txt_datehoteles DESC LIMIT 0 , 10";
	
	$Query = $GLOBALS['CONNECT_DB']->Query($SQL);
	$str_hoteles = "";
	$j=1;
	$ArrayDetails = "";		
	
		while($Fetch = $GLOBALS['CONNECT_DB']->Fetch($Query)){
		$ArrayDetails = $this->get_hoteles_detail($Fetch['pk_hoteles']);
		 $Title = stripslashes_deep($ArrayDetails[0]['hoteles_txt_title']);
			if(_SEOMOD==1){
				$link_hoteles = _URL."reserva/viaje-".safename($Title)."-pid-".$Fetch['pk_hoteles']."."._FEXT;
			}else{
				$link_hoteles = _URL.'hoteles.php?pid='.$Fetch['pk_hoteles'];
			}
			
			$departamento = $Fetch['departamento'];
			
	
			$str_hoteles .= "	<div class=\"clear10\"></div>";				
			$str_hoteles .= "	 <div class=\"post-hoteles hoteles-trackbacks-list nopadding\">";
			$str_hoteles .= "		<div class=\"hoteles\">";
			$str_hoteles .= "			<div class=\"clear\"></div>";
			$str_hoteles .= "				<div class=\"hoteles\">";
			$str_hoteles .= "					<h2 class=\"heading h2\">";
			$str_hoteles .= 						$departamento;			
			$str_hoteles .= "					</h2>";
			$str_hoteles .= "					<div class=\"clear\"></div>";
			$str_hoteles .= "						<p>";
			$str_hoteles .= 					"<ul class=\"accordion-large\">";
			$str_hoteles .= 					"<li><a href=\"#\" class=\"gray-only bold_only notextdecoration\">".$Title."</a>";
			$str_hoteles .= "					<div>";
			$str_hoteles .= "					<p>";
			$str_hoteles .= "Nunc felis velit, pellentesque quis condimentum vitae, ullamcorper vitae tellus. Fusce semper porttitor accumsan. Integer sit amet augue ac dui commodo lobortis. Ut imperdiet, felis eu rhoncus suscipit, turpis velit malesuada purus, vel elementum nunc tortor eget lacus. Mauris vestibulum est ac arcu consectetur id lacinia metus venenatis. Mauris diam metus, fringilla sit amet ultricies quis, dapibus nec sem. Duis consectetur nisi in risus euismod auctor. Quisque a quam arcu. Proin tempus elit quis ante sagittis pretium. Vivamus nisl odio, pretium sit amet pretium eget, tristique quis turpis.";
			$str_hoteles .= "					</p>";
			$str_hoteles .= "					</div>";
			$str_hoteles .="					</li>";
			$str_hoteles .= 					"</ul>";
			$str_hoteles .= "						</p>";
			$str_hoteles .= "					<div class=\"clear\"></div>";
			$str_hoteles .= "	 				<a href=\"$link_contenido\" class=\"alignright_block button\">M&aacute;s Informaci&oacute;n</a>";
			$str_hoteles .= "					<div class=\"clear\"></div>";
			$str_hoteles .= "				</div>";
			$str_hoteles .= "		</div>";
			$str_hoteles .= "	 </div>";
			
 		$j++;
		} #cierro while
		 return   $str_hoteles; 
	} #cierro languages
} #cierro funcion



function ListaTop_Hoteles(){
	global $languages_id,$language_dir;
	$languages = new language();
	if($languages->IsExistLanguage($languages_id)) {
	$SQL = "SELECT pk_hoteles, fk_departamento, int_estrellas, [|PREFIX|]hoteles.int_status, [|PREFIX|]hoteles.txt_image, [|PREFIX|]hoteles.txt_datehoteles, [|PREFIX|]hoteles.txt_dateadd, [|PREFIX|]hoteles.txt_dateupdate,  mm_photoportada, [|PREFIX|]departamento.txt_descripcion as departamento FROM [|PREFIX|]hoteles LEFT JOIN [|PREFIX|]departamento ON [|PREFIX|]hoteles.fk_departamento = [|PREFIX|]departamento.pk_departamento ORDER BY txt_datehoteles DESC LIMIT 0 , 10";
	
	$Query = $GLOBALS['CONNECT_DB']->Query($SQL);
	$str_hoteles = "";
	$j=1;
	$ArrayDetails = "";
		while($Fetch = $GLOBALS['CONNECT_DB']->Fetch($Query)){
			$ArrayDetails = $this->get_hoteles_detail($Fetch['pk_hoteles']);
			 $Title = stripslashes_deep($ArrayDetails[0]['hoteles_txt_title']);
				if(_SEOMOD==1){
					$link_hoteles = _URL."hoteles/peru-".safename($Title)."-cid-".$Fetch['pk_hoteles']."."._FEXT;
				}else{
					$link_hoteles = _URL.'hoteles.php?cid='.$Fetch['pk_hoteles'];
				}
			
			 $str_hoteles .="	<li><a href=\"$link_hoteles\">";
			 $str_hoteles .= 	$Title;
			 $str_hoteles .="	</a></li>";
			 $j++;
		} #cierro while
		 return   $str_hoteles; 
	} #cierro languages
} #cierro funcion

function get_hoteles_detail($hoteles_id, $language_id = 0) {
    global $languages_id;

    if ($language_id == 0) $language_id = $languages_id;
    $page_query = "SELECT txt_title,txt_content,txt_servicios,txt_habitacion FROM [|PREFIX|]hoteles_details WHERE";
	$page_query .= " fk_hoteles = '" . (int)$hoteles_id . "' and language_id = '" . (int)$language_id . "'" ;
	
	$Query = $GLOBALS['CONNECT_DB']->Query($page_query);
	
	while ($FetchHoteles = $GLOBALS['CONNECT_DB']->Fetch($Query)){
    $gethoteles[] = array('hoteles_txt_title'=>$FetchHoteles['txt_title'],
	                      'hoteles_txt_content'=>$FetchHoteles['txt_content'],
						  'hoteles_txt_servicios'=>$FetchHoteles['txt_servicios'],
						  'hoteles_txt_habitacion'=>$FetchHoteles['txt_habitacion']
	                   );
	}					    
    return $gethoteles;
  }
  
function hoteles_relacionados_animado($departamento,$from=0,$to){
global $languages_id,$language_dir;
$languages = new language();

if($languages->IsExistLanguage($languages_id)) {
	 $SQL = "SELECT  pk_hoteles, fk_departamento, txt_precio_simple, txt_precio_doble, txt_precio_triple, txt_precio_nino, int_estrellas, int_status, txt_image,  txt_datehoteles, txt_dateadd, txt_dateupdate, mm_photoportada FROM tbl_hoteles ";
	 $SQL .= " WHERE ";
	 $SQL .= " int_status='1' AND tbl_hoteles.fk_departamento = '".$departamento."' ORDER BY tbl_hoteles.pk_hoteles DESC LIMIT ".$from.",".$to." ";
	 
	# echo $SQL;
	# exit();
	

	 $Query = $GLOBALS['CONNECT_DB']->Query($SQL)or die(mysql_error());
	 $count = $GLOBALS['CONNECT_DB']->CountResult($Query);

	  $strgal_paquete = "";

	 if($count >= 1) {
		$class = "";
	
		while($Fetch = $GLOBALS['CONNECT_DB']->Fetch($Query)) {
			$ArrayDetails = $this->get_hoteles_detail($Fetch['pk_hoteles']);
			$folder_complete = _URL.PUBLIC_PHOTOBIG_HOTELES;
			
			$txt_precio_simple = $Fetch['txt_precio_simple'];
			$txt_precio_doble = $Fetch['txt_precio_doble'];
			$txt_precio_triple = $Fetch['txt_precio_triple'];
			
			$title_paquete = $ArrayDetails[0]['hoteles_txt_title'];
			
			if(_SEOMOD==1){
				$link_paquete = _URL."hoteles/peru-".safename($title_paquete)."-pid-".$Fetch['pk_hoteles']."."._FEXT;
			}else{
				$link_paquete = _URL.'hoteles_detalle.php?pid='.$Fetch['pk_hoteles'];
			}	  
			   			  
			  $resize_img = base64_encode(PUBLIC_PHOTOBIG_HOTELES.$Fetch['txt_image']);
		   
		  $strgal_paquete .= " <li class=\"ajax_block_product bordercolor first_item product_accessories_description\">";
		  $strgal_paquete .= " <div class=\"accessories_desc\">";
		  $strgal_paquete .= "	<a href=\"#\" title=\"#\" class=\"accessory_image product_img_link bordercolor\">";
		  
		   
		  $strgal_paquete .= tep_image(_URL.'resize.php?image='.$resize_img.'&w=80&h=80&IsCrop=0',$title_paquete,'','','');
		  
		  $strgal_paquete .= "	</a>";
		  
		  $strgal_paquete .= "		<h5><a class=\"product_link\" href=\"$link_paquete\">".$title_paquete."</a></h5>";
		  
		  $img_hoteles = "";
		  switch ((int)$Fetch['int_estrellas']){
				 case 1:$img_hoteles .= "<img src=\""._URL."/images/1star.png\" title=\"1 estrellas\" />";break;
				 case 2:$img_hoteles .= "<img src=\""._URL."/images/2star.png\" title=\"2 estrellas\"/>";break;
				 case 3:$img_hoteles .= "<img src=\""._URL."/images/3star.png\" title=\"3 estrellas\"/>";break;
				 case 4:$img_hoteles .= "<img src=\""._URL."/images/4star.png\" title=\"4 estrellas\"/>";break;
				 case 5:$img_hoteles .= "<img src=\""._URL."/images/5star.png\" title=\"5 estrellas\"/>";break;
				 default:$img_hoteles .= "&nbsp;";break;
		}
			  
		  $strgal_paquete .= "		<a class=\"product_descr\" href=\"$link_paquete\" title=\"More\">".$img_hoteles."</a>";
		  $strgal_paquete .= "	</div>";
		  $strgal_paquete .= "		<div class=\"accessories_price bordercolor\">";
		  $strgal_paquete .= "		<span class=\"price\">DESDE: ".$txt_precio_simple."</span>"; 
		  $strgal_paquete .= "		<a class=\"exclusive button ajax_add_to_cart_button\" href=\"$link_paquete\" rel=\"ajax_id_product_2\" title=\"mas detalles\">DETALLES</a>";
		  $strgal_paquete .= "	</div>";
		  $strgal_paquete .= "</li>";
	
		} #cierro while
	  } #cierro count
 	return $strgal_paquete ;
 
  }#cierro if
 
}#cierro funcion


} // fin de la clase

?>