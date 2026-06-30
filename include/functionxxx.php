<?php
function fecha_spanish($date){
	$date=substr($date,0,10);
	$date=explode("-",$date);
	$month="Enero,Febrero,Marzo,Abril,Mayo,Junio,Julio,Agosto,Setiembre,Octubre,Noviembre,Diciembre";
	$month=explode(",",$month);
	foreach($month as $key => $value){
		if(($key+1)==(int)$date[1]){
			$m=$value;
		}				
	}
	//$y=substr($date[0],2);
	$y = $date[0] ;
	$d=$date[2];
	$date=$d." de ".$m." del ".$y;
	return $date;	
}

setlocale(LC_ALL, 'en_US.UTF8');
function clean_url($str, $replace=array(), $delimiter='-') {
	if( !empty($replace) ) {
		$str = str_replace((array)$replace, ' ', $str);
	}

	$clean = iconv('UTF-8', 'ASCII//TRANSLIT', $str);
	$clean = preg_replace("/[^a-zA-Z0-9\/_|+ -]/", '', $clean);
	$clean = strtolower(trim($clean, '-'));
	$clean = preg_replace("/[\/_|+ -]+/", $delimiter, $clean);

	return $clean;
}

function cleanData($a) {

     if(is_numeric($a)) {

     $a = preg_replace('/[^0-9,]/s', '', $a);
     }

     return $a;

}

function ToMoney($amount,$separator=true,$simple=false){
    return
        (true===$separator?
            (false===$simple?
                number_format($amount,2,'.',','):
                str_replace('.00','',ToMoney($amount))
            ):
            (false===$simple?
                number_format($amount,2,'.',''):
                str_replace('.00','',ToMoney($amount,false))
            )
        );
}

function file_notextension($file){
 	if(tep_not_null($file)) {
 	 $archivo = $file;
 	 $arr = explode(".", $archivo);
 	 $file = substr($archivo, 0, count($arr[0]));
	 $rtn_file = $arr[0];
	 return $rtn_file;
 	}	
 }

function inc_color($sw){
	if($sw==1){
		return "#F2F2F2";
	}else{
		return "#E8E8E8";
	}
}

function time_since($original) {
    // array of time period chunks
    $chunks = array(
        array(60 * 60 * 24 * 365 , 'year'),
        array(60 * 60 * 24 * 30 , 'month'),
        array(60 * 60 * 24 * 7, 'week'),
        array(60 * 60 * 24 , 'day'),
        array(60 * 60 , 'hour'),
        array(60 , 'minute'),
    );
    
    $today = time(); /* Current unix time  */
    $since = $today - $original;
    
    // $j saves performing the count function each time around the loop
    for ($i = 0, $j = count($chunks); $i < $j; $i++) {
        
        $seconds = $chunks[$i][0];
        $name = $chunks[$i][1];
        
        // finding the biggest chunk (if the chunk fits, break)
        if (($count = floor($since / $seconds)) != 0) {
            // DEBUG print "<!-- It's $name -->\n";
            break;
        }
    }
    
    $print = ($count == 1) ? '1 '.$name : "$count {$name}s";
    
    if ($i + 1 < $j) {
        // now getting the second item
        $seconds2 = $chunks[$i + 1][0];
        $name2 = $chunks[$i + 1][1];
        
        // add second item if it's greater than 0
        if (($count2 = floor(($since - ($seconds * $count)) / $seconds2)) != 0) {
            $print .= ($count2 == 1) ? ', 1 '.$name2 : ", $count2 {$name2}s";
        }
    }
    return $print;
}


function safename($title){
// reemplazamos todos los caracteres no deseados de una cadena por "-" ;
		$title = remove_accents($title);
		$title = str_replace("&", "and", $title);
		$arrStupid = array('feat.', 'feat', '.com', '(tm)', ' ', '–', "'s",  '"', ",", ":", ";", "@", "#", "(", ")", "?", " – ", "!", "_",
							 "$","+", "=", "|", "'", '/', "~", "`s", "`", "\\", "^", "[","]","{", "}", "<", ">", "%", "â„¢");

		$title = htmlentities($title);
  		$title = preg_replace('/&([a-zA-Z])(.*?);/','$1',$title); // get rid of bogus characters
		$title = strtolower("$title");
		$title = str_replace(".", "", $title);
		$title = str_replace($arrStupid, "-", $title);
		$flag = 1;
			while($flag){ 
  			  $newtitle = str_replace("--","-",$title);
				if($title != $newtitle) { 
					$flag = 1;
				 }
				else $flag = 0;
 			  $title = $newtitle;
			}
		$len = strlen($title);
		if($title[$len-1] == "-") {
			$title = substr($title, 0, $len-1);
		}
		return $title;
}


function secure_sql($value)
	{
	if( get_magic_quotes_gpc() )
	{
	$value = stripslashes( $value );
	}
	if( function_exists( "mysql_real_escape_string" ) )
	{
	$value = mysql_real_escape_string( $value );
	}
	else
	{
	$value = addslashes( $value );
	}
	return $value;
}

function stripslashes_deep($value)
	{
		if (is_array($value)) {
			$value = array_map('stripslashes_deep', $value);
		} else {
			$value = stripslashes($value);
		}

		return $value;
	}

function STSSetEncoding($encoding)
{
	if($encoding && function_exists("mb_internal_encoding")) {
		return mb_internal_encoding($encoding);
	}
}

function GetConfig($config)
	{
		if (array_key_exists($config, $GLOBALS['CONFIG_DB'])) {
			return $GLOBALS['CONFIG_DB'][$config];
		}
		return '';
}

