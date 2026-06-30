<?php

class cls_tbl_categoria{

var $pk_categoria; 
var $fk_categoria;
var $txt_nivel;
var $txt_nombre;
var $txt_descripcion;
var $txt_meta;
var $txt_metatitle;
var $txt_imagen;
var $int_estado;
var $int_orden;
var $int_tipo;
var $txt_dateadd;
var $txt_linkexterno;

function cls_tbl_categoria($id=0,$arr_where='')
{

	if($id!=0)
	{  
		
		$sql=$GLOBALS['CONNECT_DB']->Query("SELECT  pk_categoria,  fk_categoria,  int_tipo,  txt_nombre,  txt_descripcion,  txt_meta,  txt_metatitle, txt_imagen,  int_estado,  int_orden, txt_dateadd, txt_linkexterno, fk_languages FROM [|PREFIX|]categoria where pk_categoria = '".$id."' $arr_where order by pk_categoria desc;");
		
		$fila = $GLOBALS['CONNECT_DB']->Fetch($sql);
		$this->setpk_categoria($fila['pk_categoria']);
		$this->setfk_categoria($fila['fk_categoria']);
		$this->settxt_nombre($fila['txt_nombre']);
		$this->settxt_descripcion($fila['txt_descripcion']);
		$this->settxt_meta($fila['txt_meta']);
		$this->settxt_metatitle($fila['txt_metatitle']);
		$this->settxt_imagen($fila['txt_imagen']);
		$this->setint_estado($fila['int_estado']);
		$this->setint_orden($fila['int_orden']);
		$this->setint_tipo($fila['int_tipo']);
		$this->settxt_dateadd($fila['txt_dateadd']);
		$this->settxt_linkexterno($fila['txt_linkexterno']);
	}else{
		$this->setpk_categoria('');
		$this->setfk_categoria('');
		$this->settxt_nombre('');
		$this->settxt_descripcion('');
		$this->settxt_meta('');
		$this->settxt_metatitle('');
		$this->settxt_imagen('');
		$this->setint_estado('');
		$this->setint_orden('');
		$this->setint_tipo('');
		$this->settxt_dateadd('');
		$this->settxt_linkexterno('');
	}

}

function setpk_categoria($pk_categoria){  $this->pk_categoria = $pk_categoria;}
function getpk_categoria(){  return $this->pk_categoria; }

function setfk_categoria($fk_categoria){  $this->fk_categoria = $fk_categoria;}
function getfk_categoria(){  return $this->fk_categoria; }

function settxt_nombre($txt_nombre){  $this->txt_nombre = $txt_nombre;}
function gettxt_nombre(){  return $this->txt_nombre; }

function settxt_descripcion($txt_descripcion){  $this->txt_descripcion = $txt_descripcion;}
function gettxt_descripcion(){  return $this->txt_descripcion; }

function settxt_meta($txt_meta){  $this->txt_meta = $txt_meta;}
function gettxt_meta(){  return $this->txt_meta; }

function settxt_metatitle($txt_metatitle){  $this->txt_metatitle = $txt_metatitle;}
function gettxt_metatitle(){  return $this->txt_metatitle; }

function settxt_imagen($txt_imagen){  $this->txt_imagen = $txt_imagen;}
function gettxt_imagen(){  return $this->txt_imagen; }

function setint_estado($int_estado){  $this->int_estado = $int_estado;}
function getint_estado(){  return $this->int_estado; }

function setint_orden($int_orden){  $this->int_orden = $int_orden;}
function getint_orden(){  return $this->int_orden; }

function setint_tipo($int_tipo){  $this->int_tipo = $int_tipo;}
function getint_tipo(){  return $this->int_tipo; }

function settxt_dateadd($txt_dateadd){  $this->txt_dateadd = $txt_dateadd;}
function gettxt_dateadd(){  return $this->txt_dateadd; }

function settxt_linkexterno($txt_linkexterno){  $this->txt_linkexterno = $txt_linkexterno;}
function gettxt_linkexterno(){  return $this->txt_linkexterno; }



