<?php
class cls_tbl_estado{
var $pk_estado;
var $txt_descripcion;
var $int_status;
var $txt_dateadd ;


function cls_tbl_estado($id=0)
{
	if($id!=0)
	{
		$sql = $GLOBALS['CONNECT_DB']->Query("SELECT * FROM [|PREFIX|]estado WHERE pk_estado = '".$id."' ORDER BY pk_estado ASC");
		$fila = $GLOBALS['CONNECT_DB']->Fetch($sql);
		$this->setpk_estado($fila['pk_estado']);
		$this->settxt_descripcion($fila['txt_descripcion']);
		$this->settxt_status($fila['int_estado']);
		$this->setdate_dateadd($fila['fecha_registro']);
	}else{
		$this->setpk_estado('');
		$this->settxt_descripcion('');
		$this->settxt_status('');
		$this->setdate_dateadd('');
	}

}

function setpk_estado($pk_estado){  $this->pk_estado = $pk_estado;}
function getpk_estado(){  return $this->pk_estado; }

function settxt_descripcion($txt_descripcion){  $this->txt_descripcion = $txt_descripcion;}
function gettxt_descripcion(){  return $this->txt_descripcion; }

function settxt_status($int_status){  $this->int_status = $int_status;}
function gettxt_status(){  return $this->int_status; }

function setdate_dateadd($txt_dateadd){  $this->txt_dateadd = $txt_dateadd;}
function getdate_dateadd(){  return $this->txt_dateadd; }


function elimina()
{
	$sql = "DELETE FROM [|PREFIX|]estado WHERE  pk_estado = '".$this->getpk_estado()."'";
	$GLOBALS['CONNECT_DB']->Query($sql);
}

function guarda()
{
	
	$array_formapago = array("txt_descripcion"=>$this->gettxt_descripcion(),
						  "int_estado"=>$this->gettxt_status(),
						  "fecha_registro"=>$this->getdate_dateadd()
						  );
	insert($array_formapago,"[|PREFIX|]estado") or die(mysql_error());
	$id = $GLOBALS['CONNECT_DB']->LastId();
    $this->setpk_estado($id);
}


function actualiza()
{	
	$array_modify = array("txt_descripcion"=>$this->gettxt_descripcion(),
						  "int_estado"=>$this->gettxt_status(),
						  "fecha_registro"=>$this->getdate_dateadd()
						  );
   $array_where = array("pk_estado"=>$this->getpk_estado());
   
   update($array_modify,"[|PREFIX|]estado",$array_where);

}


function estado($estado)
{	$est=$estado;
	if($estado=="")
	{	$estado=($this->gettxt_status()=="1")?"0":"1";}

	$sql = "UPDATE [|PREFIX|]estado
				SET int_estado='".$estado."'
			WHERE pk_estado = '".$this->getpk_estado()."'";
	$GLOBALS['CONNECT_DB']->Query($sql);
	if($est=="")
	{
		$icono = "ico_estado".$estado.".gif";
		echo "<a href='javascript:ajax_estado(".$this->getpk_estado().")'>
 			  <img src='"._URL."paneldecontrol/images/icons/".$icono."' border='0'></a>";
	}
}


function ListaEstado($pk_estado=''){
 $SQL = "SELECT * FROM [|PREFIX|]estado where int_estado = '1' ORDER BY pk_estado ASC";
 $Query = $GLOBALS['CONNECT_DB']->Query($SQL);
 $str_cmb = "";
 while($Fetch = $GLOBALS['CONNECT_DB']->Fetch($Query)){
  
  $str_cmb .= "<option value=\"{$Fetch['pk_estado']}\" ";
  if($Fetch['pk_estado']==(int)$pk_estado)
  $str_cmb .= "selected";
  
  $str_cmb .= ">";
  $str_cmb .= $Fetch['txt_descripcion'];
  $str_cmb .= "</option>";
 }
 return $str_cmb ;
}



function lista($sql="")
{
	if(!tep_not_null($sql)){
	$sql = $GLOBALS['CONNECT_DB']->Query("SELECT pk_estado, txt_descripcion, int_estado, fecha_registro FROM [|PREFIX|]estado ORDER BY pk_estado DESC");
	}else{
	$sql = $GLOBALS['CONNECT_DB']->Query($sql);
	}
	
	$i=0;
	while($Fetch = $GLOBALS['CONNECT_DB']->Fetch($sql))
	{
		$arreglo[$i]['pk_estado'] = $Fetch['pk_estado'];
		$arreglo[$i]['txt_descripcion'] = $Fetch['txt_descripcion'];
		$arreglo[$i]['int_estado'] = $Fetch['int_estado'];
		$arreglo[$i]['fecha_registro'] = $Fetch['fecha_registro'];
	 $i++;
	}
	
	return $arreglo;
}

}

?>