function validar_numero($element) 
{
	//if (preg_match("/^[0-9]$/", $element))
	if (preg_match("/^[0-9]+$/", $element))
	return true;
	else
	return false;
}


function SecurePost($PostVar) {
    return addslashes(htmlspecialchars(mysql_escape_string(stripslashes(strip_tags($PostVar)))));
}

//Secure all get variables 10
function SecureGet($GetVar) {
    return addslashes($GetVar);
}

function tep_not_null($value) {
    if (is_array($value)) {
      if (sizeof($value) > 0) {
        return true;
      } else {
        return false;
      }
    } else {
      if ( (is_string($value) || is_int($value)) && ($value != '') && ($value != 'NULL') && (strlen(trim($value)) > 0)) {
        return true;
      } else {
        return false;
      }
    }
  }


function count_entries($table, $field="", $field_equal="",$arr_where="") { // Usage 1 = table name 2 = field to search 3 = what to match
    
	if(tep_not_null($arr_where) && is_array($arr_where)){
		$key = array();
		$val = array();
		while (list($_key, $_val) = each($arr_where))
		{
			$key[] = $_key;
			$val[] = $_val;
		}
		$arr_str = array();
		for ($i = 0; $i < count($val); $i++)
		{
			if (is_int($val[$i])) $arr_str[] = $key[$i] . "=" . $val[$i];
			else $arr_str[] = $key[$i] . "='" . $val[$i] . "'";
		}
		$where = implode(" AND ", $arr_str);
		$query = $GLOBALS['CONNECT_DB']->Query("SELECT * FROM [|PREFIX|]$table WHERE $where");
		/*print "SELECT * FROM [|PREFIX|]$table WHERE $where";*/
	}
	else{
	
		if(!empty($field) && isset($field_equal)) {
		$query = $GLOBALS['CONNECT_DB']->Query("SELECT * FROM [|PREFIX|]$table WHERE $field = '".$field_equal."'");
		} else {
		$query = $GLOBALS['CONNECT_DB']->Query("SELECT * FROM [|PREFIX|]$table");
		}
		
	}
	$result = $GLOBALS['CONNECT_DB']->CountResult($query);
	
	return $result;
}

