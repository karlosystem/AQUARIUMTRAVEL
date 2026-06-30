<?php

class cls_tbl_seccion{

var $pk_seccion; 
var $txt_nombre;
var $txt_url;
var $txt_destino;
var $txt_imagen;
var $txt_orden;
var $int_estado;

function cls_tbl_seccion($id=0)
{

	if($id!=0)
	{

		$sql = $GLOBALS['CONNECT_DB']->Query("SELECT * FROM [|PREFIX|]seccion WHERE pk_seccion = '".$id."' ORDER BY pk_seccion DESC");
		$fila = $GLOBALS['CONNECT_DB']->Fetch($sql);
		$this->setpk_seccion($fila['pk_seccion']);
		$this->settxt_nombre($fila['txt_nombre']);
		$this->settxt_url($fila['txt_url']);
		$this->settxt_destino($fila['txt_destino']);
		$this->settxt_imagen($fila['txt_imagen']);
		$this->settxt_orden($fila['txt_orden']);
		$this->setint_estado($fila['int_estado']);
	}else{
		$this->setpk_seccion('');
		$this->settxt_nombre('');
		$this->settxt_url('');
		$this->settxt_destino('');
		$this->settxt_imagen('');
		$this->settxt_orden('');
		$this->setint_estado('');
	}

}

function setpk_seccion($pk_seccion){  $this->pk_seccion = $pk_seccion;}
function getpk_seccion(){  return $this->pk_seccion; }

function settxt_nombre($txt_nombre){  $this->txt_nombre = $txt_nombre;}
function gettxt_nombre(){  return $this->txt_nombre; }

function settxt_url($txt_url){  $this->txt_url = $txt_url;}
function gettxt_url(){  return $this->txt_url; }

function settxt_destino($txt_destino){  $this->txt_destino = $txt_destino;}
function gettxt_destino(){  return $this->txt_destino; }

function settxt_imagen($txt_imagen){  $this->txt_imagen = $txt_imagen;}
function gettxt_imagen(){  return $this->txt_imagen; }

function settxt_orden($txt_orden){  $this->txt_orden = $txt_orden;}
function gettxt_orden(){  return $this->txt_orden; }

function setint_estado($int_estado){  $this->int_estado = $int_estado;}
function getint_estado(){  return $this->int_estado; }


function _Remove()
{
	$sql = "DELETE FROM [|PREFIX|]seccion WHERE pk_seccion = '".$this->getpk_seccion()."'";
	$GLOBALS['CONNECT_DB']->Query($sql);
}




function _Save()
{

	$array_content = array("txt_nombre"=>$this->gettxt_nombre(),
						   "txt_url"=>$this->gettxt_url(),
						   "txt_destino"=>$this->gettxt_destino(),
						   "txt_imagen"=>$this->gettxt_imagen(),
						   "txt_orden"=>$this->gettxt_orden(),
						   "int_estado"=>$this->getint_estado()
						   );
	insert($array_content,"[|PREFIX|]seccion");
	$id = $GLOBALS['CONNECT_DB']->LastId();
    $this->setpk_seccion($id);
}

function _Update()
{

   	$array_modify = array( "txt_nombre"=>$this->gettxt_nombre(),
						   "txt_url"=>$this->gettxt_url(),
						   "txt_destino"=>$this->gettxt_destino(),
						   "txt_imagen"=>$this->gettxt_imagen(),
						   "txt_orden"=>$this->gettxt_orden(),
						   "int_estado"=>$this->getint_estado()
						   );
	$array_where = array("pk_seccion"=>$this->getpk_seccion());
	update($array_modify,"[|PREFIX|]seccion",$array_where);

}
function estado($estado)
{	$est=$estado;
	if($estado=="")
	{	$estado=($this->getint_estado()=="1")?"0":"1";}

	$sql = "UPDATE [|PREFIX|]seccion
				SET int_estado='".$estado."'
			WHERE pk_seccion = '".$this->getpk_seccion()."'";
	$GLOBALS['CONNECT_DB']->Query($sql);
	if($est=="")
	{
		$icono = "ico_estado".$estado.".gif";
		echo "<a href='javascript:UpdateStatus(".$this->getpk_seccion().")'>
 			 <img src='"._URL."admin/images/icons/".$icono."' border='0'></a>";
	}
}


function lista($sql="")
{

	if(!tep_not_null($sql)){
	$sql = $GLOBALS['CONNECT_DB']->Query("SELECT * FROM [|PREFIX|]seccion ORDER BY pk_seccion DESC");
	}else{
	$sql = $GLOBALS['CONNECT_DB']->Query($sql);
	}
	
	$i=0;
	while($Fetch = $GLOBALS['CONNECT_DB']->Fetch($sql))
	{
		$arreglo[$i]['pk_seccion'] = $Fetch['pk_seccion'];
		$arreglo[$i]['txt_nombre'] = $Fetch['txt_nombre'];
		$arreglo[$i]['txt_url'] = $Fetch['txt_url'];
		$arreglo[$i]['txt_destino'] = $Fetch['txt_destino'];
		$arreglo[$i]['txt_imagen'] = $Fetch['txt_imagen'];
		$arreglo[$i]['txt_orden'] = $Fetch['txt_orden'];
		$arreglo[$i]['int_estado'] = $Fetch['int_estado'];
	 $i++;
	}
	
	return $arreglo;
}


function IsExistSeccion(){
	$SQL = "SELECT * FROM [|PREFIX|]seccion WHERE pk_seccion='".$this->getpk_seccion()."' ";
	$QueryExist = $GLOBALS['CONNECT_DB']->Query($SQL);
	$Count = $GLOBALS['CONNECT_DB']->CountResult($QueryExist);
	if($Count==0)
	return false ;
	else
	return true ;
}


function ListSeccion($idseccion=''){
 $SQL = "SELECT * FROM [|PREFIX|]seccion ORDER BY txt_orden ASC";
 $Query = $GLOBALS['CONNECT_DB']->Query($SQL);
 $str_cmb = "";
 while($Fetch = $GLOBALS['CONNECT_DB']->Fetch($Query)){
  
  $str_cmb .= "<option value=\"{$Fetch['pk_seccion']}\" ";
  if($Fetch['pk_seccion']==(int)$idseccion)
  $str_cmb .= "selected";
  
  $str_cmb .= ">";
  $str_cmb .= $Fetch['txt_nombre'];
  $str_cmb .= "</option>";
 }
 return $str_cmb ;
}


function generatemnu_public(){
   $SQL = "SELECT pk_seccion,txt_url,txt_destino,txt_nombre FROM [|PREFIX|]seccion WHERE int_estado='1' ORDER BY txt_orden ASC";
   
   $Query = $GLOBALS['CONNECT_DB']->Query($SQL);
   $url = "";
   while($Fetch = $GLOBALS['CONNECT_DB']->Fetch($Query)){
	   $modehtml="";
	   
	   $url = $Fetch['txt_url'];
	   $nombre_g = $Fetch['txt_nombre'];
	   $destino_g =$Fetch['txt_destino'];
	    if(tep_not_null($url)){
		 if(preg_match('((http?|ftp|https)\:\/\/)', $url) || preg_match('|^www+\.|i', $url)) {
		   $modehtml = url_validate($url);
	       }else{
		   $modehtml = file_notextension($Fetch['txt_url']).'.'._FEXT;
		   $modehtml = _URL.$modehtml;
	     }
	   
	   if($destino_g==1)
	   $target = '_blank';
	    else
	   $target = '_self';
	   $title = secure_sql($nombre_g);
	   $description = secure_sql($nombre_g);
	   
	   $str_menu.= "<li>";
       $str_menu.= "<a href=\"$modehtml\" target=\"$target\" title=\"$description\">$title</a>";
       $str_menu.= "</li>";
	   
	   }
	   else{
		 $SQLCONTENT = "SELECT tbl_seccion.txt_destino, tbl_contenido_details.txt_title AS txt_nombre, tbl_contenido.pk_content, tbl_contenido_details.txt_metalink FROM tbl_contenido inner join tbl_contenido_details ON tbl_contenido.pk_content = tbl_contenido_details.fk_content Inner Join tbl_seccion ON tbl_seccion.pk_seccion = tbl_contenido.fk_seccion WHERE tbl_contenido.fk_seccion =  '".$Fetch['pk_seccion']."' AND tbl_contenido_details.language_id = '2'";

		 $Querycontent = $GLOBALS['CONNECT_DB']->Query($SQLCONTENT);
         if($GLOBALS['CONNECT_DB']->CountResult($Querycontent)>0){
         $FetchContent = $GLOBALS['CONNECT_DB']->Fetch($Querycontent);
		   $nombre_g = $FetchContent['txt_nombre'];
	       $destino_g = $FetchContent['txt_destino'];
		   $link_g = $FetchContent['txt_metalink'];
		   
	   
		   if(_SEOMOD==1){
			 	$modehtml = $safename_html = 'peru-'.safename($link_g).'-cid-'.$FetchContent['pk_content'].'.'._FEXT;
		 		$str_link .= $char_ini."<a href=\""._URL.$modehtml."\" target=\"{$destino_g}\">$nombre_g\n</a>".$char_end;
			 }else{
			 	$modehtml = _URL."contenido.php?cid=".$FetchContent['pk_content'];
		   }
		   
	   	if($destino_g==1)
	   		$target = '_blank';
	    else
	   		$target = '_self';
	   		$title = secure_sql($nombre_g);
	   		$description = secure_sql($nombre_g);	   
		    $str_menu.= "<li>";
		    $str_menu.= "<a href=\"$modehtml\" target=\"$target\" title=\"$description\">$title</a>";
		    $str_menu.= "</li>";
	   	}
		
	   }
	   
	  }
  
  return $str_menu ;  
}


} // fin de la clase

?>