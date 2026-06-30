<?php
class cls_tbl_aeropuerto{
	var $pk_aeropuerto;
	var $fk_pais;
	var $txt_nombre;
	var $txt_imagen;
	var $txt_creacion ;
	var $int_status;
	var $txt_dateadd ;

function cls_tbl_aeropuerto($id=0)
{
	if($id!=0)
	{
		$sql = $GLOBALS['CONNECT_DB']->Query("SELECT * FROM [|PREFIX|]aeropuerto WHERE pk_aeropuerto = '".$id."' ORDER BY pk_aeropuerto ASC");
		$fila = $GLOBALS['CONNECT_DB']->Fetch($sql);
		$this->setpk_aeropuerto($fila['pk_aeropuerto']);
		$this->settxt_nombre($fila['txt_nombre']);
		$this->settxt_imagen($fila['txt_imagen']);
		$this->settxt_status($fila['int_estado']);
	}else{
		$this->setpk_aeropuerto('');
		$this->settxt_nombre('');
		$this->settxt_imagen('');
		$this->settxt_status('');
	}
}


function setpk_aeropuerto($pk_aeropuerto){  $this->pk_aeropuerto = $pk_aeropuerto;}
function getpk_aeropuerto(){  return $this->pk_aeropuerto; }

function settxt_nombre($txt_nombre){  $this->txt_nombre = $txt_nombre;}
function gettxt_nombre(){  return $this->txt_nombre; }

function settxt_imagen($txt_imagen){  $this->txt_imagen = $txt_imagen;}
function gettxt_imagen(){  return $this->txt_imagen; }

function settxt_status($int_status){  $this->int_status = $int_status;}
function gettxt_status(){  return $this->int_status; }


function elimina()
{
	$sql = "DELETE FROM [|PREFIX|]aeropuerto WHERE  pk_aeropuerto = '".$this->getpk_aeropuerto()."'";
	$GLOBALS['CONNECT_DB']->Query($sql);
}

function guarda()
{
	$array_aeropuertos = array("txt_nombre"=>$this->gettxt_nombre(),
						  "txt_imagen"=>$this->gettxt_imagen(),
						  "int_estado"=>$this->gettxt_status()
						  );
	insert($array_aeropuertos,"[|PREFIX|]aeropuerto") or die(mysql_error());
	$id = $GLOBALS['CONNECT_DB']->LastId();
    $this->setpk_aeropuerto($id);
}


function actualiza()
{	
	$array_modify = array("txt_nombre"=>$this->gettxt_nombre(),
						  "txt_imagen"=>$this->gettxt_imagen(),
						  "int_estado"=>$this->gettxt_status()
						  );
   $array_where = array("pk_aeropuerto"=>$this->getpk_aeropuerto());
   update($array_modify,"[|PREFIX|]aeropuerto",$array_where);
}


function estado($estado)
{	$est=$estado;
	if($estado=="")
	{	$estado=($this->gettxt_status()=="1")?"0":"1";}

	$sql = "UPDATE [|PREFIX|]aeropuerto
				SET int_estado='".$estado."'
			WHERE pk_aeropuerto = '".$this->getpk_aeropuerto()."'";
	$GLOBALS['CONNECT_DB']->Query($sql);
	if($est=="")
	{
		$icono = "ico_estado".$estado.".gif";
		echo "<a href='javascript:ajax_estado(".$this->getpk_aeropuerto().")'>
 			  <img src='"._URL."admin/images/icons/".$icono."' border='0'></a>";
	}
}

function ListaAeropuertos($pk_aeropuerto=''){
 $SQL = "SELECT * FROM [|PREFIX|]aeropuerto where int_estado = '1' ORDER BY pk_aeropuerto ASC";
 $Query = $GLOBALS['CONNECT_DB']->Query($SQL);
 $str_cmb = "";
 while($Fetch = $GLOBALS['CONNECT_DB']->Fetch($Query)){
  
  $str_cmb .= "<option value=\"{$Fetch['pk_aeropuerto']}\" ";
  if($Fetch['pk_aeropuerto']==(int)$pk_aeropuerto)
  $str_cmb .= "selected";
  
  $str_cmb .= ">";
  $str_cmb .= $Fetch['txt_nombre'];
  $str_cmb .= "</option>";
 }
 return $str_cmb ;
}



function IsExistaeropuerto($IsActive=false){
$arr_and = "";
if($IsActive==true)	
$arr_and = "AND int_estado='1' ";

$SQL = "SELECT * FROM [|PREFIX|]aeropuerto WHERE pk_aeropuerto='".$this->getpk_aeropuerto()."' $arr_and";
$QueryExist = $GLOBALS['CONNECT_DB']->Query($SQL);
$Count = $GLOBALS['CONNECT_DB']->CountResult($QueryExist);
if($Count==0)
return false ;
else
return true ;
}

}

?>