function generate_smart_pagination($page = 1, $totalitems, $limit = 15, $adjacents = 1, $targetpage = "/", $pagestring = "&page=", $seomod = 0)
{		
	if(!$adjacents) $adjacents = 1;
	if(!$limit) $limit = 15;
	if(!$page) $page = 1;
	if(!$targetpage) $targetpage = "/";
	
	$prev = $page - 1;
	$next = $page + 1;
	$lastpage = ceil($totalitems / $limit);
	$lpm1 = $lastpage - 1;
	//	this function will replace the existing "page=N" with it's own page number when building the links
	//	so let's check if there is any "page=" in the original $pagestring. If non found, add one to help things out
	if($seomod == 1)
	{
		$pagestring1 = preg_replace('/-([0-9]*)-/', '-1-', $targetpage);
		$pagestring2 = preg_replace('/-([0-9]*)-/', '-2-', $targetpage);

		$pagestringlpm1 = preg_replace('/-([0-9]*)-/', '-'.$lpm1.'-', $targetpage);
		$pagestringlast = preg_replace('/-([0-9]*)-/', '-'.$lastpage.'-', $targetpage);		
	}
	else
	{
		if(strpos($pagestring, 'page=', 0) === FALSE)
			$pagestring .= "&page=";
		
		$pagestring1 = preg_replace('/page=([0-9]*)/', 'page=1', $pagestring);
		$pagestring2 = preg_replace('/page=([0-9]*)/', 'page=2', $pagestring);
		$pagestringlpm1 = preg_replace('/page=([0-9]*)/', 'page='.$lpm1, $pagestring);
		$pagestringlast = preg_replace('/page=([0-9]*)/', 'page='.$lastpage, $pagestring);
	}	
		$pagination = "";
		if($lastpage > 1)
		{	
			$pagination .= "<div class=\"pagination\"";
			if($margin || $padding)
			{
				$pagination .= " style=\"";
				if($margin)
					$pagination .= "margin: $margin;";
				if($padding)
					$pagination .= "padding: $padding;";
				$pagination .= "\"";
			}
			$pagination .= ">";
	
			//previous button
			if ($page > 1)
			{
				if($seomod == 1)
				{
					$url_query = preg_replace('/-([0-9]*)-/', '-'.$prev.'-', $targetpage); 
					$pagination .= "<a href=\"$url_query\">&laquo;ANTERIOR</a>";
				}
				else
				{
					$url_query = preg_replace('/page=([0-9]*)/', 'page='.$prev, $pagestring);
					$pagination .= "<a href=\"$targetpage?$url_query\">&laquo;ANTERIOR</a>";
				}
			}
			else
					$pagination .= "<span class=\"disabled\">&laquo;INICIO</span>";
			
			//pages	
			if ($lastpage < 7 + ($adjacents * 2))	//not enough pages to bother breaking it up
			{	
				for ($counter = 1; $counter <= $lastpage; $counter++)
				{
					if ($counter == $page)
						$pagination .= "<span class=\"current\">$counter</span>";
					else
					{
						if($seomod == 1)
						{
							$url_query = preg_replace('/-([0-9]*)-/', '-'.$counter.'-', $targetpage); 
							$pagination .= "<a href=\"$url_query\">$counter</a>";
						}
						else
						{
							$url_query = preg_replace('/page=([0-9]*)/', 'page='.$counter, $pagestring);
							$pagination .= "<a href=\"$targetpage?$url_query\">$counter</a>";
						}
					}					
				}
			}
			elseif($lastpage >= 7 + ($adjacents * 2))	//enough pages to hide some
			{
				//close to beginning; only hide later pages
				if($page < 2 + ($adjacents * 3))		
				{
					for ($counter = 1; $counter < 4 + ($adjacents * 2); $counter++)
					{
						if ($counter == $page)
							$pagination .= "<span class=\"current\">$counter</span>";
						else
						{
							if($seomod == 1)
							{
								$url_query = preg_replace('/-([0-9]*)-/', '-'.$counter.'-', $targetpage); 
								$pagination .= "<a href=\"$url_query\">$counter</a>";
							}
							else
							{
								$url_query = preg_replace('/page=([0-9]*)/', 'page='.$counter, $pagestring);
								$pagination .= "<a href=\"$targetpage?$url_query\">$counter</a>";
							}
//							$url_query = preg_replace('/page=([0-9]*)/', 'page='.$counter, $pagestring);
//							$pagination .= "<a href=\"$targetpage?$url_query\">$counter</a>";	
						}				
					}
					$pagination .= "...";
					if($seomod == 1)
					{					
						$pagination .= "<a href=\"$pagestringlpm1\">$lpm1</a>";
						$pagination .= "<a href=\"$pagestringlast\">$lastpage</a>";		
					}
					else
					{
						$pagination .= "<a href=\"$targetpage?$pagestringlpm1\">$lpm1</a>";
						$pagination .= "<a href=\"$targetpage?$pagestringlast\">$lastpage</a>";		
					}
				}
				//in middle; hide some front and some back
				elseif($lastpage - ($adjacents * 2) > $page && $page > ($adjacents * 2))
				{
					if($seomod == 1)
					{					
						$pagination .= "<a href=\"$pagestring1\">1</a>";
						$pagination .= "<a href=\"$pagestring2\">2</a>";		
					}
					else
					{
						$pagination .= "<a href=\"$targetpage?$pagestring1\">1</a>";
						$pagination .= "<a href=\"$targetpage?$pagestring2\">2</a>";
					}				
					$pagination .= "...";
					for ($counter = $page - $adjacents; $counter <= $page + $adjacents; $counter++)
					{
						if ($counter == $page)
							$pagination .= "<span class=\"current\">$counter</span>";
						else
						{
							if($seomod == 1)
							{
								$url_query = preg_replace('/-([0-9]*)-/', '-'.$counter.'-', $targetpage); 
								$pagination .= "<a href=\"$url_query\">$counter</a>";
							}
							else
							{
								$url_query = preg_replace('/page=([0-9]*)/', 'page='.$counter, $pagestring);
								$pagination .= "<a href=\"$targetpage?$url_query\">$counter</a>";
							}						
//							$url_query = preg_replace('/page=([0-9]*)/', 'page='.$counter, $pagestring);
//							$pagination .= "<a href=\"$targetpage?$url_query\">$counter</a>";
						}
					}
					$pagination .= "...";
					if($seomod == 1)
					{					
						$pagination .= "<a href=\"$pagestringlpm1\">$lpm1</a>";
						$pagination .= "<a href=\"$pagestringlast\">$lastpage</a>";		
					}
					else
					{
						$pagination .= "<a href=\"$targetpage?$pagestringlpm1\">$lpm1</a>";
						$pagination .= "<a href=\"$targetpage?$pagestringlast\">$lastpage</a>";		
					}					
//					$pagination .= "<a href=\"$targetpage?$pagestringlpm1\">$lpm1</a>";
//					$pagination .= "<a href=\"$targetpage?$pagestringlast\">$lastpage</a>";		
				}
				//close to end; only hide early pages
				else
				{
					if($seomod == 1)
					{					
						$pagination .= "<a href=\"$pagestring1\">1</a>";
						$pagination .= "<a href=\"$pagestring2\">2</a>";		
					}
					else
					{
						$pagination .= "<a href=\"$targetpage?$pagestring1\">1</a>";
						$pagination .= "<a href=\"$targetpage?$pagestring2\">2</a>";
					}				
					$pagination .= "...";
					for ($counter = $lastpage - (1 + ($adjacents * 3)); $counter <= $lastpage; $counter++)
					{
						if ($counter == $page)
							$pagination .= "<span class=\"current\">$counter</span>";
						else
						{
							if($seomod == 1)
							{
								$url_query = preg_replace('/-([0-9]*)-/', '-'.$counter.'-', $targetpage); 
								$pagination .= "<a href=\"$url_query\">$counter</a>";
							}
							else
							{
								$url_query = preg_replace('/page=([0-9]*)/', 'page='.$counter, $pagestring);
								$pagination .= "<a href=\"$targetpage?$url_query\">$counter</a>";
							}
						}
					}
				}
			}
			
			//next button
			if ($page < $counter - 1) 
			{
				if($seomod == 1)
				{
					$url_query = preg_replace('/-([0-9]*)-/', '-'.$next.'-', $targetpage); 
					$pagination .= "<a href=\"$url_query\">SIGUIENTE&raquo;</a>";
				}
				else
				{
					$url_query = preg_replace('/page=([0-9]*)/', 'page='.$next, $pagestring);
					$pagination .= "<a href=\"$targetpage?$url_query\">SIGUIENTE&raquo;</a>";
				}				
			}
			else
				$pagination .= "<span class=\"disabled\">ULTIMO&raquo;</span>";				
			$pagination .= "</div>\n";
		}
//	}	
	return $pagination;

}

