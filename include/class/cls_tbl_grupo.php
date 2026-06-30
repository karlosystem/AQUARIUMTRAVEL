<?php

/**
 * Mapeado de la tabla webgrupos de la base de datos corpdamar
 *
 * @name cls_tbl_grupo.php
 * @author Juan Minaya León
 * @author jminaya@hotmail.com
 * @version 2.0
 * @package include
 * @subpackage class
 * @copyright Todos los derechos reservados
 */

class cls_tbl_grupo {

var $pk_grupo; 
var $txt_nombre;
var $int_estado;

function cls_tbl_grupo($id=0)
{
    
	if($id!=0)
	{
		$sql="SELECT * FROM [|PREFIX|]webgrupos WHERE pk_grupo = '".$id."' ORDER BY pk_grupo DESC";
		$fila = $GLOBALS['CONNECT_DB']->Query($sql);
		$this->setpk_grupo($fila['pk_grupo']);
		$this->settxt_nombre($fila['txt_nombre']);
		$this->setint_estado($fila['int_estado']);
	}else{
		$this->setpk_grupo('');
		$this->settxt_nombre('');
		$this->setint_estado('');
	}

}

function setpk_grupo($pk_grupo){  $this->pk_grupo = $pk_grupo;}
function getpk_grupo(){  return $this->pk_grupo; }

function settxt_nombre($txt_nombre){  $this->txt_nombre = $txt_nombre;}
function gettxt_nombre(){  return $this->txt_nombre; }

function setint_estado($int_estado){  $this->int_estado = $int_estado;}
function getint_estado(){  return $this->int_estado; }

function elimina()
{   
	$sql = "DELETE FROM [|PREFIX|]webgrupos WHERE pk_grupo = '".$this->getpk_grupo()."'";
	$GLOBALS['CONNECT_DB']->Query($sql);
}

function guarda()
{   
	$sql = "INSERT INTO [|PREFIX|]webgrupos( txt_nombre,int_estado ) values ( '".$this->gettxt_nombre()."','".$this->getint_estado()."' )";
	$id = $GLOBALS['CONNECT_DB']->Query($sql);
	$this->setpk_grupo($id);
}

function actualiza()
{   
	$sql = " UPDATE [|PREFIX|]webgrupos SET txt_nombre = '".$this->gettxt_nombre()."',int_estado = '".$this->getint_estado()."' WHERE pk_grupo='".$this->getpk_grupo()."' ";
	$GLOBALS['CONNECT_DB']->Query($sql);

}

function lista($sql="")
{   
	if(!tep_not_null($sql)){
		$sql=$GLOBALS['CONNECT_DB']->Query("SELECT * FROM [|PREFIX|]webgrupos ORDER BY pk_grupo DESC");
	}else{
	$sql=$GLOBALS['CONNECT_DB']->Query($sql);
	}
	
	$i=0;
	while($rs = $GLOBALS['CONNECT_DB']->Fetch($sql))
	{
		$arreglo[$i]['pk_grupo'] = $rs['pk_grupo'];
		$arreglo[$i]['txt_nombre'] = $rs['txt_nombre'];
		$arreglo[$i]['int_estado'] = $rs['int_estado'];
	$i++;
	}
	
	
	return $arreglo;
}

} // fin de la clase

?>