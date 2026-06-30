<?php
class cls_tbl_sorteo{

var $pk_sorteo ;
var $txt_titulo;
var $txt_ganador;
var $txt_empresa;
var $txt_cargo;
var $txt_content ;
var $txt_imgthumb ;
var $int_order ;
var $int_status ;
var $txt_dateadd ;
var $txt_fecha;
var $replace = "y" ; #Reemplaza el archivo 

function cls_tbl_sorteo($id=0)
{

	if($id!=0)
	{
		$sql = $GLOBALS['CONNECT_DB']->Query("SELECT * FROM tbl_sorteo WHERE pk_sorteo = '".$id."' ORDER BY int_order ASC");
		$fila = $GLOBALS['CONNECT_DB']->Fetch($sql);
		$this->setpk_sorteo($fila['pk_sorteo']);
		$this->settxt_titulo($fila['txt_titulo']);
		$this->settxt_ganador($fila['txt_ganador']);
		$this->settxt_empresa($fila['txt_empresa']);
		$this->settxt_cargo($fila['txt_cargo']);
		$this->settxt_content($fila['txt_content']);
		$this->settxt_imgthumb($fila['txt_imgthumb']);
		$this->setint_order($fila['int_order']);
		$this->settxt_status($fila['int_estado']);
		$this->setdate_dateadd($fila['txt_dateadd']);
		$this->setdate_fecha($fila['txt_fecha']);
	}else{
		$this->setpk_sorteo('');
		$this->settxt_titulo('');
		$this->settxt_ganador('');
		$this->settxt_empresa('');
		$this->settxt_cargo('');
		$this->settxt_content('');
		$this->settxt_imgthumb('');
		$this->setint_order('');
		$this->settxt_status('');
		$this->setdate_dateadd('');
		$this->setdate_fecha($fila['txt_fecha']);
	}

}

function setpk_sorteo($pk_sorteo){  $this->pk_sorteo = $pk_sorteo;}
function getpk_sorteo(){  return $this->pk_sorteo; }

function settxt_titulo($txt_titulo){  $this->txt_titulo = $txt_titulo;}
function gettxt_titulo(){  return $this->txt_titulo; }

function settxt_ganador($txt_ganador){  $this->txt_ganador = $txt_ganador;}
function gettxt_ganador(){  return $this->txt_ganador; }

function settxt_empresa($txt_empresa){  $this->txt_empresa = $txt_empresa;}
function gettxt_empresa(){  return $this->txt_empresa; }

function settxt_cargo($txt_cargo){  $this->txt_cargo = $txt_cargo;}
function gettxt_cargo(){  return $this->txt_cargo; }

function settxt_content($txt_content){  $this->txt_content = $txt_content;}
function gettxt_content(){  return $this->txt_content; }

function settxt_imgthumb($txt_imgthumb){  $this->txt_imgthumb = $txt_imgthumb;}
function gettxt_imgthumb(){  return $this->txt_imgthumb; }

function setint_order($int_order){  $this->int_order = $int_order;}
function getint_order(){  return $this->int_order; }

function settxt_status($int_status){  $this->int_status = $int_status;}
function gettxt_status(){  return $this->int_status; }

function setdate_dateadd($txt_dateadd){  $this->txt_dateadd = $txt_dateadd;}
function getdate_dateadd(){  return $this->txt_dateadd; }

function setdate_fecha($txt_fecha){  $this->txt_fecha = $txt_fecha;}
function getdate_fecha(){  return $this->txt_fecha; }



function elimina()
{
	$sql = "DELETE FROM tbl_sorteo WHERE pk_sorteo = '".$this->getpk_sorteo()."'";
	$GLOBALS['CONNECT_DB']->Query($sql);
}

function guarda()
{
	
	$array_notice = array("txt_titulo"=>$this->gettxt_titulo(),
						  "txt_ganador"=>$this->gettxt_ganador(),
						  "txt_empresa"=>$this->gettxt_empresa(),
						  "txt_cargo"=>$this->gettxt_cargo(),
	                      "txt_content"=>$this->gettxt_content(),
						  "txt_imgthumb"=>$this->gettxt_imgthumb(),
						  "int_order"=>$this->getint_order(),
						  "int_estado"=>$this->gettxt_status(),
						  "txt_dateadd"=>$this->getdate_dateadd(),
						  "txt_fecha"=>$this->getdate_fecha()
						  );
	insert($array_notice,"tbl_sorteo") or die(mysql_error());
	$id = $GLOBALS['CONNECT_DB']->LastId();
    $this->setpk_sorteo($id);
}


function actualiza()
{	
	$array_modify = array("txt_titulo"=>$this->gettxt_titulo(),
						  "txt_ganador"=>$this->gettxt_ganador(),
						  "txt_empresa"=>$this->gettxt_empresa(),
						  "txt_cargo"=>$this->gettxt_cargo(),
	                      "txt_content"=>$this->gettxt_content(),
						  "txt_imgthumb"=>$this->gettxt_imgthumb(),
						  "int_order"=>$this->getint_order(),
						  "int_estado"=>$this->gettxt_status(),
						  "txt_dateadd"=>$this->getdate_dateadd(),
						  "txt_fecha"=>$this->getdate_fecha()
						  );
   $array_where = array("pk_sorteo"=>$this->getpk_sorteo());
   
   update($array_modify,"tbl_sorteo",$array_where);

}


function estado($estado)
{	$est=$estado;
	if($estado=="")
	{	$estado=($this->gettxt_status()=="1")?"0":"1";}

	$sql = "UPDATE tbl_sorteo
				SET int_estado='".$estado."'
			WHERE pk_sorteo = '".$this->getpk_sorteo()."'";
	$GLOBALS['CONNECT_DB']->Query($sql);
	if($est=="")
	{
		$icono = "ico_estado".$estado.".gif";
		echo "<a href='javascript:ajax_estado(".$this->getpk_sorteo().")'>
 			  <img src='"._URL."admin/images/icons/".$icono."' border='0'></a>";
	}
}


function lista($sql="")
{
	if(!tep_not_null($sql)){
	$sql = $GLOBALS['CONNECT_DB']->Query("SELECT * FROM tbl_sorteo ORDER BY int_order DESC");
	}else{
	$sql = $GLOBALS['CONNECT_DB']->Query($sql);
	}
	
	$i=0;
	while($Fetch = $GLOBALS['CONNECT_DB']->Fetch($sql))
	{
		$arreglo[$i]['pk_sorteo'] = $Fetch['pk_sorteo'];
		$arreglo[$i]['txt_titulo'] = $Fetch['txt_titulo'];
		$arreglo[$i]['txt_ganador'] = $Fetch['txt_ganador'];
		$arreglo[$i]['txt_empresa'] = $Fetch['txt_empresa'];
		$arreglo[$i]['txt_cargo'] = $Fetch['txt_cargo'];
		$arreglo[$i]['txt_content'] = $Fetch['txt_content'];
		$arreglo[$i]['txt_imgthumb'] = $Fetch['txt_imgthumb'];
		$arreglo[$i]['int_order'] = $Fetch['int_order'];
		$arreglo[$i]['int_estado'] = $Fetch['int_estado'];
		$arreglo[$i]['txt_dateadd'] = $Fetch['txt_dateadd'];
		$arreglo[$i]['txt_fecha'] = $Fetch['txt_fecha'];
	 $i++;
	}
	
	return $arreglo;
}


function IsExistSorteo($IsActive=false){
$arr_and = "";
if($IsActive==true)	
$arr_and = "AND int_estado='1' ";

$SQL = "SELECT * FROM [|PREFIX|]sorteo WHERE pk_sorteo='".$this->getpk_sorteo()."' $arr_and";
$QueryExist = $GLOBALS['CONNECT_DB']->Query($SQL);
$Count = $GLOBALS['CONNECT_DB']->CountResult($QueryExist);
if($Count==0)
return false ;
else
return true ;
}


function ShowListSorteo($from = 0, $to = 20, $page = 1) {
 $SQL = "SELECT tbl_sorteo.pk_sorteo, tbl_sorteo.txt_titulo, tbl_sorteo.txt_ganador, tbl_sorteo.txt_empresa, tbl_sorteo.txt_cargo, tbl_sorteo.txt_content, tbl_sorteo.txt_imgthumb, tbl_sorteo.txt_dateadd FROM tbl_sorteo WHERE tbl_sorteo.int_estado =  '1'
ORDER BY tbl_sorteo.txt_dateadd DESC LIMIT ".$from.", ".$to." ";
 
 $Query = $GLOBALS['CONNECT_DB']->Query($SQL);
 $count = $GLOBALS['CONNECT_DB']->CountResult($Query);
 
 $str_sorteo = "";
 
 if($count >= 1) {
    
	$str_sorteo .= "<div class=\"PaquetesListSorteo\">";
    
	while($Fetch = $GLOBALS['CONNECT_DB']->Fetch($Query)) {
     $str_sorteo .= "<!--  Sorteo ({$Fetch['txt_titulo']})  -->";

				if(_SEOMOD==1){
				$link_mod = safename($Fetch['txt_titulo']);
				$link_mod = _URL."sorteo/read-".$link_mod."_".$Fetch['pk_sorteo']."."._FEXT;
				}else{
				$link_mod = _URL."sorteo_read.php?cid=".$Fetch['pk_sorteo'];
				}
				$Title = utf8_decode($Fetch['txt_titulo']);
				$Description = removeEvilTags($Fetch['txt_content']);

				 $str_sorteo .= "<div class=\"MainSorteos\">";
	 			 $url_thumb = PUBLIC_IMG_SORTEO.$Fetch['txt_imgthumb'];	

			#Inicio del Left Col
			 $str_sorteo .= "<div class=\"LeftCol\">";
               $str_sorteo .= "<div class=\"Title\">";
			    $str_sorteo .= $Title;
			   $str_sorteo .= "</div>";#Title
			   
			   $str_sorteo .= "<div class=\"Img\">";
			    $str_sorteo .= tep_image(_URL.'resize.php?image='.$url_thumb.'&w=138&h=90&IsCrop=0',$Title,'','','class="border_img"');

			   $str_sorteo .= "</div>";
			 
			 $str_sorteo .= "</div>";#LeftCol
			
			  #Inicio del RightCol
			  $str_sorteo .= "<div class=\"RightCol\">";
				
				  $str_sorteo .= "<div class=\"MainPrice\">";
				  $str_sorteo .= "<div class=\"AllTitle\">";
				  $str_sorteo .= TITLE_GANADOR; # Viaje desde
				  $str_sorteo .= "</div>";
				  $str_sorteo .= "<div class=\"Price\">";
				  $str_sorteo .= $Fetch['txt_ganador'];
				  $str_sorteo .= "</div>";				  
				  $str_sorteo .= "</div>";#Main Price
				  
					
				  $str_sorteo .= "<div class=\"AllTitle\">";
				  $str_sorteo .= TITLE_EMPRESA;
				  $str_sorteo .= "</div>";
				  $str_sorteo .= "<div class=\"Traslado\">";
				  $str_sorteo .= $Fetch['txt_empresa'];
				  $str_sorteo .= "</div>";

				  $str_sorteo .= "<div class=\"LineBottom\"></div>";

				  $str_sorteo .= "<div class=\"AllTitle\">";
			      $str_sorteo .= TITLE_PROMRIGHT;
			      $str_sorteo .= "</div>";

				  $str_sorteo .= "<div class=\"Info\">";
				  $str_sorteo .= $Description;
				  $str_sorteo .= "</div>";
				


			  $str_sorteo .= "</div>";

			$str_sorteo .= "</div>";	
	 } # While
	$str_sorteo .= "</div>";
   } # $count > 0	
 return 	$str_sorteo ;
}


}

?>