function url_validate($url){
 $url = trim($url) ;
 if(tep_not_null($url) ){
 if(strtoupper(substr($url,0,7))!='HTTP://'){
 $link_ = 'http://'.$url;
 }else{ 
 $link_ = $url;
 }
 }else{
 $link_ = '' ;
 }
 return $link_ ;
}

function deleteFiles($path, $file) {
if(tep_not_null($file)) {
	$path = rtrim($path, '/') . '/';
	
	if (!file_exists($path))
		return false;
	
	if (file_exists($path.$file)) {
			chmod('$path.$file',0777);
			@unlink($path.$file);
	}
  }	
}

function insert($arr, $table)
{   
    while (list($_key, $_val) = each($arr))
    {
        $key[] = $_key;
        $val[] = $_val;
    }
    $arr_str = array();
    for ($i = 0; $i < count($val); $i++)
    {
        if (is_int($val[$i])) $arr_str[] = $val[$i];
        /*
		else $arr_str[] = "'" . $val[$i] . "'";
		*/
		else if(strtoupper($val[$i])=='NOW()')
		$arr_str[] = "NOW()";
		else
		$arr_str[] = "'" . $val[$i] . "'";
    }
    $fields = implode(",", $key);
    $values = implode(",", $arr_str);
    $sql = "INSERT INTO " . $table . "($fields) VALUES ($values)";
   
	$result = $GLOBALS['CONNECT_DB']->Query($sql);
    $GLOBALS['CONNECT_DB']->FreeResult($result);
	
    if ($result) return true;

    else return false;
	
	
}

function update($arr, $table, $arr_where,$orando=" AND ")
{
    while (list($_key, $_val) = each($arr))
    {
        $key[] = $_key;
        $val[] = $_val;
    }
    $arr_str = array();
    for ($i = 0; $i < count($val); $i++)
    {
        if (is_int($val[$i])) $arr_str[] = $key[$i] . "=" . $val[$i];
        else $arr_str[] = $key[$i] . "='" . $val[$i] . "'";
    }
    $values = implode(",", $arr_str);
    $key = array();
    $val = array();
    while (list($_key, $_val) = each($arr_where))
    {
        $key[] = $_key;
        $val[] = $_val;
    }
    $arr_str = array();
    for ($i = 0; $i < count($val); $i++)
    {
        if (is_int($val[$i])) $arr_str[] = $key[$i] . "=" . $val[$i];
        else $arr_str[] = $key[$i] . "='" . $val[$i] . "'";
    }
    $where = implode($orando, $arr_str);
    $sql = "UPDATE " . $table . " SET $values WHERE $where";
	
	$result = $GLOBALS['CONNECT_DB']->Query($sql);
	$GLOBALS['CONNECT_DB']->FreeResult($result);
    
	if ($result) return true;
    else return false;
	
	
}


