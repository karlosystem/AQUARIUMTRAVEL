<?php

class cls_tbl_reservas{

var $pk_reserva; 
var $txt_nombres;
var $txt_apellidos;
var $txt_email;
var $txt_direccion;
var $pais;
var $fk_destino;
var $fk_estado;
var $estado;
var $txt_cantidad_adultos;
var $txt_cantidad_ninos;
var $txt_fecha_salida;
var $txt_fecha_retorno;
var $txt_telefono;
var $txt_celular;
var $txt_hoteles;
var $txt_ingreso;
var $txt_comentario;
var $txt_nota;
var $txt_fecha_llamar;
var $txt_vendedor;
var $txt_reserva;
var $txt_tipo;
var $txt_dateadd;


function cls_tbl_reservas($id=0)
{ 
     
	if($id!=0)
	{
		$sql="SELECT  pk_reserva, txt_name, txt_ape, txt_email, txt_direccion, pais, fk_destino, fk_estado, txt_cantidad_adultos, txt_fecha_salida, txt_fecha_retorno,txt_telefono, txt_celular, txt_ingreso,  txt_comentario, txt_fecha_llamar, txt_nota, txt_vendedor, txt_reserva, txt_tipo, date_fecha, [|PREFIX|]estado.txt_descripcion as estado, txt_cantidad_ninos, txt_hoteles FROM [|PREFIX|]reservas LEFT JOIN [|PREFIX|]estado ON [|PREFIX|]reservas.fk_estado = [|PREFIX|]estado.pk_estado WHERE pk_reserva = '".$id."' ORDER BY pk_reserva DESC";
		
		$fila = $GLOBALS['CONNECT_DB']->Query($sql);
		$fila = $GLOBALS['CONNECT_DB']->Fetch($fila);
		
		$this->setpk_reserva($fila['pk_reserva']);
		$this->settxt_reservaname($fila['txt_name']);
		$this->settxt_reservaape($fila['txt_ape']);
		$this->settxt_email($fila['txt_email']);
		$this->settxt_direccion($fila['txt_direccion']);	
		$this->settxt_hoteles($fila['txt_hoteles']);	
		$this->setpais($fila['pais']);
		$this->setfk_destino($fila['fk_destino']);	
		$this->setfk_estado($fila['fk_estado']);	
		$this->set_estado($fila['estado']);
		$this->settxt_cantidad_adultos($fila['txt_cantidad_adultos']);
		$this->settxt_cantidad_ninos($fila['txt_cantidad_ninos']);
		$this->settxt_fecha_salida($fila['txt_fecha_salida']);	
		$this->settxt_fecha_retorno($fila['txt_fecha_retorno']);			
		$this->settxt_telefono($fila['txt_telefono']);	
		$this->settxt_celular($fila['txt_celular']);	
		$this->settxt_comentario($fila['txt_comentario']);
		$this->settxt_nota($fila['txt_nota']);
		$this->settxt_fecha_llamar($fila['txt_fecha_llamar']);
		$this->settxt_vendedor($fila['txt_vendedor']);
		$this->settxt_reserva($fila['txt_reserva']);
		$this->settxt_tipo($fila['txt_tipo']);
		$this->setdate_fecha($fila['date_fecha']);
	}else{
		$this->setpk_reserva('');
		$this->settxt_reservaname('');
		$this->settxt_reservaape('');
		$this->settxt_email('');
		$this->settxt_direccion('');	
		$this->settxt_hoteles('');	
		$this->setpais('');
		$this->setfk_destino('');	
		$this->setfk_estado('');
		$this->set_estado('');
		$this->settxt_cantidad_adultos('');
		$this->settxt_cantidad_ninos('');
		$this->settxt_fecha_salida('');		
		$this->settxt_fecha_retorno('');		
		$this->settxt_telefono('');
		$this->settxt_celular('');
		$this->settxt_comentario('');
		$this->settxt_nota('');
		$this->settxt_fecha_llamar('');
		$this->settxt_vendedor('');
		$this->settxt_reserva('');
		$this->settxt_tipo('');
		$this->setdate_fecha(date("Y-m-d H:i:s"));
	}

}

function setpk_reserva($pk_reserva){  $this->pk_reserva = $pk_reserva;}
function getpk_reserva(){  return $this->pk_reserva; }

function settxt_reservaname($txt_nombres){  $this->txt_nombres = $txt_nombres;}
function gettxt_reservaname(){  return $this->txt_nombres; }

function settxt_reservaape($txt_apellidos){  $this->txt_apellidos = $txt_apellidos;}
function gettxt_reservaape(){  return $this->txt_apellidos; }

function settxt_email($txt_email){  $this->txt_email = $txt_email;}
function gettxt_email(){  return $this->txt_email; }

function setpais($pais){  $this->pais = $pais;}
function getpais(){  return $this->pais; }

function setfk_destino($fk_destino){  $this->fk_destino = $fk_destino;}
function getfk_destino(){  return $this->fk_destino; }

function setfk_estado($fk_estado){  $this->fk_estado = $fk_estado;}
function getfk_estado(){  return $this->fk_estado; }

function set_estado($estado){  $this->estado = $estado;}
function get_estado(){  return $this->estado; }

function settxt_direccion($txt_direccion){  $this->txt_direccion = $txt_direccion;}
function gettxt_direccion(){  return $this->txt_direccion; }

function settxt_hoteles($txt_hoteles){  $this->txt_hoteles = $txt_hoteles;}
function gettxt_hoteles(){  return $this->txt_hoteles; }

function settxt_cantidad_adultos($txt_cantidad_adultos){  $this->txt_cantidad_adultos = $txt_cantidad_adultos;}
function gettxt_cantidad_adultos(){  return $this->txt_cantidad_adultos; }

function settxt_cantidad_ninos($txt_cantidad_ninos){  $this->txt_cantidad_ninos = $txt_cantidad_ninos;}
function gettxt_cantidad_ninos(){  return $this->txt_cantidad_ninos; }

function settxt_fecha_salida($txt_fecha_salida){  $this->txt_fecha_salida = $txt_fecha_salida;}
function gettxt_fecha_salida(){  return $this->txt_fecha_salida; }

function settxt_fecha_retorno($txt_fecha_retorno){  $this->txt_fecha_retorno = $txt_fecha_retorno;}
function gettxt_fecha_retorno(){  return $this->txt_fecha_retorno; }

function settxt_telefono($txt_telefono){  $this->txt_telefono = $txt_telefono;}
function gettxt_telefono(){  return $this->txt_telefono; }

function settxt_celular($txt_celular){  $this->txt_celular = $txt_celular;}
function gettxt_celular(){  return $this->txt_celular; }

function settxt_comentario($txt_comentario){  $this->txt_comentario = $txt_comentario;}
function gettxt_comentario(){  return $this->txt_comentario; }

function settxt_nota($txt_nota){  $this->txt_nota = $txt_nota;}
function gettxt_nota(){  return $this->txt_nota; }

function settxt_fecha_llamar($txt_fecha_llamar){  $this->txt_fecha_llamar = $txt_fecha_llamar;}
function gettxt_fecha_llamar(){  return $this->txt_fecha_llamar; }

function settxt_vendedor($txt_vendedor){  $this->txt_vendedor = $txt_vendedor;}
function gettxt_vendedor(){  return $this->txt_vendedor; }

function settxt_reserva($txt_reserva){  $this->txt_reserva = $txt_reserva;}
function gettxt_reserva(){  return $this->txt_reserva; }

function settxt_tipo($txt_tipo){  $this->txt_tipo = $txt_tipo;}
function gettxt_tipo(){  return $this->txt_tipo; }

function setdate_fecha($txt_dateadd){  $this->txt_dateadd = $txt_dateadd;}
function getdate_fecha(){  return $this->txt_dateadd; }


function elimina()
{   
	$sql = "DELETE FROM tbl_reservas WHERE pk_reserva = '".$this->getpk_reserva()."'";
	$GLOBALS['CONNECT_DB']->Query($sql);
}

function actualiza()
{	
	$array_modify = array("txt_name"=>$this->gettxt_reservaname(),
						  "txt_ape"=>$this->gettxt_reservaape(),
					      "txt_email"=>$this->gettxt_email(),
						  "pais"=>$this->getpais(),
						  "txt_cantidad_adultos"=>$this->gettxt_cantidad_adultos(),
					  	  "txt_cantidad_ninos"=>$this->gettxt_cantidad_ninos(),
						  "txt_telefono"=>$this->gettxt_telefono(),
						  "txt_celular"=>$this->gettxt_celular(),
						  "txt_direccion"=>$this->gettxt_direccion(),
						  "txt_fecha_salida"=>$this->gettxt_fecha_salida(),
					   	  "txt_fecha_retorno"=>$this->gettxt_fecha_retorno(),
						  "txt_comentario"=>$this->gettxt_comentario(),
						  "fk_destino"=>$this->getfk_destino(),
						  "txt_fecha_llamar"=>$this->gettxt_fecha_llamar(),
						  "txt_nota"=>$this->gettxt_nota(),
						  "txt_vendedor"=>$this->gettxt_vendedor(),
						  "txt_hoteles"=>$this->gettxt_hoteles(),
						  "txt_reserva"=>$this->gettxt_reserva(),
						  "txt_tipo"=>$this->gettxt_tipo(),
						  "fk_estado"=>$this->getfk_estado(),
						  "date_fecha"=>$this->getdate_fecha()						  	                    
						  );
   $array_where = array("pk_reserva"=>$this->getpk_reserva());
   
   update($array_modify,"tbl_reservas",$array_where);

}


function guarda()
{   
    
$array_content = array("txt_name"=>$this->gettxt_reservaname(),
	                   "txt_ape"=>$this->gettxt_reservaape(),
					   "txt_email"=>$this->gettxt_email(),
					   "txt_direccion"=>$this->gettxt_direccion(),
					   "pais"=>$this->getpais(),
					   "fk_destino"=>$this->getfk_destino(),
					   "fk_estado"=>$this->getfk_estado(),
					   "txt_telefono"=>$this->gettxt_telefono(),
					   "txt_celular"=>$this->gettxt_celular(),
					   "txt_cantidad_adultos"=>$this->gettxt_cantidad_adultos(),
					   "txt_cantidad_ninos"=>$this->gettxt_cantidad_ninos(),
					   "txt_fecha_salida"=>$this->gettxt_fecha_salida(),
					   "txt_fecha_retorno"=>$this->gettxt_fecha_retorno(),
					   "txt_comentario"=>$this->gettxt_comentario(),
					   "txt_nota"=>$this->gettxt_nota(),
					   "txt_vendedor"=>$this->gettxt_vendedor(),
					   "txt_hoteles"=>$this->gettxt_hoteles(),
					   "txt_reserva"=>$this->gettxt_reserva(),
					   "txt_tipo"=>$this->gettxt_tipo(),
					   "txt_fecha_llamar"=>$this->gettxt_fecha_llamar(),
					   "date_fecha"=>$this->getdate_fecha()
					   );
   insert($array_content,"tbl_reservas") or die(mysql_error());
   $id = $GLOBALS['CONNECT_DB']->LastId();
   $this->setpk_reserva($id);
   
}


function IsExistReserva(){
			$SQL = "SELECT * FROM tbl_reservas WHERE pk_reserva='".$this->getpk_reserva()."' ";
			$QueryExist = $GLOBALS['CONNECT_DB']->Query($SQL);
			$Count = $GLOBALS['CONNECT_DB']->CountResult($QueryExist);
			if($Count==0)
			return false ;
			else
			return true ;
		}

function lista($sql="")
{   
	/*if(!tep_not_null($sql)){
	$sql = $GLOBALS['CONNECT_DB']->Query("SELECT pk_reserva, txt_name, txt_ape, txt_email, txt_direccion, pais, fk_destino, txt_telefono, txt_celular, txt_cantidad_adultos, txt_fecha_salida, txt_fecha_retorno, txt_ingreso, txt_comentario, txt_reserva, date_fecha, tbl_paquete_details.txt_title as paquete, txt_cantidad_ninos, pais, tbl_estado.pk_estado as estado, txt_vendedor, txt_tipo, txt_hoteles FROM tbl_reservas 
	LEFT JOIN tbl_paquete_details ON tbl_reservas.fk_destino = tbl_paquete_details.fk_paquete 
	LEFT JOIN tbl_estado ON tbl_reservas.fk_estado = tbl_estado.pk_estado
	ORDER BY pk_reserva DESC");*/

	if(!tep_not_null($sql)){
	$sql = $GLOBALS['CONNECT_DB']->Query("select pk_reserva, LOWER(txt_name) as txt_name, 
	LOWER(txt_ape) as txt_ape, 
	LOWER(txt_email) as txt_email, 
	txt_direccion, 
	pais,
	txt_telefono, txt_fecha_salida, 
	txt_ingreso, 
	txt_comentario, date_fecha, 
	tbl_paquete_details.txt_title as paquete, 
	txt_cantidad_adultos, pais, 
	tbl_estado.pk_estado as estado, 
	txt_vendedor, txt_tipo, 
       (select count(*) from tbl_reservas c2 where (c2.fk_destino = c.fk_destino and c2.pk_reserva <= c.pk_reserva)) as counter
from tbl_reservas c 
	LEFT JOIN tbl_paquete_details ON c.fk_destino = tbl_paquete_details.fk_paquete 
	LEFT JOIN tbl_estado ON c.fk_estado = tbl_estado.pk_estado
	where (year(c.date_fecha) in (2019)) and c.fk_destino IN (SELECT fk_paquete FROM tbl_paquete_details)
ORDER BY c.pk_reserva DESC");

	}else{
	$sql = $GLOBALS['CONNECT_DB']->Query($sql);
	}
	
	$i=0;
	while($Fetch = $GLOBALS['CONNECT_DB']->Fetch($sql))
	{
		$arreglo[$i]['pk_reserva'] = $Fetch['pk_reserva'];
		$arreglo[$i]['txt_name'] = $Fetch['txt_name'];
		$arreglo[$i]['txt_ape'] = $Fetch['txt_ape'];
		$arreglo[$i]['txt_email'] = $Fetch['txt_email'];
		$arreglo[$i]['pais'] = $Fetch['pais'];
		$arreglo[$i]['txt_direccion'] = $Fetch['txt_direccion'];
		$arreglo[$i]['paquete'] = $Fetch['paquete'];
		$arreglo[$i]['estado'] = $Fetch['estado'];
		$arreglo[$i]['txt_telefono'] = $Fetch['txt_telefono'];
		$arreglo[$i]['txt_celular'] = $Fetch['txt_celular'];
		$arreglo[$i]['txt_cantidad_adultos'] = $Fetch['txt_cantidad_adultos'];
		$arreglo[$i]['txt_cantidad_ninos'] = $Fetch['txt_cantidad_ninos'];
		$arreglo[$i]['txt_fecha_salida'] = $Fetch['txt_fecha_salida'];
		$arreglo[$i]['txt_comentario'] = $Fetch['txt_comentario'];
		$arreglo[$i]['txt_nota'] = $Fetch['txt_nota'];
		$arreglo[$i]['txt_reserva'] = $Fetch['txt_reserva'];
		$arreglo[$i]['txt_hoteles'] = $Fetch['txt_hoteles'];
		$arreglo[$i]['txt_vendedor'] = $Fetch['txt_vendedor'];
		$arreglo[$i]['txt_tipo'] = $Fetch['txt_tipo'];
		$arreglo[$i]['date_fecha'] = $Fetch['date_fecha'];
		$arreglo[$i]['counter'] = $Fetch['counter'];
	 $i++;
	}
	
	return $arreglo;
}

} // fin de la clase

?>