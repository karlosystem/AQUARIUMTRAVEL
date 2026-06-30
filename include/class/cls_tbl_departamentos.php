<?php
class cls_tbl_departamento{
	var $pk_departamento;
	var $fk_pais;
	var $txt_descripcion;
	var $txt_imagen;
	var $txt_creacion ;
	var $int_status;
	var $txt_dateadd ;

function cls_tbl_departamento($id=0)
{
	if($id!=0)
	{
		$sql = $GLOBALS['CONNECT_DB']->Query("SELECT * FROM [|PREFIX|]departamento WHERE pk_departamento = '".$id."' ORDER BY pk_departamento ASC");
		$fila = $GLOBALS['CONNECT_DB']->Fetch($sql);
		$this->setpk_departamento($fila['pk_departamento']);
		$this->setfk_pais($fila['fk_pais']);
		$this->settxt_descripcion($fila['txt_descripcion']);
		$this->settxt_imagen($fila['txt_imagen']);
		$this->settxt_status($fila['int_estado']);
		$this->settxt_creacion($fila['txt_creacion']);
		$this->setdate_dateadd($fila['fecha_registro']);
	}else{
		$this->setpk_departamento('');
		$this->setfk_pais('');
		$this->settxt_descripcion('');
		$this->settxt_imagen('');
		$this->settxt_creacion('');
		$this->settxt_status('');
		$this->setdate_dateadd('');
	}
}


function setpk_departamento($pk_departamento){  $this->pk_departamento = $pk_departamento;}
function getpk_departamento(){  return $this->pk_departamento; }

function setfk_pais($fk_pais){  $this->fk_pais = $fk_pais;}
function getfk_pais(){  return $this->fk_pais; }

function settxt_descripcion($txt_descripcion){  $this->txt_descripcion = $txt_descripcion;}
function gettxt_descripcion(){  return $this->txt_descripcion; }

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
	$sql = "DELETE FROM [|PREFIX|]departamento WHERE  pk_departamento = '".$this->getpk_departamento()."'";
	$GLOBALS['CONNECT_DB']->Query($sql);
}

function guarda()
{
	$array_departamentos = array("txt_descripcion"=>$this->gettxt_descripcion(),
						  "fk_pais"=>$this->getfk_pais(),
						  "txt_imagen"=>$this->gettxt_imagen(),
						  "int_estado"=>$this->gettxt_status(),
						  "txt_creacion"=>$this->gettxt_creacion(),
						  "fecha_registro"=>$this->getdate_dateadd()
						  );
	insert($array_departamentos,"[|PREFIX|]departamento") or die(mysql_error());
	$id = $GLOBALS['CONNECT_DB']->LastId();
    $this->setpk_departamento($id);
}


function actualiza()
{	
	$array_modify = array("txt_descripcion"=>$this->gettxt_descripcion(),
						  "fk_pais"=>$this->getfk_pais(),
						  "txt_imagen"=>$this->gettxt_imagen(),
						  "int_estado"=>$this->gettxt_status(),
						  "txt_creacion"=>$this->gettxt_creacion(),
						  "fecha_registro"=>$this->getdate_dateadd()
						  );
   $array_where = array("pk_departamento"=>$this->getpk_departamento());
   update($array_modify,"[|PREFIX|]departamento",$array_where);
}


function estado($estado)
{	$est=$estado;
	if($estado=="")
	{	$estado=($this->gettxt_status()=="1")?"0":"1";}

	$sql = "UPDATE [|PREFIX|]departamento
				SET int_estado='".$estado."'
			WHERE pk_departamento = '".$this->getpk_departamento()."'";
	$GLOBALS['CONNECT_DB']->Query($sql);
	if($est=="")
	{
		$icono = "ico_estado".$estado.".gif";
		echo "<a href='javascript:ajax_estado(".$this->getpk_departamento().")'>
 			  <img src='"._URL."admin/images/icons/".$icono."' border='0'></a>";
	}
}

function ListaDepartamentos_original($pk_departamento=''){
 $SQL = "SELECT * FROM [|PREFIX|]departamento where int_estado = '1' ORDER BY txt_descripcion ASC";
 $Query = $GLOBALS['CONNECT_DB']->Query($SQL);
 $str_cmb = "";
 while($Fetch = $GLOBALS['CONNECT_DB']->Fetch($Query)){
  
  $str_cmb .= "<option value=\"{$Fetch['pk_departamento']}\" ";
  if($Fetch['pk_departamento']==(int)$pk_departamento)
  $str_cmb .= "selected";
  
  $str_cmb .= ">";
  $str_cmb .= $Fetch['txt_descripcion'];
  $str_cmb .= "</option>";
 }
 return $str_cmb ;
}