function seems_utf8($Str) {
	for ($i=0; $i<strlen($Str); $i++) {
		if (ord($Str[$i]) <0x80) continue; # 0bbbbbbb
		elseif ((ord($Str[$i]) & 0xE0) == 0xC0) $n=1; # 110bbbbb
		elseif ((ord($Str[$i]) & 0xF0) == 0xE0) $n=2; # 1110bbbb
		elseif ((ord($Str[$i]) & 0xF8) == 0xF0) $n=3; # 11110bbb
		elseif ((ord($Str[$i]) & 0xFC) == 0xF8) $n=4; # 111110bb
		elseif ((ord($Str[$i]) & 0xFE) == 0xFC) $n=5; # 1111110b
		else return false; # Does not match any model
		for ($j=0; $j<$n; $j++) { # n bytes matching 10bbbbbb follow ?
			if ((++$i == strlen($Str)) || ((ord($Str[$i]) & 0xC0) != 0x80))
			return false;
		}
	}
	return true;
}
function remove_accents($string) {
	if ( !preg_match('/[\x80-\xff]/', $string) )
		return $string;
	if (seems_utf8($string)) {
		$chars = array(
		chr(195).chr(128) => 'A', chr(195).chr(129) => 'A',
		chr(195).chr(130) => 'A', chr(195).chr(131) => 'A',
		chr(195).chr(132) => 'A', chr(195).chr(133) => 'A',
		chr(195).chr(135) => 'C', chr(195).chr(136) => 'E',
		chr(195).chr(137) => 'E', chr(195).chr(138) => 'E',
		chr(195).chr(139) => 'E', chr(195).chr(140) => 'I',
		chr(195).chr(141) => 'I', chr(195).chr(142) => 'I',
		chr(195).chr(143) => 'I', chr(195).chr(145) => 'N',
		chr(195).chr(146) => 'O', chr(195).chr(147) => 'O',
		chr(195).chr(148) => 'O', chr(195).chr(149) => 'O',
		chr(195).chr(150) => 'O', chr(195).chr(153) => 'U',
		chr(195).chr(154) => 'U', chr(195).chr(155) => 'U',
		chr(195).chr(156) => 'U', chr(195).chr(157) => 'Y',
		chr(195).chr(159) => 's', chr(195).chr(160) => 'a',
		chr(195).chr(161) => 'a', chr(195).chr(162) => 'a',
		chr(195).chr(163) => 'a', chr(195).chr(164) => 'a',
		chr(195).chr(165) => 'a', chr(195).chr(167) => 'c',
		chr(195).chr(168) => 'e', chr(195).chr(169) => 'e',
		chr(195).chr(170) => 'e', chr(195).chr(171) => 'e',
		chr(195).chr(172) => 'i', chr(195).chr(173) => 'i',
		chr(195).chr(174) => 'i', chr(195).chr(175) => 'i',
		chr(195).chr(177) => 'n', chr(195).chr(178) => 'o',
		chr(195).chr(179) => 'o', chr(195).chr(180) => 'o',
		chr(195).chr(181) => 'o', chr(195).chr(182) => 'o',
		chr(195).chr(182) => 'o', chr(195).chr(185) => 'u',
		chr(195).chr(186) => 'u', chr(195).chr(187) => 'u',
		chr(195).chr(188) => 'u', chr(195).chr(189) => 'y',
		chr(195).chr(191) => 'y',
		chr(196).chr(128) => 'A', chr(196).chr(129) => 'a',
		chr(196).chr(130) => 'A', chr(196).chr(131) => 'a',
		chr(196).chr(132) => 'A', chr(196).chr(133) => 'a',
		chr(196).chr(134) => 'C', chr(196).chr(135) => 'c',
		chr(196).chr(136) => 'C', chr(196).chr(137) => 'c',
		chr(196).chr(138) => 'C', chr(196).chr(139) => 'c',
		chr(196).chr(140) => 'C', chr(196).chr(141) => 'c',
		chr(196).chr(142) => 'D', chr(196).chr(143) => 'd',
		chr(196).chr(144) => 'D', chr(196).chr(145) => 'd',
		chr(196).chr(146) => 'E', chr(196).chr(147) => 'e',
		chr(196).chr(148) => 'E', chr(196).chr(149) => 'e',
		chr(196).chr(150) => 'E', chr(196).chr(151) => 'e',
		chr(196).chr(152) => 'E', chr(196).chr(153) => 'e',
		chr(196).chr(154) => 'E', chr(196).chr(155) => 'e',
		chr(196).chr(156) => 'G', chr(196).chr(157) => 'g',
		chr(196).chr(158) => 'G', chr(196).chr(159) => 'g',
		chr(196).chr(160) => 'G', chr(196).chr(161) => 'g',
		chr(196).chr(162) => 'G', chr(196).chr(163) => 'g',
		chr(196).chr(164) => 'H', chr(196).chr(165) => 'h',
		chr(196).chr(166) => 'H', chr(196).chr(167) => 'h',
		chr(196).chr(168) => 'I', chr(196).chr(169) => 'i',
		chr(196).chr(170) => 'I', chr(196).chr(171) => 'i',
		chr(196).chr(172) => 'I', chr(196).chr(173) => 'i',
		chr(196).chr(174) => 'I', chr(196).chr(175) => 'i',
		chr(196).chr(176) => 'I', chr(196).chr(177) => 'i',
		chr(196).chr(178) => 'IJ',chr(196).chr(179) => 'ij',
		chr(196).chr(180) => 'J', chr(196).chr(181) => 'j',
		chr(196).chr(182) => 'K', chr(196).chr(183) => 'k',
		chr(196).chr(184) => 'k', chr(196).chr(185) => 'L',
		chr(196).chr(186) => 'l', chr(196).chr(187) => 'L',
		chr(196).chr(188) => 'l', chr(196).chr(189) => 'L',
		chr(196).chr(190) => 'l', chr(196).chr(191) => 'L',
		chr(197).chr(128) => 'l', chr(197).chr(129) => 'L',
		chr(197).chr(130) => 'l', chr(197).chr(131) => 'N',
		chr(197).chr(132) => 'n', chr(197).chr(133) => 'N',
		chr(197).chr(134) => 'n', chr(197).chr(135) => 'N',
		chr(197).chr(136) => 'n', chr(197).chr(137) => 'N',
		chr(197).chr(138) => 'n', chr(197).chr(139) => 'N',
		chr(197).chr(140) => 'O', chr(197).chr(141) => 'o',
		chr(197).chr(142) => 'O', chr(197).chr(143) => 'o',
		chr(197).chr(144) => 'O', chr(197).chr(145) => 'o',
		chr(197).chr(146) => 'OE',chr(197).chr(147) => 'oe',
		chr(197).chr(148) => 'R',chr(197).chr(149) => 'r',
		chr(197).chr(150) => 'R',chr(197).chr(151) => 'r',
		chr(197).chr(152) => 'R',chr(197).chr(153) => 'r',
		chr(197).chr(154) => 'S',chr(197).chr(155) => 's',
		chr(197).chr(156) => 'S',chr(197).chr(157) => 's',
		chr(197).chr(158) => 'S',chr(197).chr(159) => 's',
		chr(197).chr(160) => 'S', chr(197).chr(161) => 's',
		chr(197).chr(162) => 'T', chr(197).chr(163) => 't',
		chr(197).chr(164) => 'T', chr(197).chr(165) => 't',
		chr(197).chr(166) => 'T', chr(197).chr(167) => 't',
		chr(197).chr(168) => 'U', chr(197).chr(169) => 'u',
		chr(197).chr(170) => 'U', chr(197).chr(171) => 'u',
		chr(197).chr(172) => 'U', chr(197).chr(173) => 'u',
		chr(197).chr(174) => 'U', chr(197).chr(175) => 'u',
		chr(197).chr(176) => 'U', chr(197).chr(177) => 'u',
		chr(197).chr(178) => 'U', chr(197).chr(179) => 'u',
		chr(197).chr(180) => 'W', chr(197).chr(181) => 'w',
		chr(197).chr(182) => 'Y', chr(197).chr(183) => 'y',
		chr(197).chr(184) => 'Y', chr(197).chr(185) => 'Z',
		chr(197).chr(186) => 'z', chr(197).chr(187) => 'Z',
		chr(197).chr(188) => 'z', chr(197).chr(189) => 'Z',
		chr(197).chr(190) => 'z', chr(197).chr(191) => 's',
		chr(226).chr(130).chr(172) => 'E',
		chr(194).chr(163) => '');
		$string = strtr($string, $chars);
	} else {
		// Assume ISO-8859-1 if not UTF-8
		$chars['in'] = chr(128).chr(131).chr(138).chr(142).chr(154).chr(158)
			.chr(159).chr(162).chr(165).chr(181).chr(192).chr(193).chr(194)
			.chr(195).chr(196).chr(197).chr(199).chr(200).chr(201).chr(202)
			.chr(203).chr(204).chr(205).chr(206).chr(207).chr(209).chr(210)
			.chr(211).chr(212).chr(213).chr(214).chr(216).chr(217).chr(218)
			.chr(219).chr(220).chr(221).chr(224).chr(225).chr(226).chr(227)
			.chr(228).chr(229).chr(231).chr(232).chr(233).chr(234).chr(235)
			.chr(236).chr(237).chr(238).chr(239).chr(241).chr(242).chr(243)
			.chr(244).chr(245).chr(246).chr(248).chr(249).chr(250).chr(251)
			.chr(252).chr(253).chr(255);
		$chars['out'] = "EfSZszYcYuAAAAAACEEEEIIIINOOOOOOUUUUYaaaaaaceeeeiiiinoooooouuuuyy";
		$string = strtr($string, $chars['in'], $chars['out']);
		$double_chars['in'] = array(chr(140), chr(156), chr(198), chr(208), chr(222), chr(223), chr(230), chr(240), chr(254));
		$double_chars['out'] = array('OE', 'oe', 'AE', 'DH', 'TH', 'ss', 'ae', 'dh', 'th');
		$string = str_replace($double_chars['in'], $double_chars['out'], $string);
	}
	return $string;
}


