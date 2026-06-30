<?php
class cls_tbl_testimonios{

var $pk_testimonios; 
var $txt_imgthumb;
var $txt_fechatestimonio;
var $int_status;
var $txt_dateadd;

var $inst_txttitle = "get_titletestimonio";
var $inst_txt_content = "get_contenttestimonio";


function cls_tbl_testimonios($id=0)
{

	if($id!=0)
	{
		$sql = $GLOBALS['CONNECT_DB']->Query("SELECT * FROM tbl_testimonios WHERE pk_testimonios = '".$id."' ORDER BY txt_datetestimonio ASC");
		$fila = $GLOBALS['CONNECT_DB']->Fetch($sql);
				
		$this->setpk_testimonios($fila['pk_testimonios']);
		$this->settxt_imgthumb($fila['txt_imgthumb']);
		$this->setdate_testimonio($fila['txt_datetestimonio']);
		$this->settxt_status($fila['int_estado']);
		$this->setdate_dateadd($fila['txt_dateadd']);
		
	}else{
		$this->setpk_testimonios('');
		$this->settxt_imgthumb('');
		$this->setdate_testimonio('');
		$this->settxt_status('');
		$this->setdate_dateadd('');
	}

}

function setpk_testimonios($pk_testimonios){  $this->pk_testimonios = $pk_testimonios;}
function getpk_testimonios(){  return $this->pk_testimonios; }

function settxt_imgthumb($txt_imgthumb){  $this->txt_imgthumb = $txt_imgthumb;}
function gettxt_imgthumb(){  return $this->txt_imgthumb; }

function setdate_testimonio($txt_fechatestimonio){  $this->txt_fechatestimonio = $txt_fechatestimonio;}
function getdate_testimonio(){  return $this->txt_fechatestimonio; }

function settxt_status($int_status){  $this->int_status = $int_status;}
function gettxt_status(){  return $this->int_status; }

function setdate_dateadd($txt_dateadd){  $this->txt_dateadd = $txt_dateadd;}
function getdate_dateadd(){  return $this->txt_dateadd; }


function IsExistTestimonios($IsActive=false){
$arr_and = "";
if($IsActive==true)	
$arr_and = "AND int_estado='1' ";

$SQL = "SELECT * FROM [|PREFIX|]testimonios WHERE pk_testimonios='".$this->getpk_testimonios()."' $arr_and";
$QueryExist = $GLOBALS['CONNECT_DB']->Query($SQL);
$Count = $GLOBALS['CONNECT_DB']->CountResult($QueryExist);
if($Count==0)
return false ;
else
return true ;
}

function get_infolang_testimonios($language_id = ''){

	$sql = "SELECT txt_title,txt_content FROM [|PREFIX|]testimonios_details ";
	$sql .= "WHERE fk_testimonio ='".$this->getpk_testimonios()."' AND language_id='".(int)$language_id."' ";
	
	$testimonio_query = $GLOBALS['CONNECT_DB']->Query($sql);
	
	while($FetchInfo = $GLOBALS['CONNECT_DB']->Fetch($testimonio_query)){

	$get_data_array[] = array('title' => $FetchInfo['txt_title'],
							  'details' => $FetchInfo['txt_content']
							   );
	}
    return  $get_data_array ;
}

function get_testimonios_detail($testimonio_id, $language_id = 0) {
    global $languages_id;

    if ($language_id == 0) $language_id = $languages_id;
    $page_query = "SELECT txt_title, txt_content FROM [|PREFIX|]testimonios_details WHERE";
	$page_query .= " fk_testimonio = '" . (int)$testimonio_id . "' and language_id = '" . (int)$language_id . "'" ;
	
	$Query = $GLOBALS['CONNECT_DB']->Query($page_query);
	
	while ($FetchTestimonio = $GLOBALS['CONNECT_DB']->Fetch($Query)){
    $getcliente[] = array('testimonio_txt_title'=>$FetchTestimonio['txt_title'],
	                         'testimonio_txt_content'=>$FetchTestimonio['txt_content']
	                   );
	}					    
    return $getcliente;
}
  
function _Delete()
{
	$ImgBig = $this->gettxt_imgthumb();
	deleteFiles(ADMIN_IMG_TESTIMONIO,$ImgBig);
	
	$GLOBALS['CONNECT_DB']->Query("DELETE FROM [|PREFIX|]testimonios WHERE  pk_testimonios = '".$this->getpk_testimonios()."'");
	$GLOBALS['CONNECT_DB']->Query("DELETE FROM [|PREFIX|]testimonios_details WHERE  fk_testimonio = '".$this->getpk_testimonios()."'");

}

function _Save()
{
	
	$array_testimonios = array("txt_imgthumb"=>$this->gettxt_imgthumb(),
						   "txt_datetestimonio"=>$this->getdate_testimonio(),
						   "int_estado"=>$this->gettxt_status(),
						   "txt_dateadd"=>$this->getdate_dateadd(),
						   );
	insert($array_testimonios,"[|PREFIX|]testimonios");
	$id = $GLOBALS['CONNECT_DB']->LastId();
    $this->setpk_testimonios($id);

}

function _Update()
{	
	$array_modify = array("txt_imgthumb"=>$this->gettxt_imgthumb(),
						   "txt_datetestimonio"=>$this->getdate_testimonio(),
						   "int_estado"=>$this->gettxt_status(),
						   "txt_dateadd"=>$this->getdate_dateadd(),
						   );
   $array_where = array("pk_testimonios"=>$this->getpk_testimonios());   
   update($array_modify,"[|PREFIX|]testimonios",$array_where);
}


function SU_Testimonios($IsMode='Create'){
		  $languages = language::tep_get_languages();
		   for ($i=0, $n=sizeof($languages); $i<$n; $i++) {
			 $testimonios_id = $this->getpk_testimonios();
			 $language_id = $languages[$i]['id'];
			 $name_page = secure_sql($_POST[$this->inst_txttitle][$language_id]);
			 $description_testimonio = secure_sql($_POST[$this->inst_txt_content][$language_id]);
		     
			 $sql_data_array = array('fk_testimonio' => $testimonios_id,
				                     'language_id' => $language_id ,
				                     'txt_title' => $name_page,
									 'txt_content' => $description_testimonio
		                             );
			if($IsMode=='Update'){
				$arr_where = array("fk_testimonio"=>$this->getpk_testimonios(),
								   "language_id"=>$language_id
								   );
				
				$Query_exists = $GLOBALS['CONNECT_DB']->Query("SELECT * FROM [|PREFIX|]testimonios_details WHERE fk_testimonio ='".$testimonios_id."' AND language_id='".(int)$language_id."'");
				
				if($GLOBALS['CONNECT_DB']->CountResult($Query_exists)==1)
				 update($sql_data_array,"[|PREFIX|]testimonios_details",$arr_where);
				else
				insert($sql_data_array,"[|PREFIX|]testimonios_details");
				
		    }else if($IsMode='Create'){
			    insert($sql_data_array,"[|PREFIX|]testimonios_details");
			}
			
		   }

}



function estado($estado)
{	$est=$estado;
	if($estado=="")
	{	$estado=($this->gettxt_status()=="1")?"0":"1";}

	$sql = "UPDATE tbl_testimonios
				SET int_estado='".$estado."'
			WHERE pk_testimonios = '".$this->getpk_testimonios()."'";
	$GLOBALS['CONNECT_DB']->Query($sql);
	if($est=="")
	{
		$icono = "ico_estado".$estado.".gif";
		echo "<a href='javascript:ajax_estado(".$this->getpk_testimonios().")'>
 			  <img src='"._URL."admin/images/icons/".$icono."' border='0'></a>";
	}
}

function lista($sql="")
{
	if(!tep_not_null($sql)){
	$sql = $GLOBALS['CONNECT_DB']->Query("SELECT * FROM [|PREFIX|]testimonios ORDER BY txt_datetestimonio DESC");
	}else{
	$sql = $GLOBALS['CONNECT_DB']->Query($sql);
	}
	
	$i=0;
	while($Fetch = $GLOBALS['CONNECT_DB']->Fetch($sql))
	{
		$arreglo[$i]['pk_testimonios'] = $Fetch['pk_testimonios'];
		$arreglo[$i]['txt_imgthumb'] = $Fetch['txt_imgthumb'];
		$arreglo[$i]['txt_datetestimonio'] = $Fetch['txt_datetestimonio'];
		$arreglo[$i]['int_estado'] = $Fetch['int_estado'];
		$arreglo[$i]['txt_dateadd'] = $Fetch['txt_dateadd'];
	 $i++;
	}
	
	return $arreglo;
}

function URLTestimonio($idtestimonio=0){
 $InfLang = $this->get_testimonios_detail($idtestimonio);
 
 $SQL = "SELECT pk_testimonios FROM [|PREFIX|]testimonios WHERE int_estado =  '1' AND pk_testimonios='".$idtestimonio."'";
 
 $Query = $GLOBALS['CONNECT_DB']->Query($SQL);
 $Count = $GLOBALS['CONNECT_DB']->CountResult($Query);

 $URL = "";
 if($Count >= 1) {
  $Fetch = 	$GLOBALS['CONNECT_DB']->Fetch($Query);
  if(_SEOMOD==1) {
   $title_testimonio = $InfLang[0]['testimonio_txt_title'];
     $URL = _URL.'read_testimonio.php?cid='.$Fetch['pk_testimonios'];
  }else{
     $URL = _URL.'read_testimonio.php?cid='.$Fetch['pk_testimonios'];
   }
 }
 return $URL;
 
}

function classgallery_testimonios(){
if(!$page)	$page = 1;
 
$SQL = "SELECT tbl_testimonios.pk_testimonios, txt_imgthumb, txt_datetestimonio FROM [|PREFIX|]testimonios WHERE int_estado =  '1' ";
$SQL .= "ORDER BY txt_datetestimonio DESC";


 $Query = $GLOBALS['CONNECT_DB']->Query($SQL)or die(mysql_error());
 $count = $GLOBALS['CONNECT_DB']->CountResult($Query);
 
 
 $strgal_testimonio = "";
 if($count >= 1) {
    $j=1;
 	$class = "";
	while($Fetch = $GLOBALS['CONNECT_DB']->Fetch($Query)) {
		$LangTestimonio = $this->get_testimonios_detail($Fetch['pk_testimonios']);
		$ThisUrl = $this->URLTestimonio($Fetch['pk_testimonios']);
		
		$detalle = $LangTestimonio[0]['testimonio_txt_content'];
 		$Image = $Fetch['txt_imgthumb']; 
		
		$title_secure = utf8_decode($LangTestimonio[0]['testimonio_txt_title']);
	  	$remove_ubicacion = removeEvilTags(stripslashes_deep($detalle)); 
	   	$strgal_testimonio .= "<p>$remove_ubicacion<br><br><span style=\"font-weight:bold\">$title_secure</span></p>";

 	 $j++;
    }#While
 }#>0
 else{
   $strgal_testimonio .= "<div class=\"msg_resulproduct\"><center><b>Lo sentimos, no hay resultados de productos.</b></center></div>";	 
 }
 return $strgal_testimonio ;

}


}

?>