<?php

class cls_tbl_newsletter{

var $pk_newsletter; 
var $txt_nombres;
var $txt_email;
var $date_fecha ;


function cls_tbl_newsletter($id=0)
{ 
     
	if($id!=0)
	{
		$sql="select * from [|PREFIX|]newsletter where pk_newsletter = '".$id."' order by pk_newsletter desc;";
		$fila = $GLOBALS['CONNECT_DB']->Query($sql);
		$fila = $GLOBALS['CONNECT_DB']->Fetch($fila);
		$this->setpk_newsletter($fila['pk_newsletter']);
		$this->settxt_nombres($fila['txt_nombres']);
		$this->settxt_email($fila['txt_email']);
		$this->setdate_fecha($fila['date_fecha']);
	}else{
		$this->setpk_newsletter('');
		$this->settxt_nombres('');
		$this->settxt_email('');
		$this->setdate_fecha('');
	}

}

function setpk_newsletter($pk_newsletter){  $this->pk_newsletter = $pk_newsletter;}
function getpk_newsletter(){  return $this->pk_newsletter; }

function settxt_nombres($txt_nombres){  $this->txt_nombres = $txt_nombres;}
function gettxt_nombres(){  return $this->txt_nombres; }

function settxt_email($txt_email){  $this->txt_email = $txt_email;}
function gettxt_email(){  return $this->txt_email; }

function setdate_fecha($date_fecha){  $this->date_fecha = $date_fecha;}
function getdate_fecha(){  return $this->date_fecha; }


function elimina()
{   
	$sql = "DELETE FROM [|PREFIX|]newsletter WHERE pk_newsletter = '".$this->getpk_newsletter()."'";
	$GLOBALS['CONNECT_DB']->Query($sql);
}

function guarda()
{   
    
	
	$array_content = array("txt_nombres"=>$this->gettxt_nombres(),
						   "txt_email"=>$this->gettxt_email(),
						   "date_fecha"=>$this->getdate_fecha()
						   );
   insert($array_content,"[|PREFIX|]newsletter");
   $id = $GLOBALS['CONNECT_DB']->LastId();
   $this->setpk_newsletter($id);
   
}



function lista($sql="")
{   
	if(!tep_not_null($sql)){
	$sql = $GLOBALS['CONNECT_DB']->Query("select * from [|PREFIX|]newsletter order by pk_newsletter desc");
	}else{
	$sql = $GLOBALS['CONNECT_DB']->Query($sql);
	}
	
	$i=0;
	while($Fetch = $GLOBALS['CONNECT_DB']->Fetch($sql))
	{
		$arreglo[$i]['pk_newsletter'] = $Fetch['pk_newsletter'];
		$arreglo[$i]['txt_nombres'] = $Fetch['txt_nombres'];
		$arreglo[$i]['txt_email'] = $Fetch['txt_email'];	
		$arreglo[$i]['date_fecha'] = $Fetch['date_fecha'];
	 $i++;
	}
	
	return $arreglo;
}





} // fin de la clase

?>