#REMOVE ATRIBUTES TEXT
function RemoveCurseWords($original) {
$patterns = explode("\r\n",file_get_contents("censor_words.txt"));
$finalremove=$original;
$piece_front="";
$piece_back="";
$piece_replace="***";

    for ($x=0; $x < count($patterns); $x++) {
    $safety=0; 
        while(@strstr(strtolower($finalremove), strtolower($patterns[$x]))) {
        # find & remove all occurrence    
        $safety=$safety+1;
        if ($safety >= 100000) { break; }

        $occ=strpos(strtolower($finalremove),strtolower($patterns[$x]));
        $piece_front=substr($finalremove,0,$occ);
        $piece_back=substr($finalremove,($occ+strlen($patterns[$x])));
        $finalremove=$piece_front . $piece_replace . $piece_back;
        } # while
        
    } # for

return $finalremove;
}

//$allowedTags = '<b><i><br>';
$allowedTags = '';
$stripAttrib = 'javascript:|onclick|ondblclick|onmousedown|onmouseup|onmouseover|'.
				'onblur|onchange|onfocus|onload|onsubmit|style|font|'.
               'onmousemove|onmouseout|onkeypress|onkeydown|onkeyup|object|object';
function removeEvilAttributes($tagSource)
{
   global $stripAttrib;
   return stripslashes(preg_replace("/$stripAttrib/i", 'forbidden', $tagSource));
}
function removeEvilTags($source)
{
   global $allowedTags;
   $source = RemoveCurseWords(strip_tags($source, $allowedTags));
   return preg_replace('/<(.*?)>/ie', "'<'.removeEvilAttributes('\\1').'>'", $source);
}

function fewchars($s, $lenght) 
{
  /*$str_to_count = html_entity_decode($s);*/
  $str_to_count = $s;
  if (strlen($str_to_count) <= $lenght) 
  {
  	return $s;
  }

  $s2 = substr($str_to_count, 0, $lenght - 3);
  $s2 .= "...";
  return $s2;
} 



function isc_substr($str, $start, $length=0)
{
	if(function_exists("mb_substr")) {
		if($length == 0) {
			return mb_substr($str, $start);
		}
		else {
			return mb_substr($str, $start, $length);
		}
	}
	else {
		if($length == 0) {
			return substr($str, $start);
		}
		else {
			return substr($str, $start, $length);
		}
	}
}


function isc_substr_count($haystack, $needle)
{
	if(function_exists("mb_substr_count")) {
		return mb_substr_count($haystack, $needle);
	}
	else {
		return substr_count($haystack, $needle);
	}
}

function isc_strpos($haystack, $needle, $offset=0)
{
	if(function_exists("mb_strpos")) {
		return mb_strpos($haystack, $needle, $offset);
	}
	else {
		return strpos($haystack, $needle, $offset);
	}
}

function is_email_address($email)
	{
		// If the email is empty it can't be valid
		if (empty($email)) {
			return false;
		}

		// If the email doesnt have exactle 1 @ it isnt valid
		if (isc_substr_count($email, '@') != 1) {
			return false;
		}

		$matches = array();
		$local_matches = array();
		preg_match(':^([^@]+)@([a-zA-Z0-9\-][a-zA-Z0-9\-\.]{0,254})$:', $email, $matches);

		if (count($matches) != 3) {
			return false;
		}

		$local = $matches[1];
		$domain = $matches[2];

		// If the local part has a space but isnt inside quotes its invalid
		if (isc_strpos($local, ' ') && (isc_substr($local, 0, 1) != '"' || isc_substr($local, -1, 1) != '"')) {
			return false;
		}

		// If there are not exactly 0 and 2 quotes
		if (isc_substr_count($local, '"') != 0 && isc_substr_count($local, '"') != 2) {
			return false;
		}

		// if the local part starts or ends with a dot (.)
		if (isc_substr($local, 0, 1) == '.' || isc_substr($local, -1, 1) == '.') {
			return false;
		}

		// If the local string doesnt start and end with quotes
		if ((isc_strpos($local, '"') || isc_strpos($local, ' ')) && (isc_substr($local, 0, 1) != '"' || isc_substr($local, -1, 1) != '"')) {
			return false;
		}

		preg_match(':^([\ \"\w\!\#\$\%\&\'\*\+\-\/\=\?\^\_\`\{\|\}\~\.]{1,64})$:', $local, $local_matches);

		// Check the domain has at least 1 dot in it
		if (isc_strpos($domain, '.') === false) {
			return false;
		}

		if (!empty($local_matches) ) {
			return true;
		} else {
			return false;
		}
	}


