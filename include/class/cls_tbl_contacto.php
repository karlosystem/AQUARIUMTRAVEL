<?php

class cls_tbl_contacto{

var $pk_contacto; 
var $txt_nombres;
var $txt_email;
var $txt_telefono;
var $txt_pais;
var $txt_mensaje ;
var $date_fecha ;
var $txt_vendedor;
var $fk_estado;
var $estado;
var $txt_nota;

function cls_tbl_contacto($id=0)
{ 
     
	if($id!=0)
	{
		$sql="select [|PREFIX|]contactos.pk_contacto, [|PREFIX|]contactos.fk_estado, [|PREFIX|]contactos.txt_vendedor, [|PREFIX|]contactos.txt_nombres, [|PREFIX|]contactos.txt_email, [|PREFIX|]contactos.txt_telefono, [|PREFIX|]contactos.txt_comentario, [|PREFIX|]contactos.date_fecha, [|PREFIX|]contactos.txt_anotacion, [|PREFIX|]contactos.int_estado, [|PREFIX|]contactos.txt_nota, [|PREFIX|]estado.txt_descripcion as estado, [|PREFIX|]contactos.txt_pais from [|PREFIX|]contactos LEFT JOIN [|PREFIX|]estado ON [|PREFIX|]contactos.fk_estado = [|PREFIX|]estado.pk_estado where pk_contacto = '".$id."' order by pk_contacto desc;";
		
		$fila = $GLOBALS['CONNECT_DB']->Query($sql);
		$fila = $GLOBALS['CONNECT_DB']->Fetch($fila);
		$this->setpk_contacto($fila['pk_contacto']);
		$this->settxt_nombres($fila['txt_nombres']);
		$this->settxt_email($fila['txt_email']);
		$this->settxt_telefono($fila['txt_telefono']);
		$this->settxt_pais($fila['txt_pais']);
		$this->settxt_vendedor($fila['txt_vendedor']);
		$this->settxt_nota($fila['txt_nota']);
		$this->settxt_mensaje($fila['txt_comentario']);
		$this->setdate_fecha($fila['date_fecha']);
		$this->setfk_estado($fila['fk_estado']);	
		$this->set_estado($fila['estado']);
	}else{
		$this->setpk_contacto('');
		$this->settxt_nombres('');
		$this->settxt_email('');
		$this->settxt_telefono('');
		$this->settxt_pais('');
		$this->settxt_vendedor('');
		$this->settxt_nota('');
		$this->settxt_mensaje('');
		$this->setdate_fecha('');
		$this->setfk_estado('');	
		$this->set_estado('');
	}

}

function setpk_contacto($pk_contacto){  $this->pk_contacto = $pk_contacto;}
function getpk_contacto(){  return $this->pk_contacto; }

function setfk_estado($fk_estado){  $this->fk_estado = $fk_estado;}
function getfk_estado(){  return $this->fk_estado; }

function set_estado($estado){  $this->estado = $estado;}
function get_estado(){  return $this->estado; }

function settxt_nombres($txt_nombres){  $this->txt_nombres = $txt_nombres;}
function gettxt_nombres(){  return $this->txt_nombres; }

function settxt_email($txt_email){  $this->txt_email = $txt_email;}
function gettxt_email(){  return $this->txt_email; }

function settxt_telefono($txt_telefono){  $this->txt_telefono = $txt_telefono;}
function gettxt_telefono(){  return $this->txt_telefono; }

function settxt_pais($txt_pais){  $this->txt_pais = $txt_pais;}
function gettxt_pais(){  return $this->txt_pais; }

function settxt_mensaje($txt_mensaje){  $this->txt_mensaje = $txt_mensaje;}
function gettxt_mensaje(){  return $this->txt_mensaje; }

function settxt_vendedor($txt_vendedor){  $this->txt_vendedor = $txt_vendedor;}
function gettxt_vendedor(){  return $this->txt_vendedor; }

function settxt_nota($txt_nota){  $this->txt_nota = $txt_nota;}
function gettxt_nota(){  return $this->txt_nota; }

function setdate_fecha($date_fecha){  $this->date_fecha = $date_fecha;}
function getdate_fecha(){  return $this->date_fecha; }

function IsExistReserva()
{
			$SQL = "SELECT * FROM [|PREFIX|]contactos WHERE pk_contacto='".$this->getpk_contacto()."' ";
			$QueryExist = $GLOBALS['CONNECT_DB']->Query($SQL);
			$Count = $GLOBALS['CONNECT_DB']->CountResult($QueryExist);
			if($Count==0)
			return false ;
			else
			return true ;
}
		
function elimina()
{   
	$sql = "DELETE FROM [|PREFIX|]contactos WHERE pk_contacto = '".$this->getpk_contacto()."'";
	$GLOBALS['CONNECT_DB']->Query($sql);
}

function guarda()
{   
    
	
	$array_content = array("txt_nombres"=>$this->gettxt_nombres(),
						   "txt_email"=>$this->gettxt_email(),
						   "txt_telefono"=>$this->gettxt_telefono(),
						   "txt_pais"=>$this->gettxt_pais(),
						   "txt_comentario"=>$this->gettxt_mensaje(),
						   "txt_nota"=>$this->gettxt_nota(),
						   "txt_vendedor"=>$this->gettxt_vendedor(),
						   "fk_estado"=>$this->getfk_estado(),
						   "date_fecha"=>$this->getdate_fecha()
						   );
   insert($array_content,"[|PREFIX|]contactos");
   $id = $GLOBALS['CONNECT_DB']->LastId();
   $this->setpk_contacto($id);
   
}

function actualiza()
{	
	$array_modify = array("txt_nombres"=>$this->gettxt_nombres(),
						   "txt_email"=>$this->gettxt_email(),
						   "txt_telefono"=>$this->gettxt_telefono(),
						   "txt_pais"=>$this->gettxt_pais(),
						   "txt_comentario"=>$this->gettxt_mensaje(),
						   "txt_nota"=>$this->gettxt_nota(),
						   "txt_vendedor"=>$this->gettxt_vendedor(),
						   "fk_estado"=>$this->getfk_estado(),
						   "date_fecha"=>$this->getdate_fecha()
						   );
   $array_where = array("pk_contacto"=>$this->getpk_contacto());   
   update($array_modify,"tbl_contactos",$array_where);

}


function lista($sql="")
{   
	if(!tep_not_null($sql)){
	$sql = $GLOBALS['CONNECT_DB']->Query("SELECT pk_contacto, txt_nota, fk_estado, txt_vendedor, txt_nombres, txt_email, txt_telefono, txt_comentario, date_fecha,  txt_anotacion, [|PREFIX|]contactos.int_estado,tbl_estado.pk_estado as estado, txt_pais FROM [|PREFIX|]contactos LEFT JOIN tbl_estado ON tbl_contactos.fk_estado = tbl_estado.pk_estado ORDER BY pk_contacto DESC");
	}else{
	$sql = $GLOBALS['CONNECT_DB']->Query($sql);
	}
	
	$i=0;
	while($Fetch = $GLOBALS['CONNECT_DB']->Fetch($sql))
	{
		$arreglo[$i]['pk_contacto'] = $Fetch['pk_contacto'];
		$arreglo[$i]['txt_nombres'] = $Fetch['txt_nombres'];
		$arreglo[$i]['txt_email'] = $Fetch['txt_email'];
		$arreglo[$i]['txt_pais'] = $Fetch['txt_pais'];
		$arreglo[$i]['txt_vendedor'] = $Fetch['txt_vendedor'];
		$arreglo[$i]['estado'] = $Fetch['estado'];
		$arreglo[$i]['txt_telefono'] = $Fetch['txt_telefono'];
		$arreglo[$i]['txt_comentario'] = $Fetch['txt_comentario'];
		$arreglo[$i]['date_fecha'] = $Fetch['date_fecha'];
	 $i++;
	}
	
	return $arreglo;
}





} // fin de la clase

?>