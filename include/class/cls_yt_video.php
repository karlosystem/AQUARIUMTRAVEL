<?php

class YouTube {


function youtubeid($url) {
        if (preg_match('%youtube\\.com/(.+)%', $url, $match)) {
                $match = $match[1];
                $replace = array("watch?v=", "v/", "vi/");
                $match = str_replace($replace, "", $match);
        }
        return $match;
}

function _GetVideoIdFromUrl($url) {
	$parts = explode('?v=',$url);
	if (count($parts) == 2) {
		$tmp = explode('&',$parts[1]);
		if (count($tmp)>1) {
			return $tmp[0];
		} else {
			return $parts[1];
		}
	} else {
		return $url;
	}
}


function EmbedVideo($videoid,$width = 425,$height = 350) {
	$videoid = $this->_GetVideoIdFromUrl($videoid);
	return '<object width="'.$width.'" height="'.$height.'"><param name="movie" value="http://www.youtube.com/v/'.$videoid.'"></param><param name="wmode" value="transparent"></param><embed src="http://www.youtube.com/v/'.$videoid.'" type="application/x-shockwave-flash" wmode="transparent" width="'.$width.'" height="'.$height.'"></embed></object>';
}

function GetImg($videoid,$imgid = 1) {
	$videoid = $this->_GetVideoIdFromUrl($videoid);
	return "http://img.youtube.com/vi/$videoid/$imgid.jpg";
}

function ShowImg($videoid,$imgid = 1,$w=130,$h=97,$alt = 'Captura de pantalla del video') {
	return "<img src='".$this->GetImg($videoid,$imgid)."' width='".$w."' height='".$h."' border='0' alt='".$alt."' title='".$alt."' />";
}

}

?>