function tep_parse_input_field_data($data, $parse) {
    return strtr(trim($data), $parse);
  }

  function tep_output_string($string, $translate = false, $protected = false) {
    if ($protected == true) {
      return htmlspecialchars($string);
    } else {
      if ($translate == false) {
        return tep_parse_input_field_data($string, array('"' => '&quot;'));
      } else {
        return tep_parse_input_field_data($string, $translate);
      }
    }
  }
  

function tep_image($src, $alt = '', $width = '', $height = '', $parameters = '') {
    if ( empty($src)  ) {
      return false;
    }

    $image = '<img src="' . tep_output_string($src) . '" border="0" alt="' . tep_output_string($alt) . '"';

    if (tep_not_null($alt)) {
      $image .= ' title=" ' . tep_output_string($alt) . ' "';
    }

    if (tep_not_null($width) && tep_not_null($height)) {
      $image .= ' width="' . tep_output_string($width) . '" height="' . tep_output_string($height) . '"';
    }

    if (tep_not_null($parameters)) $image .= ' ' . $parameters;

    $image .= '>';

    return $image;
  }



function tep_href_link($page = '', $parameters = '', $add_session_id = false) {
    
	global $request_type, $session_started, $SID;

    if (!tep_not_null($page)) {
      die('<br><br><font color="#ff0000"><b>Error!</b></font><br><br><b>No se puede determinar el vínculo de la página!<br><br>');
    }

    if (tep_not_null($parameters)) {
      $link .= $page . '?' . tep_output_string($parameters);
      $separator = '&';
    } else {
      $link .= $page;
      $separator = '?';
    }

    while ( (substr($link, -1) == '&') || (substr($link, -1) == '?') ) $link = substr($link, 0, -1);

// Add the session ID when moving from different HTTP and HTTPS servers, or when SID is defined
    if ( ($add_session_id == true) && ($session_started == true) && (SESSION_FORCE_COOKIE_USE == 'False') ) {
      if (tep_not_null($SID)) {
        $_sid = $SID;
      } 
    }

    if (isset($_sid)) {
      $link .= $separator . tep_output_string($_sid);
    }

    return $link;
  }

  function tep_get_all_get_params($exclude_array = '') {
    global $_GET;

    if (!is_array($exclude_array)) $exclude_array = array();

    $get_url = '';
    if (is_array($_GET) && (sizeof($_GET) > 0)) {
      reset($_GET);
      while (list($key, $value) = each($_GET)) {
        if ( (strlen($value) > 0) && ($key != tep_session_name()) && ($key != 'error') && (!in_array($key, $exclude_array)) && ($key != 'x') && ($key != 'y') ) {
          $get_url .= $key . '=' . rawurlencode(stripslashes($value)) . '&';
        }
      }
    }

    return $get_url;
  }
  
function tep_draw_textarea_field($name, $wrap, $width, $height, $text = '', $parameters = '', $reinsert_value = true) {
global $_GET, $_POST;
	$field = '<textarea name="' . tep_output_string($name) . '" wrap="' . tep_output_string($wrap) . '" cols="' . tep_output_string($width) . '" rows="' . 	tep_output_string($height) . '"';
	if (tep_not_null($parameters)) $field .= ' ' . $parameters;
   
       $field .= '>';
   
       if ( ($reinsert_value == true) && ( (isset($_GET[$name]) && is_string($_GET[$name])) || (isset($_POST[$name]) && is_string($_POST[$name])) ) ) {
         if (isset($_GET[$name]) && is_string($_GET[$name])) {
           $field .= tep_output_string_protected(stripslashes($_GET[$name]));
         } elseif (isset($_POST[$name]) && is_string($_POST[$name])) {
           $field .= tep_output_string_protected(stripslashes($_POST[$name]));
         }
       } elseif (tep_not_null($text)) {
         $field .= tep_output_string_protected($text);
       }
   
       $field .= '</textarea>';
   
       return $field;
}  

function tep_draw_input_field($name, $value = '', $parameters = '', $required = false, $type = 'text', $reinsert_value = true) {
    global $_GET, $_POST, $_REQUEST;

    $field = '<input type="' . tep_output_string($type) . '" name="' . tep_output_string($name) . '"';

    if ( ($reinsert_value == true) && ( (isset($_GET[$name]) && is_string($_GET[$name])) || (isset($_POST[$name]) && is_string($_POST[$name])) ) ) {
      if (isset($_GET[$name]) && is_string($_GET[$name])) {
        $value = stripslashes($_GET[$name]);
      } elseif (isset($_POST[$name]) && is_string($_POST[$name])) {
        $value = stripslashes($_POST[$name]);
      }
	  elseif (isset($_REQUEST[$name]) && is_string($_REQUEST[$name])) {
        $value = stripslashes($_REQUEST[$name]);
      }
    }

    if (tep_not_null($value)) {
      $field .= ' value="' . tep_output_string($value) . '"';
    }

    if (tep_not_null($parameters)) $field .= ' ' . $parameters;

    $field .= '>';

    if ($required == true) $field .= " <span class=\"required\">*</span>";

    return $field;
  }
  
  
  

