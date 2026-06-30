<?php
class cls_tbl_tours{
	var $pk_tours;
	var $txt_nombre;
	var $fk_destino;
	var $txt_descripcion;
	var $txt_imagen;
	var $txt_creacion ;
	var $int_status;
	var $txt_dateadd ;

function cls_tbl_tours($id=0)
{
	if($id!=0)
	{
		$sql = $GLOBALS['CONNECT_DB']->Query("SELECT * FROM [|PREFIX|]tours WHERE pk_tours = '".$id."' ORDER BY pk_tours ASC");
		$fila = $GLOBALS['CONNECT_DB']->Fetch($sql);
		$this->setpk_tours($fila['pk_tours']);
		$this->settxt_nombre($fila['txt_nombre']);
		$this->setfk_destino($fila['fk_destino']);
		$this->settxt_descripcion($fila['txt_descripcion']);
		$this->settxt_imagen($fila['txt_imagen']);
		$this->settxt_status($fila['int_estado']);
		$this->settxt_creacion($fila['txt_creacion']);
	}else{
		$this->setpk_tours('');
		$this->settxt_nombre('');
		$this->setfk_destino('');
		$this->settxt_descripcion('');
		$this->settxt_imagen('');
		$this->settxt_status('');
		$this->settxt_creacion('');
	}
}


function setpk_tours($pk_tours){  $this->pk_tours = $pk_tours;}
function getpk_tours(){  return $this->pk_tours; }

function setfk_destino($fk_destino){  $this->fk_destino = $fk_destino;}
function getfk_destino(){  return $this->fk_destino; }

function settxt_descripcion($txt_descripcion){  $this->txt_descripcion = $txt_descripcion;}
function gettxt_descripcion(){  return $this->txt_descripcion; }

function settxt_nombre($txt_nombre){  $this->txt_nombre = $txt_nombre;}
function gettxt_nombre(){  return $this->txt_nombre; }

function settxt_imagen($txt_imagen){  $this->txt_imagen = $txt_imagen;}
function gettxt_imagen(){  return $this->txt_imagen; }

function settxt_creacion($txt_creacion){  $this->txt_creacion = $txt_creacion;}
function gettxt_creacion(){  return $this->txt_creacion; }

function settxt_status($int_status){  $this->int_status = $int_status;}
function gettxt_status(){  return $this->int_status; }


function elimina()
{
	$sql = "DELETE FROM [|PREFIX|]tours WHERE pk_tours = '".$this->getpk_tours()."'";
	$GLOBALS['CONNECT_DB']->Query($sql);
}

function guarda()
{
	$array_tourss = array("txt_descripcion"=>$this->gettxt_descripcion(),
						  "txt_imagen"=>$this->gettxt_imagen(),
						  "txt_nombre"=>$this->gettxt_nombre(),
						  "fk_destino"=>$this->getfk_destino(),
						  "int_estado"=>$this->gettxt_status(),
						  "txt_creacion"=>$this->gettxt_creacion()
						  );
	insert($array_tourss,"[|PREFIX|]tours") or die(mysql_error());
	$id = $GLOBALS['CONNECT_DB']->LastId();
    $this->setpk_tours($id);
}


function actualiza()
{	
	$array_modify = array("txt_descripcion"=>$this->gettxt_descripcion(),
						  "txt_imagen"=>$this->gettxt_imagen(),
						  "txt_nombre"=>$this->gettxt_nombre(),
						  "fk_destino"=>$this->getfk_destino(),
						  "int_estado"=>$this->gettxt_status(),
						  "txt_creacion"=>$this->gettxt_creacion()
						  );
   $array_where = array("pk_tours"=>$this->getpk_tours());
   update($array_modify,"[|PREFIX|]tours",$array_where);
}


function estado($estado)
{	$est=$estado;
	if($estado=="")
	{	$estado=($this->gettxt_status()=="1")?"0":"1";}

	$sql = "UPDATE [|PREFIX|]tours
				SET int_estado='".$estado."'
			WHERE pk_tours = '".$this->getpk_tours()."'";
			
	$GLOBALS['CONNECT_DB']->Query($sql);
	if($est=="")
	{
		$icono = "ico_estado".$estado.".gif";
		echo "<a href='javascript:ajax_estado(".$this->getpk_tours().")'>
 			  <img src='"._URL."admin/images/icons/".$icono."' border='0'></a>";
	}
}

function Listatourss($pk_tours=''){
 $SQL = "SELECT * FROM [|PREFIX|]tours where int_estado = '1' ORDER BY txt_nombre ASC";
 $Query = $GLOBALS['CONNECT_DB']->Query($SQL);
 $str_cmb = "";
 while($Fetch = $GLOBALS['CONNECT_DB']->Fetch($Query)){
  
  $str_cmb .= "<option value=\"{$Fetch['pk_tours']}\" ";
  if($Fetch['pk_tours']==(int)$pk_tours)
  $str_cmb .= "selected";
  
  $str_cmb .= ">";
  $str_cmb .= $Fetch['txt_nombre'];
  $str_cmb .= "</option>";
 }
 return $str_cmb ;
}


function lista($sql="")
{
	if(!tep_not_null($sql)){
	$sql = $GLOBALS['CONNECT_DB']->Query("SELECT tbl_tours.pk_tours, tbl_tours.txt_descripcion, tbl_tours.txt_nombre, tbl_tours.int_estado, tbl_tours.txt_imagen, tbl_tours.txt_creacion, tbl_destino.txt_nombre as destino, fk_destino FROM tbl_tours INNER JOIN tbl_destino ON tbl_tours.fk_destino = tbl_destino.pk_destino ORDER BY tbl_tours.txt_nombre ASC LIMIT");
	}else{
	$sql = $GLOBALS['CONNECT_DB']->Query($sql);
	}
	
	$i=0;
	while($Fetch = $GLOBALS['CONNECT_DB']->Fetch($sql))
	{
		$arreglo[$i]['pk_tours'] = $Fetch['pk_tours'];
		$arreglo[$i]['txt_descripcion'] = $Fetch['txt_descripcion'];	
		$arreglo[$i]['txt_nombre'] = $Fetch['txt_nombre'];
		$arreglo[$i]['destino'] = $Fetch['destino'];
		$arreglo[$i]['txt_imagen'] = $Fetch['txt_imagen'];	
		$arreglo[$i]['txt_creacion'] = $Fetch['txt_creacion'];		
		$arreglo[$i]['int_estado'] = $Fetch['int_estado'];
		$arreglo[$i]['txt_creacion'] = $Fetch['txt_creacion'];
	 $i++;
	}
	
	return $arreglo;
}

function IsExistTours($IsActive=false){
$arr_and = "";
if($IsActive==true)	
$arr_and = "AND int_estado='1' ";

$SQL = "SELECT * FROM [|PREFIX|]tours WHERE pk_tours='".$this->getpk_tours()."' $arr_and";
$QueryExist = $GLOBALS['CONNECT_DB']->Query($SQL);
$Count = $GLOBALS['CONNECT_DB']->CountResult($QueryExist);
if($Count==0)
return false ;
else
return true ;
}


function listtours_public($destino){
	$SQL = "SELECT pk_tours, tbl_tours.txt_imagen, tbl_tours.int_estado, tbl_tours.txt_nombre, tbl_tours.txt_descripcion, fk_destino, tbl_destino.txt_nombre as destino FROM tbl_tours INNER JOIN tbl_destino ON tbl_tours.fk_destino = tbl_destino.pk_destino WHERE tbl_tours.int_estado =  '1' AND fk_destino = '".$destino."' ORDER BY pk_tours DESC";
	#echo $SQL;
	#exit();
	
	 $Query = $GLOBALS['CONNECT_DB']->Query($SQL);
 	 $count = $GLOBALS['CONNECT_DB']->CountResult($Query);
		 if($count >= 1) {
 			$str_tours = "";
			$str_tours .= "<table class=\"std\">";
			$str_tours .= "	<thead>";
			$str_tours .= "	<tr>";
			$str_tours .= "	<th>TOUR</th>";
			$str_tours .= "	</tr>";
			$str_tours .= "	</thead>";
			$str_tours .= "		<tbody>";
		 	 while($Fetch = $GLOBALS['CONNECT_DB']->Fetch($Query)) {	
			 	
				$folder_complete = PUBLIC_PHOTOBIG_TOURS;
				$Image = $Fetch['txt_imagen']; 
				$Nombre = $Fetch['txt_nombre']; 
				$Destino = safename($Fetch['destino']);
				
				if(_SEOMOD==1){
					$link_tours = _URL."tours/".$Destino."/".safename($Nombre)."-pid-".$Fetch['pk_tours']."."._FEXT;
				}else{
					$link_tours = _URL.'tours_detalle.php?pid='.$Fetch['pk_tours'];
				}
					 				
				$str_tours .= "		<tr id=\"quantityDiscount_0\">";
				$str_tours .= "		<td cols=\"3\" width=\"100%\">";
					
					
			$str_tours .= "<div class=\"block\">";
			
			#$str_tours .= "<img id=\"sale-label\" style=\"position: absolute; top: -2px; left: -7px; z-index: 100; display: block; width: auto; height: auto;\" src=\""._URL."images/ribbons_tours.png\" alt=\"Sale!\" />";
			
			$str_tours .= "	<a href=\"$link_tours\">";
			
			if($Image=='' || !file_exists($folder_complete.$Image))
	  			$img_thumb = $folder_complete.$Image.'img_noavailable.jpg';
			else
				$img_thumb = base64_encode($folder_complete.$Image);

			$str_tours .= tep_image(_URL.'resize.php?image='.$img_thumb.'&w=180&h=126&IsCrop=0','','','','');
			
			$str_tours .= "</a>";
			$str_tours .= "	<div>";
			$str_tours .= "		<h4>";
			$str_tours .= 		$Nombre;
			$str_tours .= "		</h4>";
			$str_tours .= "		<p>";		
			$Presentacion = removeEvilTags(stripslashes_deep(fewchars($Fetch['txt_descripcion'],250)));	
			$str_tours .= 		$Presentacion;			
			$str_tours .= "		</p>";
			$str_tours .= "		<span class=\"price\">Seleccionar</span>";
			$str_tours .= "		<a href=\"$link_tours\" class=\"more\"><img style=\"border:0px\" src=\""._URL."images/ver_detalles.gif\"></a>";
			$str_tours .= "	</div>";
			$str_tours .= "</div>";
					
					
				$str_tours .= "		</td>";
				$str_tours .= "		</tr>";
		 	 }#cierro while
			$str_tours .= "		</tbody>";
			$str_tours .= "</table>";
		} #cierro if
		 return $str_tours ;
}#cierro la funcion

} #cierro la clase

?>