function ListaDepartamentos($pk_departamento=''){
 $str_cmb = "";
 $SQL_PAIS = "SELECT id, name, printable_name, iso3 FROM [|PREFIX|]countries WHERE int_estado = '1' ORDER BY name ASC";
 $Query_PAIS = $GLOBALS['CONNECT_DB']->Query($SQL_PAIS);

 while($Fetch_pais = $GLOBALS['CONNECT_DB']->Fetch($Query_PAIS)){
   $str_cmb .= "<optgroup label=\"{$Fetch_pais['name']}\">";
   	$SQL = "SELECT  pk_departamento, fk_pais, txt_descripcion, int_estado FROM [|PREFIX|]departamento where int_estado = '1' and fk_pais = ".$Fetch_pais['id']." ORDER BY txt_descripcion ASC";
 	$Query = $GLOBALS['CONNECT_DB']->Query($SQL);
		while($Fetch = $GLOBALS['CONNECT_DB']->Fetch($Query)){
		  $str_cmb .= "<option value=\"{$Fetch['pk_departamento']}\" ";
		  if($Fetch['pk_departamento']==(int)$pk_departamento)
		  $str_cmb .= "selected";
		  
		  $str_cmb .= ">";
		  $str_cmb .= $Fetch['txt_descripcion'];
		  $str_cmb .= "</option>";
		}  
   $str_cmb .= "</optgroup>";
 }
 return $str_cmb ;
}

function ListaPaises($id=''){
 $SQL = "SELECT * FROM [|PREFIX|]countries ORDER BY name ASC";
 $Query = $GLOBALS['CONNECT_DB']->Query($SQL);
 $str_cmb = "";
 while($Fetch = $GLOBALS['CONNECT_DB']->Fetch($Query)){
  
  $str_cmb .= "<option value=\"{$Fetch['id']}\" ";
  if($Fetch['id']==(int)$id)
  $str_cmb .= "selected";
  
  $str_cmb .= ">";
  $str_cmb .= $Fetch['name'];
  $str_cmb .= "</option>";
 }
 return $str_cmb ;
}


function lista($sql="")
{
	if(!tep_not_null($sql)){
	$sql = $GLOBALS['CONNECT_DB']->Query("SELECT [|PREFIX|]departamento.pk_departamento, [|PREFIX|]departamento.txt_descripcion, [|PREFIX|]departamento.int_estado, [|PREFIX|]departamento.fecha_registro, [|PREFIX|]departamento.txt_imagen, [|PREFIX|]departamento.txt_creacion, [|PREFIX|]countries.name as pais FROM [|PREFIX|]departamento LEFT JOIN  [|PREFIX|]countries ON [|PREFIX|]departamento.fk_pais = [|PREFIX|]countries.id ORDER BY [|PREFIX|]departamento.txt_descripcion ASC");
	}else{
	$sql = $GLOBALS['CONNECT_DB']->Query($sql);
	}
	
	$i=0;
	while($Fetch = $GLOBALS['CONNECT_DB']->Fetch($sql))
	{
		$arreglo[$i]['pk_departamento'] = $Fetch['pk_departamento'];
		$arreglo[$i]['pais'] = $Fetch['pais'];		
		$arreglo[$i]['txt_descripcion'] = $Fetch['txt_descripcion'];	
		$arreglo[$i]['txt_imagen'] = $Fetch['txt_imagen'];	
		$arreglo[$i]['txt_creacion'] = $Fetch['txt_creacion'];		
		$arreglo[$i]['int_estado'] = $Fetch['int_estado'];
		$arreglo[$i]['fecha_registro'] = $Fetch['fecha_registro'];
	 $i++;
	}
	
	return $arreglo;
}

function IsExistDepartamento($IsActive=false){
$arr_and = "";
if($IsActive==true)	
$arr_and = "AND int_estado='1' ";

$SQL = "SELECT * FROM [|PREFIX|]departamento WHERE pk_departamento='".$this->getpk_departamento()."' $arr_and";
$QueryExist = $GLOBALS['CONNECT_DB']->Query($SQL);
$Count = $GLOBALS['CONNECT_DB']->CountResult($QueryExist);
if($Count==0)
return false ;
else
return true ;
}

}

?>