	   function _Remove(){
	   
	    $lCatFatherId = $this->getpk_categoria();
		$ltmpChilds = $this->getCategoryChildren($this->getpk_categoria());
		
		if ($ltmpChilds)
		{
			$lAddOnQueryCat.=" AND pk_categoria IN (". $ltmpChilds . ",". $this->getpk_categoria() .")"; #EXCLUSIVO PARA LAS CATEGORIAS
		}
		else
		{
			$lAddOnQueryCat.=" AND pk_categoria=". $this->getpk_categoria(); #EXCLUSIVO PARA LAS CATEGORIAS
		}
		
			#Removemos las categorias + los parents
			$lSql_1 = "DELETE FROM  [|PREFIX|]categoria WHERE 1<2 $lAddOnQueryCat";
			$res_select = $GLOBALS['CONNECT_DB']->Query($lSql_1);

	   }
	   
	   


function _Save()
{

	$array_new = array("fk_categoria"=>$this->getfk_categoria(),
						   "txt_nombre"=>$this->gettxt_nombre(),
						   "txt_descripcion"=>$this->gettxt_descripcion(),
						   "txt_meta"=>$this->gettxt_meta(),
						   "txt_metatitle"=>$this->gettxt_metatitle(),
						   "txt_imagen"=>$this->gettxt_imagen(),
						   "int_estado"=>$this->getint_estado(),
						   "int_orden"=>$this->getint_orden(),
						   "int_tipo"=>$this->getint_tipo(),
						   "txt_dateadd"=>$this->gettxt_dateadd(),
						   "txt_linkexterno"=>$this->gettxt_linkexterno()
						   );
	insert($array_new,"[|PREFIX|]categoria");
	$id = $GLOBALS['CONNECT_DB']->LastId();
    $this->setpk_categoria($id);
} 
    
function _Update()
{   
    $array_update = array("fk_categoria"=>$this->getfk_categoria(),
						  "txt_nombre"=>$this->gettxt_nombre(),
						  "txt_descripcion"=>$this->gettxt_descripcion(),
						  "txt_meta"=>$this->gettxt_meta(),
						  "txt_metatitle"=>$this->gettxt_metatitle(),
						  "txt_imagen"=>$this->gettxt_imagen(),
						  "int_estado"=>$this->getint_estado(),
						  "int_orden"=>$this->getint_orden(),
						  "int_tipo"=>$this->getint_tipo(),
						  "txt_dateadd"=>$this->gettxt_dateadd(),
						  "txt_linkexterno"=>$this->gettxt_linkexterno()
						  );
    $array_where = array("pk_categoria"=>$this->getpk_categoria()
	                     );
	update($array_update,"[|PREFIX|]categoria",$array_where);
}

function estado($estado)
{	
    
    $est=$estado;
	if($estado=="")
	{	$estado=($this->getint_estado()=="1")?"0":"1";}

	$sql = "UPDATE [|PREFIX|]categoria
				SET int_estado='".$estado."'
			WHERE pk_categoria = '".$this->getpk_categoria()."'";
	$GLOBALS['CONNECT_DB']->Query($sql);
	if($est=="")
	{
		$icono = "ico_estado".$estado.".gif";
        print "<a href='javascript:UpdateStatus(".$this->getpk_categoria().")'>";
		print "<img src='"._URL.FOLDER_ADMIN."/images/icons/".$icono."' border='0'>";
		print "</a>";
	}
}


function getCategory_Mnu($act_id='',$set='0')
{   
    
	$sql = "SELECT pk_categoria,txt_nombre,fk_categoria";
	$sql .= " from [|PREFIX|]categoria WHERE fk_categoria=0 order by txt_nombre ASC";
	
	$lRes = $GLOBALS['CONNECT_DB']->Query($sql) ; 
	while ($row_act = $GLOBALS['CONNECT_DB']->Fetch($lRes))
	{
		$string.="<option value='{$row_act['pk_categoria']}'";
		if (is_array($act_id))
		{
			if (in_array($row_act['pk_categoria'],$act_id))
				$string.=" selected";
		}	
		elseif ($act_id==$row_act['pk_categoria'])
			$string.=" selected";
		$lActTitle="";
		if (!$lActTitle){
		$lActTitle = $row_act["txt_nombre"]; // Last resort, use original name..
		}
		$string .= ">" .$lActTitle . "";
		$string .= "</option>";
		$string .= $this->untree_Category($row_act['pk_categoria'], 1,$act_id,$set);
	}
	
	return $string;
}



## --> Domingo 11 de Enero del 2009
function untree_Category($parent, $level,$catid='')
{
	$parentsql = $GLOBALS['CONNECT_DB']->Query("SELECT pk_categoria,txt_nombre FROM [|PREFIX|]categoria WHERE fk_categoria=$parent ORDER BY txt_nombre ASC");
	
	$return="";
	if (!$GLOBALS['CONNECT_DB']->CountResult($parentsql))
	{
		return;
	}
	else
	{
		while($branch = $GLOBALS['CONNECT_DB']->Fetch($parentsql))
		{
			$echo_this = "<option value='{$branch['pk_categoria']}'";
			
			if (is_array($catid))
			{
				if (in_array($branch['pk_categoria'],$catid))
					$echo_this.=" selected";
			}		
			elseif ($catid==$branch['pk_categoria'])
			$echo_this.=" selected";
			
			$echo_this.=">";
			
			for ($x=1; $x<=$level; $x++)
				$echo_this .=  "&nbsp;&nbsp;&nbsp;";
			$lActTitle="";
		  	// Check if user selected category exists
			// User has not set any prefered language..
			if (!$lActTitle)	
			{
		  	$lActTitle = $branch["txt_nombre"]; // Last resort, use original name..
			}
			
			$echo_this.=$lActTitle;

			$echo_this.="</option>";
			$return.=$echo_this;
			$rename_level = $level;
			$return .= $this->untree_Category($branch['act_id'], ++$rename_level,$act_id);
			
		}
	}
	
	return $return;
}

function lista($sql="")
{   
	if($sql==""){
		$sql=$GLOBALS['CONNECT_DB']->Query("SELECT * FROM [|PREFIX|]categoria ORDER BY int_orden ASC");
	}else{
	$sql=$GLOBALS['CONNECT_DB']->Query($sql);
	}
	
	$i=1;
	while($Fetch = $GLOBALS['CONNECT_DB']->Fetch($sql))
	{
		$arreglo[$i]['pk_categoria'] = $Fetch['pk_categoria'];
		$arreglo[$i]['fk_categoria'] = $Fetch['fk_categoria'];
		$arreglo[$i]['txt_nombre'] = $Fetch['txt_nombre'];
		$arreglo[$i]['txt_descripcion'] = $Fetch['txt_descripcion'];
		$arreglo[$i]['txt_meta'] = $Fetch['txt_meta'];		
		$arreglo[$i]['txt_imagen'] = $Fetch['txt_imagen'];
		$arreglo[$i]['int_estado'] = $Fetch['int_estado'];
		$arreglo[$i]['int_orden'] = $Fetch['int_orden'];
		$arreglo[$i]['int_tipo'] = $Fetch['int_tipo'];
		$arreglo[$i]['txt_dateadd'] = $Fetch['txt_dateadd'];
		$arreglo[$i]['txt_linkexterno'] = $Fetch['txt_linkexterno'];
	 $i++;
	}
	
	return $arreglo;
}

  
function get_nivel_detalles($pak_id, $language_id = 0) {
    global $languages_id;

    if ($language_id == 0) $language_id = $languages_id;
    $nivel_query = "SELECT pk_nivel, txt_descripcion, int_estado, language_id FROM ";
	$nivel_query .= "[|PREFIX|]nivel WHERE";
	$nivel_query .= " pk_nivel = '" . (int)$pak_id . "' and language_id = '" . (int)$language_id . "' " ;

	$Query = $GLOBALS['CONNECT_DB']->Query($nivel_query) or die(mysql_error());
	
	while ($FetchNivel = $GLOBALS['CONNECT_DB']->Fetch($Query)){
    $getnivel[] = array('txt_descripcion' => $FetchNivel['txt_descripcion'],
						 'pk_nivel' => $FetchCategoria['pk_nivel'],
						 'int_estado' => $FetchCategoria['int_estado'],
						 'language_id' => $FetchCategoria['language_id']							  
						 );
	}					    
    return $getnivel;
  }
    

function get_categoria_detalles($pak_id, $language_id = 0) {
    global $languages_id;

    if ($language_id == 0) $language_id = $languages_id;
    $categoria_query = "SELECT * FROM ";
	$categoria_query .= "[|PREFIX|]categoria WHERE";
	$categoria_query .= " pk_categoria = '" . (int)$pak_id . "' and fk_languages = '" . (int)$language_id . "' " ;

	$Query = $GLOBALS['CONNECT_DB']->Query($categoria_query) or die(mysql_error());
	
	while ($FetchCategoria = $GLOBALS['CONNECT_DB']->Fetch($Query)){
    $getcategoria[] = array('txt_nombre' => $FetchCategoria['txt_nombre'],
						 'pk_categoria' => $FetchCategoria['pk_categoria'],
						 'int_estado' => $FetchCategoria['int_estado'],
						 'fk_languages' => $FetchCategoria['fk_languages']							  
						 );
	}					    
    return $getcategoria;
  }
  	
  
function IsExistCategory(){
	$SQL = "SELECT * FROM [|PREFIX|]categoria WHERE pk_categoria='".$this->getpk_categoria()."' ";
	$QueryExist = $GLOBALS['CONNECT_DB']->Query($SQL);
	$Count = $GLOBALS['CONNECT_DB']->CountResult($QueryExist);
	if($Count==0)
	return false ;
	else
	return true ;
}


function IsURLMOD(){
$SQL = "SELECT pk_categoria,txt_nombre FROM  [|PREFIX|]categoria WHERE pk_categoria='".$this->getpk_categoria()."' ";
$SQL .= " AND int_estado='1'";

$lRes = $GLOBALS['CONNECT_DB']->Query($SQL);
$Count = $GLOBALS['CONNECT_DB']->CountResult($lRes);
 if($Count==1){
  $Fetch = $GLOBALS['CONNECT_DB']->Fetch($lRes);
  $strmod = safename($Fetch['txt_nombre']);
  $strmod = _URL."category/$strmod-cid-{$Fetch['pk_categoria']}";
  return $strmod;
 }
 return false;
}


function build_child($oldID){
	$child_query = $GLOBALS['CONNECT_DB']->Query("SELECT * FROM [|PREFIX|]categoria WHERE pk_categoria=" . $oldID);
	while ( $child = $GLOBALS['CONNECT_DB']->Fetch($child_query) )
	{
		if ( $child['pk_categoria'] != $child['fk_categoria'] )
		{
			if($child['fk_categoria']==0) {
			return $child['cat_id'];
			}
			$tempTree = $this->build_child($child['fk_categoria']);		// Add to the temporary local tree
		}
	}
	return $tempTree;
}


function ParentAbsolute($CCategory) {
	$nav_query = $GLOBALS['CONNECT_DB']->Query("SELECT * FROM [|PREFIX|]categoria WHERE pk_categoria='".(int)$CCategory."' ORDER BY int_orden ASC");
	$tree = "";	
	while ( $nav_row = $GLOBALS['CONNECT_DB']->Fetch($nav_query) )
	{
			$tree = $this->build_child($nav_row['pk_categoria']);		// Start the recursive function of building the child tree
	}
	return $tree ;
}