function noCache() {
  header("Expires: Tue, 01 Jul 2001 06:00:00 GMT");
  header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
  header("Cache-Control: no-store, no-cache, must-revalidate");
  header("Cache-Control: post-check=0, pre-check=0", false);
  header("Pragma: no-cache");
}

function generate_unique_id(){
	return substr(md5(uniqid(time(), true)), 0, 20);
}

function change2ymd($date) //input format: yyyy-m-d to m/d/yy
{

	if (preg_match ("/^([0-9]{4})-([0-9]{2})-([0-9]{2})$/", $date, $parts)){
		  if(checkdate($parts[2],$parts[3],$parts[1])) {
			$dtmp = explode('-',$date);
			$dadate = mktime(0,0,0,$dtmp[1],$dtmp[2],$dtmp[0]);
			return date('m/d/Y',$dadate);
		 }
	}
}

function change2mdy($date) //input format: m/d/yy to yy-m-d
{
	 if (preg_match ("/^([0-9]{2})\/([0-9]{2})\/([0-9]{4})$/", $date, $parts)){
		 if(checkdate($parts[1],$parts[2],$parts[3])) {
			$dtmp = explode('/',$date);
			//print "$dtmp[0],$dtmp[1],$dtmp[2]<br>";
			$dadate = mktime(0,0,0,$dtmp[0],$dtmp[1],$dtmp[2]);
			return date('Y-m-d',$dadate);
		}
	}
}

function formatDate($dDate){
$dNewDate = strtotime($dDate);
return date('d-m-Y',$dNewDate);
}

function sizefile_server($path, $formated = true, $retstring = null){
	if(!is_dir($path) || !is_readable($path)){
		if(is_file($path) || file_exists($path)){
			$size = filesize($path);
		} else {
			return false;
		}
	} else {
		$path_stack[] = $path;
		$size = 0;
		do {
			$path   = array_shift($path_stack);
			$handle = opendir($path);
			while(false !== ($file = readdir($handle))) {
				if($file != '.' && $file != '..' && is_readable($path . DIRECTORY_SEPARATOR . $file)) {
					if(is_dir($path . DIRECTORY_SEPARATOR . $file)){ $path_stack[] = $path . DIRECTORY_SEPARATOR . $file; }
					$size += filesize($path . DIRECTORY_SEPARATOR . $file);
				}
			}
			closedir($handle);
		} while (count($path_stack)> 0);
	}
	if($formated){
		$sizes = array('B', 'kB', 'MB', 'GB', 'TB', 'PB', 'EB', 'ZB', 'YB');
		if($retstring == null) { $retstring = '%01.2f %s'; }
		$lastsizestring = end($sizes);
		foreach($sizes as $sizestring){
			if($size <1024){ break; }
			if($sizestring != $lastsizestring){ $size /= 1024; }
		}
		if($sizestring == $sizes[0]){ $retstring = '%01d %s'; } // los Bytes normalmente no son fraccionales
		$size = sprintf($retstring, $size, $sizestring);
	}
	return $size;
}

function sendCorreo($aTo, $aFrom, $aSubject, $array_content, $template)
{
    # template body
	$filename = $template;
	$fd = fopen ($filename, "r");
	$mailcontent = fread ($fd, filesize ($filename));						
	foreach ($array_content as $key=>$value)
	{
	$mailcontent = str_replace("%%$value[0]%%", $value[1],$mailcontent );
	}
	$mailcontent = stripslashes($mailcontent);					
	fclose ($fd);
	// close template
	
	//$headers = "From: $aFrom\r\n";
	
	@ini_set(sendmail_from, $aFrom);
	$aHeader .= "Content-type: text/html; charset=iso-8859-2";
	$aHeader .= "X-Priority: 1 (Higuest)\n"; 
    $aHeader .= "X-MSMail-Priority: High\n";
	$aHeader .= "Return-Path: $aFrom\n";
	$aHeader .= "X-Sender: $aFrom\n";
	$aHeader .= "From: $aFrom <$aFrom>\n";
	$aHeader .= "X-Mailer:PHP 5.1\n";
	$aHeader .= "MIME-Version: 1.0\n";
 
	mail($aTo,$aSubject,$mailcontent,$aHeader);
 return true;
}

function sendEmail($aTo, $aFrom, $aSubject, $array_content, $template)
{
    # template body
	$filename = $template;
	$fd = fopen ($filename, "r");
	$mailcontent = fread ($fd, filesize ($filename));						
	foreach ($array_content as $key=>$value)
	{
	$mailcontent = str_replace("%%$value[0]%%", $value[1],$mailcontent );
	}
	$mailcontent = stripslashes($mailcontent);					
	fclose ($fd);
	// close template
	
	//$headers = "From: $aFrom\r\n";
	
	@ini_set(sendmail_from, $aFrom);
	//$aHeader .= "Content-type: text/plain; charset=iso-8859-2";
	$aHeader .= "Content-type: text/html; charset=iso-8859-2";
	$aHeader .= "X-Priority: 1 (Higuest)\n"; 
    $aHeader .= "X-MSMail-Priority: High\n";
	$aHeader .= "Return-Path: $aFrom\n";
	$aHeader .= "X-Sender: $aFrom\n";
	$aHeader .= "From: $aFrom <$aFrom>\n";
	$aHeader .= "X-Mailer:PHP 5.1\n";
	$aHeader .= "MIME-Version: 1.0\n";
 
	mail($aTo,$aSubject,$mailcontent,$aHeader);
 return true;
}
?>