<?php

class cls_tbl_noticia{

var $pk_noticia; 
var $txt_imagen;
var $txt_fechanoticia;
var $int_estado;
var $txt_fecharegistro;

var $inst_txttitle = "get_titlenotice";
var $inst_txt_content = "get_contentnotice";

function cls_tbl_noticia($id=0)
{

	if($id!=0)
	{
		$sql = $GLOBALS['CONNECT_DB']->Query("SELECT * FROM [|PREFIX|]noticia WHERE pk_noticia = '".$id."' ORDER BY txt_datenoticia DESC");
		$fila = $GLOBALS['CONNECT_DB']->Fetch($sql);
		$this->setpk_noticia($fila['pk_noticia']);
		$this->settxt_imagen($fila['txt_image']);
		$this->settxt_fecha($fila['txt_datenoticia']);
		$this->settxt_estado($fila['int_status']);
		$this->setdate_fecregistro($fila['txt_dateadd']);
	}else{
		$this->setpk_noticia('');
		$this->settxt_imagen('');
		$this->settxt_fecha('');
		$this->settxt_estado('');
		$this->setdate_fecregistro('');
	}

}


function setpk_noticia($pk_noticia){  $this->pk_noticia = $pk_noticia;}
function getpk_noticia(){  return $this->pk_noticia; }

function settxt_imagen($txt_imagen){  $this->txt_imagen = $txt_imagen;}
function gettxt_imagen(){  return $this->txt_imagen; }

function settxt_fecha($txt_fechanoticia){  $this->txt_fechanoticia = $txt_fechanoticia;}
function gettxt_fecha(){  return $this->txt_fechanoticia; }

function settxt_estado($int_estado){  $this->int_estado = $int_estado;}
function gettxt_estado(){  return $this->int_estado; }

function setdate_fecregistro($txt_fecharegistro){  $this->txt_fecharegistro = $txt_fecharegistro;}
function getdate_fecregistro(){  return $this->txt_fecharegistro; }


function _Delete()
{
	$ImgBig = $this->gettxt_imagen();
	deleteFiles(ADMIN_PHOTOBIG_NOTICIA,$ImgBig);
	
	$GLOBALS['CONNECT_DB']->Query("DELETE FROM [|PREFIX|]noticia WHERE  pk_noticia = '".$this->getpk_noticia()."'");
	$GLOBALS['CONNECT_DB']->Query("DELETE FROM [|PREFIX|]noticia_details WHERE  fk_noticia = '".$this->getpk_noticia()."'");

}

function _Save()
{
	
	$array_noticia = array("txt_image"=>$this->gettxt_imagen(),
						   "txt_datenoticia"=>$this->gettxt_fecha(),
						   "int_status"=>$this->gettxt_estado(),
						   "txt_dateadd"=>$this->getdate_fecregistro(),
						   );
	insert($array_noticia,"[|PREFIX|]noticia");
	$id = $GLOBALS['CONNECT_DB']->LastId();
    $this->setpk_noticia($id);

}

function _Update()
{	
	$array_modify = array("txt_image"=>$this->gettxt_imagen(),
						  "txt_datenoticia"=>$this->gettxt_fecha(),
						  "int_status"=>$this->gettxt_estado(),
						  "txt_dateadd"=>$this->getdate_fecregistro(),
						  );
   $array_where = array("pk_noticia"=>$this->getpk_noticia());
   
   update($array_modify,"[|PREFIX|]noticia",$array_where);

}

function SU_Notice($IsMode='Create'){
		  $languages = language::tep_get_languages();
		   for ($i=0, $n=sizeof($languages); $i<$n; $i++) {
			 $notice_id = $this->getpk_noticia();
			 $language_id = $languages[$i]['id'];
			 $name_page = secure_sql($_POST[$this->inst_txttitle][$language_id]);
			 $description_notice = secure_sql($_POST[$this->inst_txt_content][$language_id]);
		     
			 $sql_data_array = array('fk_noticia' => $notice_id,
				                     'language_id' => $language_id ,
				                     'txt_title' => $name_page,
									 'txt_content' => $description_notice
		                             );
			if($IsMode=='Update'){
				$arr_where = array("fk_noticia"=>$this->getpk_noticia(),
								   "language_id"=>$language_id
								   );
				
				$Query_exists = $GLOBALS['CONNECT_DB']->Query("SELECT * FROM [|PREFIX|]noticia_details WHERE fk_noticia ='".$notice_id."' AND language_id='".(int)$language_id."'");
				
				if($GLOBALS['CONNECT_DB']->CountResult($Query_exists)==1)
				 update($sql_data_array,"[|PREFIX|]noticia_details",$arr_where);
				else
				insert($sql_data_array,"[|PREFIX|]noticia_details");
				
		    }else if($IsMode='Create'){
			    insert($sql_data_array,"[|PREFIX|]noticia_details");
			}
			
		   }

}


function estado($estado)
{	$est=$estado;
	if($estado=="")
	{	$estado=($this->gettxt_estado()=="1")?"0":"1";}

	$sql = "UPDATE [|PREFIX|]noticia
				SET int_status='".$estado."'
			WHERE pk_noticia = '".$this->getpk_noticia()."'";
	$GLOBALS['CONNECT_DB']->Query($sql);
	if($est=="")
	{
		$icono = "ico_estado".$estado.".gif";
		echo "<a href='javascript:UpdateStatus(".$this->getpk_noticia().")'>
 			  <img src='"._URL."admin/images/icons/".$icono."' border='0'></a>";
	}
}


function lista($sql="")
{
	if(!tep_not_null($sql)){
	$sql = $GLOBALS['CONNECT_DB']->Query("SELECT * FROM [|PREFIX|]noticia ORDER BY txt_datenoticia DESC");
	}else{
	$sql = $GLOBALS['CONNECT_DB']->Query($sql);
	}
	
	$i=0;
	while($Fetch = $GLOBALS['CONNECT_DB']->Fetch($sql))
	{
		$arreglo[$i]['pk_noticia'] = $Fetch['pk_noticia'];
		$arreglo[$i]['txt_image'] = $Fetch['txt_image'];
		$arreglo[$i]['txt_datenoticia'] = $Fetch['txt_datenoticia'];
		$arreglo[$i]['int_status'] = $Fetch['int_status'];
		$arreglo[$i]['txt_dateadd'] = $Fetch['txt_dateadd'];
	 $i++;
	}
	
	return $arreglo;
}

function URLNotice($idnotice=0){
 
 $InfLang = $this->get_notice_detail($idnotice);
 
 $SQL = "SELECT pk_noticia FROM [|PREFIX|]noticia WHERE int_status =  '1' AND pk_noticia='".$idnotice."'";
 
 $Query = $GLOBALS['CONNECT_DB']->Query($SQL);
 $Count = $GLOBALS['CONNECT_DB']->CountResult($Query);

 $URL = "";
 if($Count >= 1) {
  $Fetch = 	$GLOBALS['CONNECT_DB']->Fetch($Query);
  if(_SEOMOD==1) {
   $title_notice = $InfLang[0]['notice_txt_title'];
     //$URL = _URL.'noticia/read-'.safename($title_notice).'-cid-'.$Fetch['pk_noticia'].'.'._FEXT;
     $URL = _URL.'read_destino.php?cid='.$Fetch['pk_noticia'];
  }else{
   $URL = _URL.'read_destino.php?cid='.$Fetch['pk_noticia'];
   }
 }
 return $URL;
 
}

function listnoticias_public($from = 0, $to = 20, $page = 1){
$SQL = "SELECT pk_noticia, txt_image, txt_datenoticia FROM [|PREFIX|]noticia WHERE int_status =  '1' ";
$SQL .= "ORDER BY txt_datenoticia DESC LIMIT ".$from.", ".$to ;

 $Query = $GLOBALS['CONNECT_DB']->Query($SQL);
 $count = $GLOBALS['CONNECT_DB']->CountResult($Query);
 
 
 if($count >= 1) {
 $strnoticia = "";
 
 while($Fetch = $GLOBALS['CONNECT_DB']->Fetch($Query)) {
 $LangNotice = $this->get_notice_detail($Fetch['pk_noticia']);
 
 $ThisUrl = $this->URLNotice($Fetch['pk_noticia']);
 //$ThumbNotice = _URL.'noticia/imagen/thumb-'.$Fetch['txt_imagen'].'-80-80';
 
 $detalle = utf8_decode($LangNotice[0]['notice_txt_content']);
 $detalle = removeEvilTags($detalle);
 $detalle = fewchars($detalle,330);
 $Image = $Fetch['txt_image']; 
 //$title_secure = secure_sql($Fetch['txt_titulo']);
 $title_secure = utf8_decode($LangNotice[0]['notice_txt_title']);
 
     $strnoticia .= "<!-- port-box START here -->";
	   $strnoticia .= "<li class=\"port-box\">";
	     
		 if(tep_not_null($Image) && file_exists(PUBLIC_PHOTOBIG_NOTICIA.$Image)){
		   $InfoImg = getimagesize(PUBLIC_PHOTOBIG_NOTICIA.$Image);
		   $WidthImg = $InfoImg[0];#Ancho de la imagen
		   $PathImage = "";
		    if($WidthImg>290){$PathImage=_URL.'resize.php?image='.PUBLIC_PHOTOBIG_NOTICIA.$Image.'&w=290&h=150';}else{$PathImage=_URL.PUBLIC_PHOTOBIG_NOTICIA.$Image;}
		   $strnoticia .= "<a href=\"$ThisUrl\" class=\"img-load\">";
		    $strnoticia .= tep_image($PathImage,$title_secure);
		   $strnoticia .= "</a>";
		 }
		 
		  $strnoticia .= "<h3><a href=\"$ThisUrl\">$title_secure</a></h3>";
		 
		  $strnoticia .= "<div class=\"meta\">";
            $strnoticia .= "<span class=\"date\">27/04/10</span>";
          $strnoticia .= "</div>";
		  
		  $strnoticia .= "<p>";
		  $strnoticia .= $detalle;
		  $strnoticia .= "</p>";
		 
		  $strnoticia .= "<a href=\"$ThisUrl\" class=\"button\">";
		  $strnoticia .= _READMORE;
		  $strnoticia .= "</a>";
		  
		 $strnoticia .= "</li>";
		 $strnoticia .= "<!-- port-box END here -->";
     $strnoticia .= "<br>";
 
  } # While
  
 }

 return $strnoticia ;
}


function IsExistNoticia($IsActive=false){
$arr_and = "";
if($IsActive==true)	
$arr_and = "AND int_status='1' ";

$SQL = "SELECT * FROM [|PREFIX|]noticia WHERE pk_noticia='".$this->getpk_noticia()."' $arr_and";
$QueryExist = $GLOBALS['CONNECT_DB']->Query($SQL);
$Count = $GLOBALS['CONNECT_DB']->CountResult($QueryExist);
if($Count==0)
return false ;
else
return true ;
}



function get_infolang_notice($language_id = ''){

	$sql = "SELECT txt_title,txt_content FROM [|PREFIX|]noticia_details ";
	$sql .= "WHERE fk_noticia ='".$this->getpk_noticia()."' AND language_id='".(int)$language_id."' ";
	
	$notice_query = $GLOBALS['CONNECT_DB']->Query($sql);
	
	while($FetchInfo = $GLOBALS['CONNECT_DB']->Fetch($notice_query)){

	$get_data_array[] = array('title' => $FetchInfo['txt_title'],
							  'details' => $FetchInfo['txt_content']
							   );
	}
    return  $get_data_array ;
}
function get_notice_detail($notice_id, $language_id = 0) {
    global $languages_id;

    if ($language_id == 0) $language_id = $languages_id;
    $page_query = "SELECT txt_title,txt_content FROM [|PREFIX|]noticia_details WHERE";
	$page_query .= " fk_noticia = '" . (int)$notice_id . "' and language_id = '" . (int)$language_id . "'" ;
	
	$Query = $GLOBALS['CONNECT_DB']->Query($page_query);
	
	while ($FetchNotice = $GLOBALS['CONNECT_DB']->Fetch($Query)){
    $getnotice[] = array('notice_txt_title'=>$FetchNotice['txt_title'],
	                     'notice_txt_content'=>$FetchNotice['txt_content']
	                   );
	}					    
    return $getnotice;
  }

} // fin de la clase

?>