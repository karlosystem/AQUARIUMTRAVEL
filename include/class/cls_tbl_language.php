<?php

  class language {
    var $languages, $catalog_languages, $browser_languages, $language;

    function language($lng = '') {
      $this->languages = array('ar' => 'ar([-_][[:alpha:]]{2})?|arabic',
                               'bg' => 'bg|bulgarian',
                               'br' => 'pt[-_]br|brazilian portuguese',
                               'ca' => 'ca|catalan',
                               'cs' => 'cs|czech',
                               'da' => 'da|danish',
                               'de' => 'de([-_][[:alpha:]]{2})?|german',
                               'el' => 'el|greek',
                               'en' => 'en([-_][[:alpha:]]{2})?|english',
                               'es' => 'es([-_][[:alpha:]]{2})?|spanish',
                               'et' => 'et|estonian',
                               'fi' => 'fi|finnish',
                               'fr' => 'fr([-_][[:alpha:]]{2})?|french',
                               'gl' => 'gl|galician',
                               'he' => 'he|hebrew',
                               'hu' => 'hu|hungarian',
                               'id' => 'id|indonesian',
                               'it' => 'it|italian',
                               'ja' => 'ja|japanese',
                               'ko' => 'ko|korean',
                               'ka' => 'ka|georgian',
                               'lt' => 'lt|lithuanian',
                               'lv' => 'lv|latvian',
                               'nl' => 'nl([-_][[:alpha:]]{2})?|dutch',
                               'no' => 'no|norwegian',
                               'pl' => 'pl|polish',
                               'pt' => 'pt([-_][[:alpha:]]{2})?|portuguese',
                               'ro' => 'ro|romanian',
                               'ru' => 'ru|russian',
                               'sk' => 'sk|slovak',
                               'sr' => 'sr|serbian',
                               'sv' => 'sv|swedish',
                               'th' => 'th|thai',
                               'tr' => 'tr|turkish',
                               'uk' => 'uk|ukrainian',
                               'tw' => 'zh[-_]tw|chinese traditional',
                               'zh' => 'zh|chinese simplified');

      $this->catalog_languages = array();
      $languages_query = $GLOBALS['CONNECT_DB']->Query("SELECT languages_id, name, code, image, directory, status FROM [|PREFIX|]language WHERE status = '1' ORDER BY sort_order ASC")or die(mysql_error());
      while ($languages = $GLOBALS['CONNECT_DB']->Fetch($languages_query)) {
        $this->catalog_languages[$languages['code']] = array('id' => $languages['languages_id'],
                                                             'name' => $languages['name'],
                                                             'image' => $languages['image'],
                                                             'directory' => $languages['directory'],
															 'code' => $languages['code']
															 );
      }
      $this->browser_languages = '';
      $this->language = '';

      $this->set_language($lng);
    }

    function set_language($language) {
	//global $ArrayConf ;
	//print $ArrayConf['default_lang'];
      if ( (tep_not_null($language)) && (isset($this->catalog_languages[$language])) ) {
        $this->language = $this->catalog_languages[$language];
      } else {
        $this->language = $this->catalog_languages[DEFAULT_LANGUAGE];
      }
    }

    function get_browser_language() {
      $this->browser_languages = explode(',', getenv('HTTP_ACCEPT_LANGUAGE'));

      for ($i=0, $n=sizeof($this->browser_languages); $i<$n; $i++) {
        reset($this->languages);
        while (list($key, $value) = each($this->languages)) {
          if (preg_match('/^(' . $value . ')(;q=[0-9]\\.[0-9])?$/i', $this->browser_languages[$i]) && isset($this->catalog_languages[$key])) {
            $this->language = $this->catalog_languages[$key];
            break 2;
          }
        }
      }
    }
  
  
  
function IsExistLanguage($idlanguage){
	$SQL = "SELECT * FROM [|PREFIX|]language WHERE languages_id='".(int)$idlanguage."' ";

	$QueryExist = $GLOBALS['CONNECT_DB']->Query($SQL)or die(mysql_error());
	$Count = $GLOBALS['CONNECT_DB']->CountResult($QueryExist);
	if($Count==0)
	return false ;
	else
	return true ;
}
  
  
  function lista($sql="")
{

	if(!tep_not_null($sql)){
	$sql = $GLOBALS['CONNECT_DB']->Query("SELECT * FROM [|PREFIX|]language WHERE status = '1' ORDER BY sort_order ASC")or die(mysql_error());
	}else{
	$sql = $GLOBALS['CONNECT_DB']->Query($sql)or die(mysql_error());
	}
	
	$i=0;
	while($Fetch = $GLOBALS['CONNECT_DB']->Fetch($sql))
	{
		$arreglo[$i]['languages_id'] = $Fetch['languages_id'];
		$arreglo[$i]['name'] = $Fetch['name'];
		$arreglo[$i]['code'] = $Fetch['code'];
		$arreglo[$i]['image'] = $Fetch['image'];
		$arreglo[$i]['directory'] = $Fetch['directory'];
		$arreglo[$i]['sort_order'] = $Fetch['sort_order'];
		$arreglo[$i]['status'] = $Fetch['status'];
	 $i++;
	}
	return $arreglo;
}
  
  
  function tep_get_languages() {
  
    $languages_query = $GLOBALS['CONNECT_DB']->Query("SELECT * FROM [|PREFIX|]language WHERE status = '1' ORDER BY sort_order")or die(mysql_error());
    while ($languages = $GLOBALS['CONNECT_DB']->Fetch($languages_query)) {
      $languages_array[] = array('id' => $languages['languages_id'],
                                 'name' => $languages['name'],
                                 'code' => $languages['code'],
                                 'image' => $languages['image'],
                                 'directory' => $languages['directory'],
								 'sort_order' => $languages['sort_order'],
								 'status' => $languages['status']
								 );
    }

    return $languages_array;
  }
  
  function ListLangCmb($LangId=0){
	$Lang = $this->tep_get_languages();
	$str_lang = "";
	if(is_array($Lang)) {
	  for ($i=0, $n=sizeof($Lang); $i<$n; $i++) {
		    $str_lang .= "<option value='".$Lang[$i]['id']."'";
			
			if($Lang[$i]['id']==$LangId)
			$str_lang .= "selected";
			
			$str_lang .= ">".$Lang[$i]['name']."</option>";
	  }	
	}  
	 return $str_lang; 
  }
  
  
  }
?>