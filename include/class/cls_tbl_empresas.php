<?php
class cls_tbl_empresas{

var $pk_empresa ;
var $txt_razon;
var $txt_domicilio;
var $txt_ruc;
var $txt_email;
var $txt_telefono;
var $txt_fax;
var $int_status ;
var $txt_personas;
var $txt_dateadd ;
var $txt_fecha;
var $txt_volumendolares;
var $txt_volumensoles;


function cls_tbl_empresas($id=0)
{

	if($id!=0)
	{
		$sql = $GLOBALS['CONNECT_DB']->Query("SELECT * FROM tbl_empresa WHERE pk_empresa = '".$id."' ORDER BY txt_fecha DESC");
		$fila = $GLOBALS['CONNECT_DB']->Fetch($sql);
		$this->setpk_empresa($fila['pk_empresa']);
		$this->settxt_razon($fila['txt_razon']);
		$this->settxt_domicilio($fila['txt_domicilio']);
		$this->settxt_ruc($fila['txt_ruc']);
		$this->settxt_email($fila['txt_email']);
		$this->settxt_telefono($fila['txt_telefono']);
		$this->settxt_fax($fila['txt_fax']);
		$this->settxt_personas($fila['txt_personas']);
		$this->settxt_status($fila['int_estado']);
		$this->settxt_volumendolares($fila['txt_volumendolares']);
		$this->settxt_volumensoles($fila['txt_volumensoles']);
		$this->setdate_fecha($fila['txt_fecha']);
	}else{
		$this->setpk_empresa('');
		$this->settxt_razon('');
		$this->settxt_domicilio('');
		$this->settxt_ruc('');
		$this->settxt_email('');
		$this->settxt_telefono('');
		$this->settxt_fax('');
		$this->settxt_personas('');
		$this->settxt_status('');
		$this->settxt_volumendolares('');
		$this->settxt_volumensoles('');
		$this->setdate_fecha($fila['txt_fecha']);
	}

}


function setpk_empresa($pk_empresa){  $this->pk_empresa = $pk_empresa;}
function getpk_empresa(){  return $this->pk_empresa; }

function settxt_razon($txt_razon){  $this->txt_razon = $txt_razon;}
function gettxt_razon(){  return $this->txt_razon; }

function settxt_domicilio($txt_domicilio){  $this->txt_domicilio = $txt_domicilio;}
function gettxt_domicilio(){  return $this->txt_domicilio; }

function settxt_ruc($txt_ruc){  $this->txt_ruc = $txt_ruc;}
function gettxt_ruc(){  return $this->txt_ruc; }

function settxt_email($txt_email){  $this->txt_email = $txt_email;}
function gettxt_email(){  return $this->txt_email; }

function settxt_telefono($txt_telefono){  $this->txt_telefono = $txt_telefono;}
function gettxt_telefono(){  return $this->txt_telefono; }

function settxt_fax($txt_fax){  $this->txt_fax = $txt_fax;}
function gettxt_fax(){  return $this->txt_fax; }

function settxt_personas($txt_personas){  $this->txt_personas = $txt_personas;}
function gettxt_personas(){  return $this->txt_personas; }

function settxt_status($int_status){  $this->int_status = $int_status;}
function gettxt_status(){  return $this->int_status; }

function settxt_volumendolares($txt_volumendolares){  $this->txt_volumendolares = $txt_volumendolares;}
function gettxt_volumendolares(){  return $this->txt_volumendolares; }

function settxt_volumensoles($txt_volumensoles){  $this->txt_volumensoles = $txt_volumensoles;}
function gettxt_volumensoles(){  return $this->txt_volumensoles; }

function setdate_fecha($txt_fecha){  $this->txt_fecha = $txt_fecha;}
function getdate_fecha(){  return $this->txt_fecha; }


function elimina()
{
	$sql = "DELETE FROM tbl_empresa WHERE pk_empresa = '".$this->getpk_empresa()."'";
	$GLOBALS['CONNECT_DB']->Query($sql);
}

function IsExistEmpresa($IsActive=false){
$arr_and = "";
if($IsActive==true)	
$arr_and = "AND int_estado='1' ";

$SQL = "SELECT * FROM [|PREFIX|]empresas WHERE pk_empresa='".$this->getpk_empresa()."' $arr_and";
$QueryExist = $GLOBALS['CONNECT_DB']->Query($SQL);
$Count = $GLOBALS['CONNECT_DB']->CountResult($QueryExist);
if($Count==0)
return false ;
else
return true ;
}


function guarda()
{   
    
$array_content = array("txt_razon"=>$this->gettxt_razon(),
	                   "txt_domicilio"=>$this->gettxt_domicilio(),
					   "txt_ruc"=>$this->gettxt_ruc(),
					   "txt_email"=>$this->gettxt_email(),
					   "txt_telefono"=>$this->gettxt_telefono(),
					   "txt_fax"=>$this->gettxt_fax(),
					   "txt_personas"=>$this->gettxt_personas(),
					   "txt_volumendolares"=>$this->gettxt_volumendolares(),
					   "txt_volumensoles"=>$this->gettxt_volumensoles(),
					   "txt_fecha"=>$this->getdate_fecha(),
					   "int_estado"=>$this->gettxt_status());
   insert($array_content,"[|PREFIX|]empresa");
   $id = $GLOBALS['CONNECT_DB']->LastId();
   $this->setpk_empresa($id);
   
}

function lista($sql="")
{
	if(!tep_not_null($sql)){
	$sql = $GLOBALS['CONNECT_DB']->Query("SELECT * FROM tbl_empresa");
	}else{
	$sql = $GLOBALS['CONNECT_DB']->Query($sql);
	}
	
	$i=0;
	while($Fetch = $GLOBALS['CONNECT_DB']->Fetch($sql))
	{
		$arreglo[$i]['pk_empresa'] = $Fetch['pk_empresa'];
		$arreglo[$i]['txt_razon'] = $Fetch['txt_razon'];
		$arreglo[$i]['txt_domicilio'] = $Fetch['txt_domicilio'];
		$arreglo[$i]['txt_ruc'] = $Fetch['txt_ruc'];
		$arreglo[$i]['txt_email'] = $Fetch['txt_email'];
		$arreglo[$i]['txt_telefono'] = $Fetch['txt_telefono'];
		$arreglo[$i]['txt_fax'] = $Fetch['txt_fax'];
		$arreglo[$i]['txt_volumendolares'] = $Fetch['txt_volumendolares'];
		$arreglo[$i]['txt_volumensoles'] = $Fetch['txt_volumensoles'];
		$arreglo[$i]['txt_personas'] = $Fetch['txt_personas'];
		$arreglo[$i]['int_estado'] = $Fetch['int_estado'];
		$arreglo[$i]['txt_fecha'] = $Fetch['txt_fecha'];
	 $i++;
	}
	
	return $arreglo;
}



}