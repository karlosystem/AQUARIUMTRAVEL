<?php

class cls_tbl_pasajes{

var $pk_pasaje; 
var $txt_imagen;
var $txt_cobertura;
var $txt_metatitle;
var $txt_metadescription;
var $txt_fechapasaje;
var $int_estado;
var $txt_dateadd;

var $int_fondo;
var $txt_colorfondo;

var $inst_txt_destino = "get_titlepasaje";
var $inst_txt_detalle = "get_detallepasaje";
var $inst_txt_precio = "get_preciopasaje";
var $inst_txt_incluye = "get_incluyepasaje";

function cls_tbl_pasajes($id=0)
{

	if($id!=0)
	{
		$sql = $GLOBALS['CONNECT_DB']->Query("SELECT * FROM [|PREFIX|]pasajes WHERE pk_pasaje = '".$id."' ORDER BY txt_datepasaje ASC");
		$fila = $GLOBALS['CONNECT_DB']->Fetch($sql);
		$this->setpk_pasaje($fila['pk_pasaje']);
		$this->settxt_imagen($fila['txt_imagen']);
		$this->settxt_metatitle($fila['txt_metatitle']);
		$this->settxt_metadescription($fila['txt_metadescription']);
		$this->settxt_cobertura($fila['txt_cobertura']);
		$this->setdate_pasaje($fila['txt_datepasaje']);
		$this->settxt_status($fila['int_estado']);
		$this->setdate_fecregistro($fila['txt_dateadd']);
		$this->setint_optfondo($fila['int_fondo']);
		$this->settxt_optcolor($fila['txt_colorfondo']);
	}else{
		$this->setpk_pasaje('');
		$this->settxt_imagen('');
		$this->settxt_metatitle('');
		$this->settxt_metadescription('');
		$this->settxt_cobertura('');
		$this->setdate_pasaje('');
		$this->settxt_status('');
		$this->setdate_fecregistro('');
		$this->setint_optfondo('');
		$this->settxt_optcolor('');
	}
}


function setpk_pasaje($pk_pasaje){  $this->pk_pasaje = $pk_pasaje;}
function getpk_pasaje(){  return $this->pk_pasaje; }

function settxt_imagen($txt_imagen){  $this->txt_imagen = $txt_imagen;}
function gettxt_imagen(){  return $this->txt_imagen; }

function settxt_metatitle($txt_metatitle){  $this->txt_metatitle = $txt_metatitle;}
function gettxt_metatitle(){  return $this->txt_metatitle; }

function settxt_metadescription($txt_metadescription){  $this->txt_metadescription = $txt_metadescription;}
function gettxt_metadescription(){  return $this->txt_metadescription; }

function settxt_cobertura($txt_cobertura){  $this->txt_cobertura = $txt_cobertura;}
function gettxt_cobertura(){  return $this->txt_cobertura; }

function setint_optfondo($int_fondo){  $this->int_fondo = $int_fondo;}
function getint_optfondo(){  return $this->int_fondo; }

function settxt_optcolor($txt_colorfondo){  $this->txt_colorfondo = $txt_colorfondo;}
function gettxt_optcolor(){  return $this->txt_colorfondo; }

function setdate_pasaje($txt_fechapasaje){  $this->txt_fechapasaje = $txt_fechapasaje;}
function getdate_pasaje(){  return $this->txt_fechapasaje; }

function settxt_status($int_estado){  $this->int_estado = $int_estado;}
function gettxt_status(){  return $this->int_estado; }

function setdate_fecregistro($txt_dateadd){  $this->txt_dateadd = $txt_dateadd;}
function getdate_fecregistro(){  return $this->txt_dateadd; }


function _Delete()
{
	$ImgBig = $this->gettxt_imagen();
	deleteFiles(ADMIN_IMG_PASAJE,$ImgBig);
	
	$GLOBALS['CONNECT_DB']->Query("DELETE FROM [|PREFIX|]pasajes WHERE  pk_pasaje = '".$this->getpk_pasaje()."'");
	$GLOBALS['CONNECT_DB']->Query("DELETE FROM [|PREFIX|]pasajes_details WHERE  fk_pasaje = '".$this->getpk_pasaje()."'");
}

function _Save()
{
	
	$array_pasaje = array("txt_imagen"=>$this->gettxt_imagen(),
						   "txt_cobertura"=>$this->gettxt_cobertura(),
						   "txt_metatitle"=>$this->gettxt_metatitle(),
						   "txt_metadescription"=>$this->gettxt_metadescription(),
						   "txt_datepasaje"=>$this->getdate_pasaje(),
						   "int_estado"=>$this->gettxt_status(),
						   "txt_dateadd"=>$this->getdate_fecregistro(),
						   "int_fondo"=>$this->getint_optfondo(),
						   "txt_colorfondo"=>$this->gettxt_optcolor()
						   );
	insert($array_pasaje,"[|PREFIX|]pasajes");
	$id = $GLOBALS['CONNECT_DB']->LastId();
    $this->setpk_pasaje($id);

}

function _Update()
{	
	$array_modify = array("txt_imagen"=>$this->gettxt_imagen(),
					      "txt_metatitle"=>$this->gettxt_metatitle(),
						  "txt_metadescription"=>$this->gettxt_metadescription(),
						  "txt_datepasaje"=>$this->getdate_pasaje(),
						  "txt_cobertura"=>$this->gettxt_cobertura(),
						  "int_estado"=>$this->gettxt_status(),
						  "txt_dateadd"=>$this->getdate_fecregistro(),
						  "int_fondo"=>$this->getint_optfondo(),
						  "txt_colorfondo"=>$this->gettxt_optcolor()
						  );
   $array_where = array("pk_pasaje"=>$this->getpk_pasaje());
   update($array_modify,"[|PREFIX|]pasajes",$array_where);
}


function SU_Pasaje($IsMode='Create'){
		  $languages = language::tep_get_languages();
		   for ($i=0, $n=sizeof($languages); $i<$n; $i++) {
			 $pasaje_id = $this->getpk_pasaje();
			 $language_id = $languages[$i]['id'];
			 $destino_pasaje = secure_sql($_POST[$this->inst_txt_destino][$language_id]);
			 $detalle_pasaje = secure_sql($_POST[$this->inst_txt_detalle][$language_id]);
			 $precio_pasaje = secure_sql($_POST[$this->inst_txt_precio][$language_id]);
			 $incluye_pasaje = secure_sql($_POST[$this->inst_txt_incluye][$language_id]);
		     
			 $sql_data_array = array('fk_pasaje' => $pasaje_id,
				                     'language_id' => $language_id ,
				                     'txt_destino' => $destino_pasaje,
									 'txt_detalle' => $detalle_pasaje,
									 'txt_precio' => $precio_pasaje,
									 'txt_incluye' => $incluye_pasaje
		                             );
			if($IsMode=='Update'){
				$arr_where = array("fk_pasaje"=>$this->getpk_pasaje(),
								   "language_id"=>$language_id
								   );
				
				$Query_exists = $GLOBALS['CONNECT_DB']->Query("SELECT * FROM [|PREFIX|]pasajes_details WHERE fk_pasaje ='".$pasaje_id."' AND language_id='".(int)$language_id."'");
				
				if($GLOBALS['CONNECT_DB']->CountResult($Query_exists)==1)
				 update($sql_data_array,"[|PREFIX|]pasajes_details",$arr_where);
				else
				insert($sql_data_array,"[|PREFIX|]pasajes_details");
				
				}else if($IsMode='Create'){
					insert($sql_data_array,"[|PREFIX|]pasajes_details");
				}
			
		   }

}


function estado($estado)
{	$est=$estado;
	if($estado=="")
	{	$estado=($this->gettxt_status()=="1")?"0":"1";}

	$sql = "UPDATE [|PREFIX|]pasajes
				SET int_estado='".$estado."'
			WHERE pk_pasaje = '".$this->getpk_pasaje()."'";
	$GLOBALS['CONNECT_DB']->Query($sql);
	if($est=="")
	{
		$icono = "ico_estado".$estado.".gif";
		echo "<a href='javascript:ajax_estado(".$this->getpk_pasaje().")'>
 			  <img src='"._URL."admin/images/icons/".$icono."' border='0'></a>";
	}
}


function IsExistPasaje($IsActive=false){
$arr_and = "";
if($IsActive==true)	
$arr_and = "AND int_estado='1' ";

$SQL = "SELECT * FROM [|PREFIX|]pasajes WHERE pk_pasaje='".$this->getpk_pasaje()."' $arr_and";
$QueryExist = $GLOBALS['CONNECT_DB']->Query($SQL);
$Count = $GLOBALS['CONNECT_DB']->CountResult($QueryExist);
if($Count==0)
return false ;
else
return true ;
}

function URLPasaje($idpasaje=0){
 
 $InfLang = $this->get_pasajes_detalles($idpasaje);
 
 $SQL = "SELECT pk_pasaje FROM [|PREFIX|]pasajes WHERE int_estado =  '1' AND pk_pasaje='".$idpasaje."' ORDER BY txt_destino ASC";
 
 $Query = $GLOBALS['CONNECT_DB']->Query($SQL);
 $Count = $GLOBALS['CONNECT_DB']->CountResult($Query);

 $URL = "";
 if($Count >= 1) {
  $Fetch = 	$GLOBALS['CONNECT_DB']->Fetch($Query);
  if(_SEOMOD==1) {
   $destino_pasaje = $InfLang[0]['destino'];
     $URL = _URL.'read_pasaje.php?cid='.$Fetch['pk_pasaje'];
  }else{
   $URL = _URL.'read_pasaje.php?cid='.$Fetch['pk_pasaje'];
   }
 }
 return $URL;
 
}


function get_pasajes_detalles($pasaje_id, $language_id = 0) {
    global $languages_id;

    if ($language_id == 0) $language_id = $languages_id;
    $page_query = "SELECT txt_destino, txt_precio, txt_incluye, txt_detalle FROM [|PREFIX|]pasajes_details WHERE";
	$page_query .= " fk_pasaje = '" . (int)$pasaje_id . "' and language_id = '" . (int)$language_id . "'" ;
	
	$Query = $GLOBALS['CONNECT_DB']->Query($page_query);
	
	while ($FetchPasaje = $GLOBALS['CONNECT_DB']->Fetch($Query)){
    $getpasaje[] = array('destino'=>$FetchPasaje['txt_destino'],
						 'detalle'=>$FetchPasaje['txt_detalle'],
	                     'precio'=>$FetchPasaje['txt_precio'],
						 'incluye'=>$FetchPasaje['txt_incluye']
	                   );
	}					    
    return $getpasaje;
}



function listpasajes_public($from = 0, $to = 20, $page = 1){
$SQL = "SELECT 	pk_pasaje, txt_imagen, int_estado, txt_dateadd, txt_datepasaje, txt_dateupdate, int_fondo, txt_colorfondo FROM [|PREFIX|]pasajes WHERE int_estado =  '1' ORDER BY txt_datepasaje DESC LIMIT ".$from.", ".$to ;

 $Query = $GLOBALS['CONNECT_DB']->Query($SQL);
 $count = $GLOBALS['CONNECT_DB']->CountResult($Query);
  
 if($count >= 1) {
 $strboleto = "";
 
 while($Fetch = $GLOBALS['CONNECT_DB']->Fetch($Query)) {
 $LangPasaje = $this->get_pasajes_detalles($Fetch['pk_pasaje']);
 
 $ThisUrl = $this->URLPasaje($Fetch['pk_pasaje']);
 
 $destino = utf8_decode($LangPasaje[0]['destino']);
 $Image = $Fetch['txt_imagen']; 
 
 $precio = utf8_decode($LangPasaje[0]['precio']);
 $incluye = utf8_decode($LangPasaje[0]['incluye']);
 
     $strboleto .= "<!-- port-box START here -->";
	  $strboleto .= "<div class=\"col one_fourth fp_rw\">";
	     
		 if(tep_not_null($Image) && file_exists(PUBLIC_IMG_PASAJE.$Image)){
		   $InfoImg = getimagesize(PUBLIC_IMG_PASAJE.$Image);
		   $WidthImg = $InfoImg[0];#Ancho de la imagen
		   $PathImage = "";
		    if($WidthImg>290){$PathImage=_URL.'resize.php?image='.PUBLIC_IMG_PASAJE.$Image.'&w=150&h=120';}else{$PathImage=_URL.PUBLIC_IMG_PASAJE.$Image;}
		   $strboleto .= "<a href=\"contactenos.php\" class=\"img-load\">";
		    $strboleto .= tep_image($PathImage,$title_secure);
		   $strboleto .= "</a>";
		 }
		 
		  $strboleto .= "<p>$destino</p>";
          $strboleto .= "<p>$incluye</p>";		  
		  $strboleto .= "<p><a href=\"contactenos.php\">";
		  $strboleto .= $precio;
		  $strboleto .= "</a></p>";
		 
		  
		 $strboleto .= "</div>";

 
  } # While
  
 }

 return $strboleto ;
}
  

function portada_pasajes($destino){
	global $languages_id,$language_dir;
	
	$languages = new language();	
	if($languages->IsExistLanguage($languages_id)) {		
	
	$SQL = "SELECT pk_pasaje, txt_imagen, txt_datepasaje, int_fondo, txt_colorfondo, [|PREFIX|]pasajes_details.fk_pasaje, [|PREFIX|]pasajes_details.txt_destino, [|PREFIX|]pasajes_details.txt_precio, [|PREFIX|]pasajes_details.txt_incluye, txt_cobertura FROM [|PREFIX|]pasajes INNER JOIN [|PREFIX|]pasajes_details ON [|PREFIX|]pasajes.pk_pasaje = [|PREFIX|]pasajes_details.fk_pasaje WHERE int_estado =  '1' AND txt_cobertura = '$destino' ORDER BY txt_datepasaje DESC";
	$Query = 	$GLOBALS['CONNECT_DB']->Query($SQL);
	$str_pasajes = "";
		$j=1;
		 $ArrayDetails = "";
		 	$bgclass_title = "";
			while($Fetch = $GLOBALS['CONNECT_DB']->Fetch($Query))
			{
				
				   
				 $ArrayDetails = $this->get_pasajes_detalles($Fetch['fk_paquete']);  
				 $folder_complete = _URL.PUBLIC_IMG_PASAJE;
				 
				 $ImgPas = $Fetch['txt_imagen'];
				 $title_destino = tep_output_string($Fetch['txt_destino']);
				 $title_destino = utf8_decode($title_destino);
				 
				 $title_precio =  tep_output_string($Fetch['txt_precio']);
				 $title_incluye = tep_output_string($Fetch['txt_incluye']); 
				  
				 if(_SEOMOD==1){
						$link_pasaje = _URL."pasaje/oferta-".safename($title_destino)."-pid-".$Fetch['fk_pasaje']."."._FEXT;
				 }else{
						$link_pasaje = _URL.'pasaje_detalle.php?pid='.$Fetch['fk_pasaje'];
				 }
				 
				 if($ImgPas=='')
				  $img_thumb = $folder_complete.'img_noavailable.jpg';
				else
				  $img_thumb = $folder_complete.$ImgPas;

				   
				$str_pasajes .= "<tr>   "; 
				$str_pasajes .= "	<td><a href=\"$link_pasaje\">".$title_destino."</a></td>";
				$str_pasajes .= "	<td>US$ ".(int)$title_precio."</td>";
				$str_pasajes .= "</tr>   ";     
			 $j++;
			}
				
	}
	
	return $str_pasajes;
}


function lista($sql="")
{
	if(!tep_not_null($sql)){
	$sql = $GLOBALS['CONNECT_DB']->Query("SELECT * FROM [|PREFIX|]pasajes ORDER BY txt_datepasaje DESC");
	}else{
	$sql = $GLOBALS['CONNECT_DB']->Query($sql);
	}
	
	$i=0;
	while($Fetch = $GLOBALS['CONNECT_DB']->Fetch($sql))
	{
		$arreglo[$i]['pk_pasaje'] = $Fetch['pk_pasaje'];
		$arreglo[$i]['txt_imagen'] = $Fetch['txt_imagen'];
		$arreglo[$i]['txt_cobertura'] = $Fetch['txt_cobertura'];
		$arreglo[$i]['txt_datepasaje'] = $Fetch['txt_datepasaje'];
		$arreglo[$i]['int_estado'] = $Fetch['int_estado'];
		$arreglo[$i]['txt_dateadd'] = $Fetch['txt_dateadd'];
		$arreglo[$i]['int_fondo'] = $Fetch['int_fondo'];
		$arreglo[$i]['txt_colorfondo'] = $Fetch['txt_colorfondo'];
	 $i++;
	}
	
	return $arreglo;
}

}