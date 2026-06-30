<?php

class cls_tbl_contenido{

var $pk_contenido; 
var $fk_seccion;
var $txt_imagen;
var $txt_dateadd;
var $int_estado;
var $int_order;

var $inst_txttitle = "get_titlepage";
var $inst_txt_content = "get_contentpage";

var $inst_metatxttitle = "get_metatitlepage";
var $inst_metatxtdescription = "get_metadescriptionpage";
var $inst_metatxtlink = "get_metalinkpage";

function cls_tbl_contenido($id=0)
{

	if($id!=0)
	{
		$sql=$GLOBALS['CONNECT_DB']->Query("SELECT * FROM [|PREFIX|]contenido WHERE pk_content = '".$id."' ORDER BY pk_content DESC");
		$fila = $GLOBALS['CONNECT_DB']->Fetch($sql);
		$this->setpk_contenido($fila['pk_content']);
		$this->setfk_seccion($fila['fk_seccion']);
		$this->settxt_imagen($fila['txt_imagen']);
		$this->settxt_dateadd($fila['txt_dateadd']);
		$this->setint_estado($fila['int_estado']);
		$this->setint_order($fila['txt_orden']);
	}else{
		$this->setpk_contenido('');
		$this->setfk_seccion('');
		$this->settxt_imagen('');
		$this->settxt_dateadd('');
		$this->setint_estado('');
		$this->setint_order('');
	}
}

function setpk_contenido($pk_contenido){  $this->pk_contenido = $pk_contenido;}
function getpk_contenido(){  return $this->pk_contenido; }

function setfk_seccion($fk_seccion){  $this->fk_seccion = $fk_seccion;}
function getfk_seccion(){  return $this->fk_seccion; }

function settxt_imagen($txt_imagen){  $this->txt_imagen = $txt_imagen;}
function gettxt_imagen(){  return $this->txt_imagen; }

function settxt_dateadd($txt_dateadd){  $this->txt_dateadd = $txt_dateadd;}
function gettxt_dateadd(){  return $this->txt_dateadd; }

function setint_estado($int_estado){  $this->int_estado = $int_estado;}
function getint_estado(){  return $this->int_estado; }

function setint_order($int_order){  $this->int_order = $int_order;}
function getint_order(){  return $this->int_order; }


function title_contentpage (){
 if(tep_not_null($this->getpk_contenido()) && validar_numero($this->getpk_contenido()) && $this->getpk_contenido()>0){ 
  $SQL = "SELECT txt_titulo FROM [|PREFIX|]contenido WHERE pk_content='".$this->getpk_contenido()."' ";
  $Query = $GLOBALS['CONNECT_DB']->Query($SQL) ;
   if($GLOBALS['CONNECT_DB']->CountResult($Query)==1){
    $Fetch = $GLOBALS['CONNECT_DB']->Fetch($Query);
	return utf8_encode($Fetch['txt_titulo']).TITLE_ADD;
   }else{
    return "No se ha encontrado el contenido .";
   }
  
  
 }
}

function _Remove()
{
	
	$file_temp=$this->gettxt_imagen();	
	deleteFiles(ADMIN_IMG_PAGE,$file_temp);
	
	$GLOBALS['CONNECT_DB']->Query("DELETE FROM [|PREFIX|]contenido_details WHERE  fk_content = '".$this->getpk_contenido()."'");
	$GLOBALS['CONNECT_DB']->Query("DELETE FROM [|PREFIX|]contenido WHERE  pk_content = '".$this->getpk_contenido()."'");
}

function _Save()
{
	
	$array_content = array("txt_imagen"=>$this->gettxt_imagen(),
						   "txt_dateadd"=>$this->gettxt_dateadd(),
						   "int_estado"=>$this->getint_estado(),
						   "fk_seccion"=>$this->getfk_seccion(),
						   "txt_orden"=>$this->getint_order()
						   );
	insert($array_content,"[|PREFIX|]contenido")or die(mysql_error());
	$id = $GLOBALS['CONNECT_DB']->LastId();
    $this->setpk_contenido($id);

}

function _Update()
{	
	$array_modify = array("txt_imagen" => $this->gettxt_imagen(),
				          "txt_dateadd" => $this->gettxt_dateadd(),
						  "fk_seccion"=>$this->getfk_seccion(),
					      "int_estado" => $this->getint_estado(),
					      "txt_orden"=>$this->getint_order()
					     );
   $array_where = array("pk_content"=>$this->getpk_contenido());
   
   update($array_modify,"[|PREFIX|]contenido",$array_where);

}



function _SaveUpdate_PageLang($IsMode='Create'){
		  $languages = language::tep_get_languages();
		   for ($i=0, $n=sizeof($languages); $i<$n; $i++) {
			 $page_id = $this->getpk_contenido();
			 $language_id = $languages[$i]['id'];
			 
			 $name_page = secure_sql($_POST[$this->inst_txttitle][$language_id]);
			 $description_page = secure_sql($_POST[$this->inst_txt_content][$language_id]);
			 $metatitle_page = secure_sql($_POST[$this->inst_metatxttitle][$language_id]);
			 $metadescription_page = secure_sql($_POST[$this->inst_metatxtdescription][$language_id]);
			 $metalink_page = secure_sql($_POST[$this->inst_metatxtlink][$language_id]);
		     
			 $sql_data_array = array('fk_content' => $page_id,
				                     'language_id' => $language_id ,
				                     'txt_title' => $name_page,
									 'txt_details' => $description_page,
									 'txt_metatitle' => $metatitle_page,
									 'txt_metadescription' => $metadescription_page,
									 'txt_metalink' => $metalink_page
		                             );
			if($IsMode=='Update'){
				$arr_where = array("fk_content"=>$this->getpk_contenido(),
								   "language_id"=>$language_id
								   );
				
				$Query_exists = $GLOBALS['CONNECT_DB']->Query("SELECT * FROM [|PREFIX|]contenido_details WHERE fk_content ='".$page_id."' AND language_id='".(int)$language_id."'");
				
				if($GLOBALS['CONNECT_DB']->CountResult($Query_exists)==1)
				 update($sql_data_array,"[|PREFIX|]contenido_details",$arr_where);
				else
				insert($sql_data_array,"[|PREFIX|]contenido_details");
				
		    }else if($IsMode='Create'){
			    insert($sql_data_array,"[|PREFIX|]contenido_details");
			}
			
		   }

}
	   

function get_infolang_page($language_id = ''){

	$sql = "SELECT txt_title, txt_details, txt_metatitle, txt_metadescription, txt_metalink FROM [|PREFIX|]contenido_details ";
	$sql .= "WHERE fk_content ='".$this->getpk_contenido()."' AND language_id='".(int)$language_id."' ";
	
	$article_query = $GLOBALS['CONNECT_DB']->Query($sql);
	
	while($FetchInfo = $GLOBALS['CONNECT_DB']->Fetch($article_query)){

	$get_data_array[] = array('title' => $FetchInfo['txt_title'],
							  'details' => $FetchInfo['txt_details'],
							  'metatitle' => $FetchInfo['txt_metatitle'],
							  'metadescription' => $FetchInfo['txt_metadescription'],
							  'metalink' => $FetchInfo['txt_metalink']
							   );
	}
    return  $get_data_array ;
}

function estado($estado)
{	$est=$estado;
	if($estado=="")
	{	$estado=($this->getint_estado()=="1")?"0":"1";}

	$sql = "UPDATE [|PREFIX|]contenido
				SET int_estado='".$estado."'
			WHERE pk_content = '".$this->getpk_contenido()."'";
	$GLOBALS['CONNECT_DB']->Query($sql);
	if($est=="")
	{
		$icono = "ico_estado".$estado.".gif";
		echo "<a href='javascript:UpdateStatus(".$this->getpk_contenido().")'>
 			  <img src='"._URL."admin/images/icons/".$icono."' border='0'></a>";
	}
}

function IsExistContent(){
$SQL = "SELECT * FROM [|PREFIX|]contenido WHERE pk_content='".$this->getpk_contenido()."' ";
$QueryExist = $GLOBALS['CONNECT_DB']->Query($SQL);
$Count = $GLOBALS['CONNECT_DB']->CountResult($QueryExist);
if($Count==0)
return false ;
else
return true ;
}


function lista($sql="")
{
	if(!tep_not_null($sql)){
	$sql = $GLOBALS['CONNECT_DB']->Query("SELECT * FROM [|PREFIX|]contenido ORDER BY pk_content DESC");
	}else{
	$sql = $GLOBALS['CONNECT_DB']->Query($sql);
	}
	
	$i=0;
	while($Fetch = $GLOBALS['CONNECT_DB']->Fetch($sql))
	{
		$arreglo[$i]['pk_content'] = $Fetch['pk_content'];
		$arreglo[$i]['fk_seccion'] = $Fetch['fk_seccion'];
		$arreglo[$i]['txt_imagen'] = $Fetch['txt_imagen'];
		$arreglo[$i]['txt_dateadd'] = $Fetch['txt_dateadd'];
		$arreglo[$i]['int_estado'] = $Fetch['int_estado'];
		$arreglo[$i]['txt_orden'] = $Fetch['txt_orden'];
	 $i++;
	}
	return $arreglo;
}

function get_page_detail($page_id, $language_id = 0) {
    global $languages_id;

    if ($language_id == 0) $language_id = $languages_id;
    $page_query = "SELECT txt_title,txt_details, txt_metatitle, txt_metadescription, txt_metalink FROM [|PREFIX|]contenido_details WHERE";
	$page_query .= " fk_content = '" . (int)$page_id . "' and language_id = '" . (int)$language_id . "'" ;
	
	$Query = $GLOBALS['CONNECT_DB']->Query($page_query);
	
	while ($FetchPage = $GLOBALS['CONNECT_DB']->Fetch($Query)){
    $getpage[] = array('page_txt_title'=>$FetchPage['txt_title'],
	                   'page_txt_content'=>$FetchPage['txt_details'],
					   'page_txt_metatitle'=>$FetchPage['txt_metatitle'],
					   'page_txt_metadescription'=>$FetchPage['txt_metadescription'],
					   'page_txt_metalink'=>$FetchPage['txt_metalink']
	                   );
	}			    
    return $getpage;
  }
} // fin de la clase

?>