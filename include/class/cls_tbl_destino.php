<?php
class cls_tbl_destino{
	var $pk_destino;
	var $txt_nombre;
	var $txt_metatitle;
	var $txt_metadescription;
	var $fk_ubicacion;
	var $txt_descripcion;
	var $txt_imagen;
	var $txt_creacion ;
	var $int_status;
	var $txt_dateadd ;

function cls_tbl_destino($id=0)
{
	if($id!=0)
	{
		$sql = $GLOBALS['CONNECT_DB']->Query("SELECT * FROM [|PREFIX|]destino WHERE pk_destino = '".$id."' ORDER BY pk_destino ASC");
		$fila = $GLOBALS['CONNECT_DB']->Fetch($sql);
		$this->setpk_destino($fila['pk_destino']);
		$this->settxt_nombre($fila['txt_nombre']);
		$this->settxt_metatitle($fila['txt_metatitle']);
		$this->settxt_metadescription($fila['txt_metadescription']);
		$this->setfk_ubicacion($fila['fk_ubicacion']);
		$this->settxt_descripcion($fila['txt_descripcion']);
		$this->settxt_imagen($fila['txt_imagen']);
		$this->settxt_status($fila['int_estado']);
		$this->settxt_creacion($fila['txt_creacion']);
		$this->setdate_dateadd($fila['fecha_registro']);
	}else{
		$this->setpk_destino('');
		$this->settxt_descripcion('');
		$this->settxt_metatitle('');
		$this->settxt_metadescription('');
		$this->settxt_imagen('');
		$this->settxt_nombre('');
		$this->setfk_ubicacion('');
		$this->settxt_creacion('');
		$this->settxt_status('');
		$this->setdate_dateadd('');
	}
}


function setpk_destino($pk_destino){  $this->pk_destino = $pk_destino;}
function getpk_destino(){  return $this->pk_destino; }

function setfk_ubicacion($fk_ubicacion){  $this->fk_ubicacion = $fk_ubicacion;}
function getfk_ubicacion(){  return $this->fk_ubicacion; }

function settxt_descripcion($txt_descripcion){  $this->txt_descripcion = $txt_descripcion;}
function gettxt_descripcion(){  return $this->txt_descripcion; }

function settxt_nombre($txt_nombre){  $this->txt_nombre = $txt_nombre;}
function gettxt_nombre(){  return $this->txt_nombre; }

function settxt_metatitle($txt_metatitle){  $this->txt_metatitle = $txt_metatitle;}
function gettxt_metatitle(){  return $this->txt_metatitle; }

function settxt_metadescription($txt_metadescription){  $this->txt_metadescription = $txt_metadescription;}
function gettxt_metadescription(){  return $this->txt_metadescription; }

function settxt_imagen($txt_imagen){  $this->txt_imagen = $txt_imagen;}
function gettxt_imagen(){  return $this->txt_imagen; }

function settxt_creacion($txt_creacion){  $this->txt_creacion = $txt_creacion;}
function gettxt_creacion(){  return $this->txt_creacion; }

function settxt_status($int_status){  $this->int_status = $int_status;}
function gettxt_status(){  return $this->int_status; }

function setdate_dateadd($txt_dateadd){  $this->txt_dateadd = $txt_dateadd;}
function getdate_dateadd(){  return $this->txt_dateadd; }


function elimina()
{
	$sql = "DELETE FROM [|PREFIX|]destino WHERE  pk_destino = '".$this->getpk_destino()."'";
	$GLOBALS['CONNECT_DB']->Query($sql);
}

function guarda()
{
	$array_destinos = array("txt_descripcion"=>$this->gettxt_descripcion(),
						  "txt_imagen"=>$this->gettxt_imagen(),
						  "txt_nombre"=>$this->gettxt_nombre(),
						  "txt_metatitle"=>$this->gettxt_metatitle(),
						  "txt_metadescription"=>$this->gettxt_metadescription(),
						  "fk_ubicacion"=>$this->getfk_ubicacion(),
						  "int_estado"=>$this->gettxt_status(),
						  "txt_creacion"=>$this->gettxt_creacion(),
						  "fecha_registro"=>$this->getdate_dateadd()
						  );
	insert($array_destinos,"[|PREFIX|]destino") or die(mysql_error());
	$id = $GLOBALS['CONNECT_DB']->LastId();
    $this->setpk_destino($id);
}


function actualiza()
{	
	$array_modify = array("txt_descripcion"=>$this->gettxt_descripcion(),
						  "txt_imagen"=>$this->gettxt_imagen(),
						  "txt_nombre"=>$this->gettxt_nombre(),
						  "txt_metatitle"=>$this->gettxt_metatitle(),
						  "txt_metadescription"=>$this->gettxt_metadescription(),
						  "fk_ubicacion"=>$this->getfk_ubicacion(),
						  "int_estado"=>$this->gettxt_status(),
						  "txt_creacion"=>$this->gettxt_creacion(),
						  "fecha_registro"=>$this->getdate_dateadd()
						  );
   $array_where = array("pk_destino"=>$this->getpk_destino());
   update($array_modify,"[|PREFIX|]destino",$array_where);
}


function estado($estado)
{	$est=$estado;
	if($estado=="")
	{	$estado=($this->gettxt_status()=="1")?"0":"1";}

	$sql = "UPDATE [|PREFIX|]destino
				SET int_estado='".$estado."'
			WHERE pk_destino = '".$this->getpk_destino()."'";
			
	$GLOBALS['CONNECT_DB']->Query($sql);
	if($est=="")
	{
		$icono = "ico_estado".$estado.".gif";
		echo "<a href='javascript:ajax_estado(".$this->getpk_destino().")'>
 			  <img src='"._URL."admin/images/icons/".$icono."' border='0'></a>";
	}
}

function ListaDestinos($pk_destino=''){
 $SQL = "SELECT * FROM [|PREFIX|]destino where int_estado = '1' ORDER BY txt_nombre ASC";
 $Query = $GLOBALS['CONNECT_DB']->Query($SQL);
 $str_cmb = "";
 while($Fetch = $GLOBALS['CONNECT_DB']->Fetch($Query)){
  
  $str_cmb .= "<option value=\"{$Fetch['pk_destino']}\" ";
  if($Fetch['pk_destino']==(int)$pk_destino)
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
	$sql = $GLOBALS['CONNECT_DB']->Query("SELECT [|PREFIX|]destino.pk_destino, [|PREFIX|]destino.txt_descripcion, [|PREFIX|]destino.txt_nombre, [|PREFIX|]destino.int_estado, [|PREFIX|]destino.fecha_registro, [|PREFIX|]destino.txt_imagen, [|PREFIX|]destino.txt_creacion, [|PREFIX|]departamento.txt_descripcion as ubicacion, fk_destino FROM [|PREFIX|]destino INNER JOIN [|PREFIX|]departamento ON [|PREFIX|]destino.fk_ubicacion = [|PREFIX|]departamento.pk_departamento ORDER BY [|PREFIX|]destino.txt_descripcion ASC");
	}else{
	$sql = $GLOBALS['CONNECT_DB']->Query($sql);
	}
	
	$i=0;
	while($Fetch = $GLOBALS['CONNECT_DB']->Fetch($sql))
	{
		$arreglo[$i]['pk_destino'] = $Fetch['pk_destino'];
		$arreglo[$i]['txt_descripcion'] = $Fetch['txt_descripcion'];	
		$arreglo[$i]['txt_nombre'] = $Fetch['txt_nombre'];
		$arreglo[$i]['ubicacion'] = $Fetch['ubicacion'];
		$arreglo[$i]['txt_imagen'] = $Fetch['txt_imagen'];	
		$arreglo[$i]['txt_creacion'] = $Fetch['txt_creacion'];		
		$arreglo[$i]['int_estado'] = $Fetch['int_estado'];
		$arreglo[$i]['fecha_registro'] = $Fetch['fecha_registro'];
	 $i++;
	}
	
	return $arreglo;
}

function IsExistdestino($IsActive=false){
$arr_and = "";
if($IsActive==true)	
$arr_and = "AND int_estado='1' ";

$SQL = "SELECT * FROM [|PREFIX|]destino WHERE pk_destino='".$this->getpk_destino()."' $arr_and";
$QueryExist = $GLOBALS['CONNECT_DB']->Query($SQL);
$Count = $GLOBALS['CONNECT_DB']->CountResult($QueryExist);
if($Count==0)
return false ;
else
return true ;
}

}

?>