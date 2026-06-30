<?php
class cls_tbl_cadena{
	var $pk_cadena;
	var $txt_nombre;
	var $txt_imagen;
	var $txt_creacion ;
	var $int_status;
	var $txt_dateadd ;

function cls_tbl_cadena($id=0)
{
	if($id!=0)
	{
		$sql = $GLOBALS['CONNECT_DB']->Query("SELECT * FROM [|PREFIX|]cadena WHERE pk_cadena = '".$id."' ORDER BY pk_cadena ASC");
		$fila = $GLOBALS['CONNECT_DB']->Fetch($sql);
		$this->setpk_cadena($fila['pk_cadena']);
		$this->settxt_nombre($fila['txt_nombre']);
		$this->settxt_imagen($fila['txt_imagen']);
		$this->settxt_status($fila['int_estado']);
		$this->settxt_creacion($fila['txt_creacion']);
		$this->setdate_dateadd($fila['fecha_registro']);
	}else{
		$this->setpk_cadena('');
		$this->settxt_nombre('');
		$this->settxt_imagen('');
		$this->settxt_creacion('');
		$this->settxt_status('');
		$this->setdate_dateadd('');
	}
}


function setpk_cadena($pk_cadena){  $this->pk_cadena = $pk_cadena;}
function getpk_cadena(){  return $this->pk_cadena; }

function settxt_nombre($txt_nombre){  $this->txt_nombre = $txt_nombre;}
function gettxt_nombre(){  return $this->txt_nombre; }

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
	$sql = "DELETE FROM [|PREFIX|]cadena WHERE  pk_cadena = '".$this->getpk_cadena()."'";
	$GLOBALS['CONNECT_DB']->Query($sql);
}

function guarda()
{
	$array_cadenas = array("txt_nombre"=>$this->gettxt_nombre(),
						  "txt_imagen"=>$this->gettxt_imagen(),
						  "int_estado"=>$this->gettxt_status(),
						  "txt_creacion"=>$this->gettxt_creacion(),
						  "fecha_registro"=>$this->getdate_dateadd()
						  );
	insert($array_cadenas,"[|PREFIX|]cadena") or die(mysql_error());
	$id = $GLOBALS['CONNECT_DB']->LastId();
    $this->setpk_cadena($id);
}


function actualiza()
{	
	$array_modify = array("txt_nombre"=>$this->gettxt_nombre(),
						  "txt_imagen"=>$this->gettxt_imagen(),
						  "int_estado"=>$this->gettxt_status(),
						  "txt_creacion"=>$this->gettxt_creacion(),
						  "fecha_registro"=>$this->getdate_dateadd()
						  );
   $array_where = array("pk_cadena"=>$this->getpk_cadena());
   update($array_modify,"[|PREFIX|]cadena",$array_where);
}


function estado($estado)
{	$est=$estado;
	if($estado=="")
	{	$estado=($this->gettxt_status()=="1")?"0":"1";}

	$sql = "UPDATE [|PREFIX|]cadena
				SET int_estado='".$estado."'
			WHERE pk_cadena = '".$this->getpk_cadena()."'";
	$GLOBALS['CONNECT_DB']->Query($sql);
	if($est=="")
	{
		$icono = "ico_estado".$estado.".gif";
		echo "<a href='javascript:ajax_estado(".$this->getpk_cadena().")'>
 			  <img src='"._URL."admin/images/icons/".$icono."' border='0'></a>";
	}
}

function ListaCadenas($pk_cadena=''){
 $SQL = "SELECT * FROM [|PREFIX|]cadena where int_estado = '1' ORDER BY txt_nombre ASC";
 $Query = $GLOBALS['CONNECT_DB']->Query($SQL);
 $str_cmb = "";
 while($Fetch = $GLOBALS['CONNECT_DB']->Fetch($Query)){
  
  $str_cmb .= "<option value=\"{$Fetch['pk_cadena']}\" ";
  if($Fetch['pk_cadena']==(int)$pk_cadena)
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
	$sql = $GLOBALS['CONNECT_DB']->Query("SELECT [|PREFIX|]cadena.pk_cadena, [|PREFIX|]cadena.txt_nombre, [|PREFIX|]cadena.int_estado, [|PREFIX|]cadena.fecha_registro, [|PREFIX|]cadena.txt_imagen, [|PREFIX|]cadena.txt_creacion FROM [|PREFIX|]cadena ORDER BY [|PREFIX|]cadena.txt_nombre ASC");
	}else{
	$sql = $GLOBALS['CONNECT_DB']->Query($sql);
	}
	
	$i=0;
	while($Fetch = $GLOBALS['CONNECT_DB']->Fetch($sql))
	{
		$arreglo[$i]['pk_cadena'] = $Fetch['pk_cadena'];
		$arreglo[$i]['txt_nombre'] = $Fetch['txt_nombre'];	
		$arreglo[$i]['txt_imagen'] = $Fetch['txt_imagen'];	
		$arreglo[$i]['txt_creacion'] = $Fetch['txt_creacion'];		
		$arreglo[$i]['int_estado'] = $Fetch['int_estado'];
		$arreglo[$i]['fecha_registro'] = $Fetch['fecha_registro'];
	 $i++;
	}
	
	return $arreglo;
}

function IsExistCadena($IsActive=false){
$arr_and = "";
if($IsActive==true)	
$arr_and = "AND int_estado='1' ";

$SQL = "SELECT * FROM [|PREFIX|]cadena WHERE pk_cadena='".$this->getpk_cadena()."' $arr_and";
$QueryExist = $GLOBALS['CONNECT_DB']->Query($SQL);
$Count = $GLOBALS['CONNECT_DB']->CountResult($QueryExist);
if($Count==0)
return false ;
else
return true ;
}

}

?>