	 function getCategoryChildren($IsCategory=0){
				
	 $parentsql = $GLOBALS['CONNECT_DB']->Query("SELECT pk_categoria FROM [|PREFIX|]categoria WHERE fk_categoria='".$IsCategory."' ");
		$return="";
		if (!$GLOBALS['CONNECT_DB']->CountResult($parentsql))
		{
			return;
		}
		else
		{
			while($row = $GLOBALS['CONNECT_DB']->Fetch($parentsql))
			{
				$return.= "," . $row['pk_categoria'];
				$retTmp = $this->getCategoryChildren($row['pk_categoria']);
				if ($retTmp)
					$return .= ",". $retTmp;
			}
		}
		$return=substr($return,1);
		return $return;	
	}
	
	function getParent($aId)
	 {
		$lCatId = $aId;
			
		$sql = "SELECT fk_categoria,txt_nombre";
		$sql .= " FROM [|PREFIX|]categoria WHERE pk_categoria='".$aId."'";
		
		$res = $GLOBALS['CONNECT_DB']->Query($sql);
		$row = $GLOBALS['CONNECT_DB']->Fetch($res);
		$lCatFatherId = $row["fk_categoria"];
		
		if ($lCatFatherId==0)
			return -1;
		
		return $lCatFatherId;
	}

	
	/***********************************
	* Generar la categoria  TreeMenu Page
	************************************/

