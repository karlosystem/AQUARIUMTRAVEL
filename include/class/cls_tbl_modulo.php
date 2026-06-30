<?php

/**
 * Mapeado de la tabla [|PREFIX|]webmodulos de la base de datos corpdamar
 *
 * @name cls_tbl_modulo.php
 * @author Juan Minaya León
 * @author jminaya@hotmail.com
 * @version 2.0
 * @package include
 * @subpackage class
 * @copyright Todos los derechos reservados
 */

class cls_tbl_modulo{

var $pk_modulo; 
var $fk_grupo;
var $txt_nombre;
var $txt_imagen;
var $txt_include;
var $int_estado;
var $txt_sesion;

function cls_tbl_modulo($id=0)
{
   
	if($id!=0)
	{
		$sql=$GLOBALS['CONNECT_DB']->Query("select * from [|PREFIX|]webmodulos where pk_modulo = '".$id."' order by pk_modulo desc;");
		$fila = $GLOBALS['CONNECT_DB']->Fetch($sql);
		$this->setpk_modulo($fila['pk_modulo']);
		$this->setfk_grupo($fila['fk_grupo']);
		$this->settxt_nombre($fila['txt_nombre']);
		$this->settxt_imagen($fila['txt_imagen']);
		$this->settxt_include($fila['txt_include']);
		$this->setint_estado($fila['int_estado']);
		$this->settxt_sesion($fila['txt_sesion']);
	}else{
		$this->setpk_modulo('');
		$this->setfk_grupo('');
		$this->settxt_nombre('');
		$this->settxt_imagen('');
		$this->settxt_include('');
		$this->setint_estado('');
		$this->settxt_sesion('');
	}

}

function setpk_modulo($pk_modulo){  $this->pk_modulo = $pk_modulo;}
function getpk_modulo(){  return $this->pk_modulo; }

function setfk_grupo($fk_grupo){  $this->fk_grupo = $fk_grupo;}
function getfk_grupo(){  return $this->fk_grupo; }

function settxt_nombre($txt_nombre){  $this->txt_nombre = $txt_nombre;}
function gettxt_nombre(){  return $this->txt_nombre; }

function settxt_imagen($txt_imagen){  $this->txt_imagen = $txt_imagen;}
function gettxt_imagen(){  return $this->txt_imagen; }

function settxt_include($txt_include){  $this->txt_include = $txt_include;}
function gettxt_include(){  return $this->txt_include; }

function setint_estado($int_estado){  $this->int_estado = $int_estado;}
function getint_estado(){  return $this->int_estado; }

function settxt_sesion($txt_sesion){  $this->txt_sesion = $txt_sesion;}
function gettxt_sesion(){  return $this->txt_sesion; }

function elimina()
{  
	$sql = "delete from [|PREFIX|]webmodulos where pk_modulo = '".$this->getpk_modulo()."'";
	$GLOBALS['CONNECT_DB']->Query($sql);
}

function guarda()
{  
	$sql = "insert into [|PREFIX|]webmodulos( fk_grupo,txt_nombre,txt_imagen,txt_include,int_estado,txt_sesion )
	 values ( '".$this->getfk_grupo()."','".$this->gettxt_nombre()."','".$this->gettxt_imagen()."',
	 '".$this->gettxt_include()."','1','".$this->gettxt_sesion()."' )";
	$id = $GLOBALS['CONNECT_DB']->Query($sql);
	$this->setpk_modulo($id);
}

function actualiza()
{  
	$sql = " update [|PREFIX|]webmodulos set fk_grupo = '".$this->getfk_grupo()."',txt_nombre = '".$this->gettxt_nombre()."',
	txt_imagen = '".$this->gettxt_imagen()."',txt_include = '".$this->gettxt_include()."',
	txt_sesion = '".$this->gettxt_sesion()."' where pk_modulo='".$this->getpk_modulo()."' ";
	$GLOBALS['CONNECT_DB']->Query($sql);

}
function estado()
{  
	$estado=($this->getint_estado()=="1")?"0":"1";
	$sql = "UPDATE [|PREFIX|]webmodulos
				SET int_estado='".$estado."'
			WHERE pk_modulo= '".$this->getpk_modulo()."'";

	$GLOBALS['CONNECT_DB']->Query($sql);
	$icono = "ico_estado".$estado.".gif";
	echo "<a href='javascript:ajax_estadoModulo(".$this->getpk_modulo().")'>
 		  <img src='../images/admin/icons/".$icono."' border='0'></a>";
}
function lista($sql="")
{  
	if(!tep_not_null($sql)){
		$sql=$GLOBALS['CONNECT_DB']->Query("select * from [|PREFIX|]webmodulos order by pk_modulo desc");
	}else{
	$sql=$GLOBALS['CONNECT_DB']->Query($sql);
	}
	
	//$rs = ;
	//for($i=0;$i<count($rs);$i++)
	$i=0;
	while($Fetch = $GLOBALS['CONNECT_DB']->Fetch($sql))
	{
		$arreglo[$i]['pk_modulo'] = $Fetch['pk_modulo'];
		$arreglo[$i]['fk_grupo'] = $Fetch['fk_grupo'];
		$arreglo[$i]['txt_nombre'] = $Fetch['txt_nombre'];
		$arreglo[$i]['txt_imagen'] = $Fetch['txt_imagen'];
		$arreglo[$i]['txt_include'] = $Fetch['txt_include'];
		$arreglo[$i]['int_estado'] = $Fetch['int_estado'];
		$arreglo[$i]['txt_sesion'] = $Fetch['txt_sesion'];
	 $i++ ;
	}
	
	return $arreglo;
}

} // fin de la clase

?>