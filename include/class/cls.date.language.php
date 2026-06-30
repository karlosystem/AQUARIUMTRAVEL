<?php
class  dateconvert_language {
var $language = 'en' ; # English 1 | Español 2

function get_date_spanish( $time, $part = false, $formatDate = '' ){
    #Declare n compatible arrays
	$strreturn = "";
	switch ($this->language) {
	
	case 'en': # Ingles
	
    $month = array("","January", "February", "March", "April", "May", "June", "July", "August", "September", "October","November","December");#n
	$month_execute = "n"; #format for array month

    $month_mini = array("","Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Ago", "Sep", "Oct", "Nov", "Dec");#n
    $month_mini_execute = "n"; #format for array month

    $day = array("Sunday","Monday","Tuesday","Wednesday","Thursday","Friday","Saturday"); #w
    $day_execute = "w";
    
    $day_mini = array("Sun","Mon","Tue","Wed","Thu","Fri","Sat"); #w
    $day_mini_execute = "w";
    
	//$str_return = "%%NAMEMONTH%% %%NUMDAY%%, %%NUMYEAR%%, %%NUMHOURS%% hrs";
	$str_return = "%%NAMEMONTH%% %%NUMDAY%%, %%NUMYEAR%%";
	break ;
	
	case 'es': #Español
	$month = array("","Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre","Noviembre","Diciembre");#n
	$month_execute = "n"; #format for array month

    $month_mini = array("","Ene", "Feb", "Mar", "Abr", "May", "Jun", "Jul", "Ago", "Sep", "Oct", "Nov", "Dic");#n
    $month_mini_execute = "n"; #format for array month

    $day = array("Domingo","Lune","Martes","Miércoles","Jueves","Viernes","Sábado"); #w
    $day_execute = "w";
    
    $day_mini = array("Dom","Lun","Mar","Mie","Jue","Vie","Sáb"); #w
    $day_mini_execute = "w";
	
	//$str_return = "%%NUMDAY%% de %%NAMEMONTH%% del %%NUMYEAR%%, %%NUMHOURS%% hrs";
	$str_return = "%%NUMDAY%% de %%NAMEMONTH%% del %%NUMYEAR%%";
	break ;
	
	
	}
/*
Other examples:
    Whether it's a leap year
    $leapyear = array("Este año febrero tendrá 28 días"."Si, estamos en un año bisiesto, un día más para trabajar!"); #l
     $leapyear_execute = "L";
*/

    #Content array exception print "HOY", position content the name array. Duplicate value and key for optimization in comparative
    $print_hoy = array("month"=>"month", "month_mini"=>"month_mini");

    if( $part === false ){
        //return date("d", $time) . " de " . $month[date("n",$time)] . " del ". date("Y", $time) .", ". date("H:i",$time) ." hrs";
    $strreturn = str_replace("%%NUMDAY%%",date("d", $time),$str_return);
	$strreturn = str_replace("%%NAMEMONTH%%",$month[date("n",$time)],$strreturn);
	$strreturn = str_replace("%%NUMYEAR%%",date("Y", $time),$strreturn);
	$strreturn = str_replace("%%NUMHOURS%%",date("H:i",$time),$strreturn);
	return  $strreturn ;
	}elseif( $part === true ){
        if( ! empty( $print_hoy[$formatDate] ) && date("d-m-Y", $time ) == date("d-m-Y") ) return "HOY"; #Exception HOY
        if( ! empty( ${$formatDate} ) && !empty( ${$formatDate}[date(${$formatDate.'_execute'},$time)] ) ) return ${$formatDate}[date(${$formatDate.'_execute'},$time)];
        else return date($formatDate, $time);
    }else{
        return date("d-m-Y H:i", $time);
    }
}


}
/*
$cls_date = new dateconvert_language;
$cls_date->language = 1 ;

echo $cls_date->get_date_spanish(time());
*/
?>