 function untree_tomenu($parent, $level,$catid)
{
	$parentsql = $GLOBALS['CONNECT_DB']->Query("SELECT pk_categoria,txt_nombre FROM [|PREFIX|]categoria WHERE fk_categoria='".(int)$parent."' AND int_estado='1' ORDER BY int_orden ASC");
	
	$echo_this="";
	if (!$GLOBALS['CONNECT_DB']->CountResult($parentsql))
	{
		return;
	}
	else
	{
		$echo_this .= "<ul>\n";
		while($branch = $GLOBALS['CONNECT_DB']->Fetch($parentsql))
		{
			
			$echo_this .= "<li class=\" ";
			$echo_this.= "\">\n";
				
				if(_SEOMOD==1){
					$SafeName = safename($branch['txt_nombre']);
					$IsMod = _URL.'tours/viajes-'.$SafeName.'-pid-'.$branch['pk_categoria'].'.'._FEXT;
				}else{
					$IsMod = _URL.'categorias.php?pid='.$branch['pk_categoria'];
				}
			
			$echo_this .= "<a href=\"$IsMod\" target=\"_top\" title=\"{$branch['txt_nombre']}\">{$branch['txt_nombre']}</a>\n";
            
			$string.="</li>\n";
			
			$rename_level = $level;
			$echo_this .= $this->untree_tomenu($branch['pk_categoria'], ++$rename_level,$catid);
			
		}
		$echo_this .= "</ul>\n";
	}
	return $echo_this;
}

function createmnu($catid=0){
	$sql = "SELECT txt_linkexterno, pk_categoria,txt_nombre,fk_categoria,int_orden";
	$sql .= " FROM  [|PREFIX|]categoria WHERE fk_categoria=$catid AND int_estado='1' ORDER BY int_orden ASC";
	
	$lRes = $GLOBALS['CONNECT_DB']->Query($sql);
	
	$string = "<ul class=\"sf-menu\">\n";
	
	//$CidSelected = (int)$_GET['cid'];
	
	while ($row_cat = $GLOBALS['CONNECT_DB']->Fetch($lRes))
	{
		
		$sql_n_parent = $GLOBALS['CONNECT_DB']->Query("SELECT * FROM [|PREFIX|]categoria  WHERE fk_categoria='{$row_cat['pk_categoria']}' ORDER BY int_orden ASC") ;
	    $nreg_parent = $GLOBALS['CONNECT_DB']->CountResult($sql_n_parent);
	
	
	# current_page_item -> a la categoria seleccionada
        
		$string .= "<li class=\"";
		if ($catid==$row_cat['fk_categoria'])
		$string .= "";
		$string .= "\" >\n";

		if(_SEOMOD==1){
			$SafeName = safename($row_cat['txt_nombre']);
			$link_categoria = _URL.'tours/viajes-'.$SafeName.'-pid-'.$row_cat['pk_categoria'].'.'._FEXT;
		}else{
			$link_categoria = _URL.'categorias.php?pid='.$row_cat['pk_categoria'];
		}
		//}
		$string .= "<a href=\"$link_categoria\" style=\"cursor: default;\" target=\"_top\" title=\"{$row_cat['txt_nombre']}\">{$row_cat['txt_nombre']}</a>\n";
		
		$string .= $this->untree_tomenu($row_cat['pk_categoria'], 1,$catid);
		
		$string .= "</li>\n";
		
	}
	$string .= "</ul>\n";
	return $string;
}

## Function que genera el acordeon de las categorias 
function Lista_Categorias($parent='0')
{	
	$SQL = $GLOBALS['CONNECT_DB']->Query("SELECT pk_categoria,txt_nombre,txt_descripcion,fk_categoria,int_tipo,txt_imagen,int_estado FROM tbl_categoria WHERE int_estado = '1' AND fk_categoria=$parent ORDER BY int_orden DESC");
	$count = $GLOBALS['CONNECT_DB']->CountResult($SQL);
		if($count>0){
			$i=0;
			 while($Fetch = $GLOBALS['CONNECT_DB']->Fetch($SQL)) 
			 {
			 	$title_secure = secure_sql($Fetch['txt_nombre']);
				$desc_secure = secure_sql($Fetch['txt_descripcion']);
				
				$Presentacion = removeEvilTags(stripslashes_deep(fewchars($desc_secure,170)));
				
					if(_SEOMOD==1){
						$Title = secure_sql($Fetch['txt_nombre']);
						$link_paquete = _URL.'peru/viajes-'.safename($Title).'-pid-'.$Fetch['pk_categoria'].'.'._FEXT;
					}else{
						$link_paquete = _URL.'categoria_detalle.php?cid='.$FetchProd['pk_categoria'];
					}
					
					 $Imagen = $Fetch['txt_imagen'];
					 
					  if(tep_not_null($Imagen) && file_exists(PUBLIC_IMG_CAT.$Imagen)){
					   $img_thumb = base64_encode(PUBLIC_IMG_CAT.$Imagen);					  
					  }
					
					
					 $string .= "	<div class=\"box margin_r_15\">";
					 $string .= "			<div class=\"box_top\"></div>";
					 $string .= "			<div class=\"box_content\">";
					 $string .= "			  <h2>".$title_secure."</h2>";
					 $string .= "			  <div class=\"box_image_wrapper\">";
					 $string .=  				tep_image(_URL.'resize.php?image='.$img_thumb.'&w=286&h=163&IsCrop=0','','','','');					  
					 $string .= "			  </div>";
					 $string .= "			  <p>".$Presentacion."</p><br>";
					 $string .= "<div align=\"center\" class=\"button_01\"><a class=\"ajax_add_to_cart_button exclusive\" href=\"$link_paquete\">Leer M&aacute;s</a></div>";
					 $string .= "			  <div class=\"cleaner\"></div>";
					 $string .= "</div>";
					 $string .= "<div class=\"box_bottom\"></div>";
					 $string .= "	</div>";
				
				$i++;
			 } #cierro while
			 return $string;
		} #cierro count
} #termino de la funcion



## Function que genera el acordeon de las categorias 
function Acordeon_Categoria($parent='0')
{
	$SQL = $GLOBALS['CONNECT_DB']->Query("SELECT pk_categoria,txt_nombre FROM tbl_categoria WHERE int_estado = '1' AND fk_categoria=$parent ORDER BY int_orden DESC");
	$count = $GLOBALS['CONNECT_DB']->CountResult($SQL);
	if($count>0){
	$string = "";
		$i=0;
		 while($Fetch = $GLOBALS['CONNECT_DB']->Fetch($SQL)) 
		 {
		 	 $title_secure = secure_sql($Fetch['txt_nombre']);
			 $IsMod = _URL.'categorias.php?pid='.$Fetch['pk_categoria'];
			 $string .= " <h3 style=\"padding-left:25px; padding-top:0px; padding-bottom:0px; padding-right:0px; margin-top:0px; margin-right:0px; margin-bottom:0px; width:192px; background-image:none; font-size:12px;\">".$title_secure ."</h3>";
			 $string .= " <div style=\"margin:0px; padding-top:0px;\">";
			 $string .= "  <p style=\"font-weight:bold\">click sobre el destino</p>";
			 
			 $Query_paquetes = "SELECT tbl_paquete.pk_paquete, tbl_paquete_details.txt_title,tbl_paquete.fk_categoria, tbl_paquete.int_status, tbl_paquete.int_dias FROM tbl_paquete LEFT JOIN tbl_paquete_details ON tbl_paquete.pk_paquete = tbl_paquete_details.fk_paquete WHERE tbl_paquete.fk_categoria='".$Fetch['pk_categoria']."' and int_status = '1' ORDER BY tbl_paquete.pk_paquete ASC";
									
			 $QueryProd = $GLOBALS['CONNECT_DB']->Query($Query_paquetes) or die(mysql_error());		
			 if($GLOBALS['CONNECT_DB']->CountResult($QueryProd)>0){						
				$j=0;
					while($FetchProd = $GLOBALS['CONNECT_DB']->Fetch($QueryProd)){
						if(_SEOMOD==1){
							$Title = secure_sql($FetchProd['txt_title']);
							$link_paquete = _URL.'paquete/oferta-'.safename($Title).'-pid-'.$FetchProd['pk_paquete'].'.'._FEXT;
						}else{
							$link_paquete = _URL.'paquete_detalle.php?cid='.$FetchProd['pk_paquete'];
						}
						
						
		
							 $paquete = secure_sql($FetchProd['txt_title']);
							 $string .= "	<ul style=\"list-style-type: square;\">";
							 $string .= "	  <li><a href=\"$link_paquete\">".$paquete."</a></li>";
							 $string .= "	</ul>";
							
							$j++; 
					}#while
		    }#if
			 #$string .= "<a href=\"$IsMod\" class=\"view\"><img src=\""._URL."images/bt_ver_mas.png\" alt=\"ver m&aacute;s\"/></a>";			 
			 $string .= " </div>";
			 $i++;
	 }	
	return $string;
  }	
}
## fin de la funcion


	
} // fin de la clase

?>