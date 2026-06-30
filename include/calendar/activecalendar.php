<?php
/*
* @class: activeCalendar
* @project: Active Calendar Class
* @version: 0.6 (stable);
* @author: Giorgos Tsiledakis;
* @date: 2004-09-19;
* @license: GNU GENERAL PUBLIC LICENSE;
*
* This class generates calendars as a html table
* Supported views: month and year view
* Supported features:
* 1. Static calendar
* 2. Calendar with month's or year's view navigation controls
* 3. Calendar with day links (with or without navigation controls)
* The layout of the generated calendar can be configured using css (check the css file included)
* Please read the readme.html first and check the examples and the testsuite included in this package
*/
class activeCalendar{
/*
********************************************************************************
You can change below the month and day names, according to your language
********************************************************************************
*/
var $jan="Enero";
var $feb="Febrero";
var $mar="Marzo";
var $apr="Abril";
var $may="Mayo";
var $jun="Junio";
var $jul="Julio";
var $aug="Agosto";
var $sep="Septiembre";
var $oct="Octubre";
var $nov="Noviembre";
var $dec="Diciembre";
var $sun="Dom";
var $mon="Lun";
var $tue="Mar";
var $wed="Mie";
var $thu="Jue";
var $fri="Vie";
var $sat="Sab";
/*
********************************************************************************
You can change below the year's and month's view navigation controls
********************************************************************************
*/
var $yearNavBack="<< Año Anterior"; // Previus year 
var $yearNavForw="Año Siguiente >>"; // Next year
var $monthNavBack="<<"; // Previus month
var $monthNavForw=">>"; // Next month
/*
********************************************************************************
You can change below the GET VARS NAMES (day links)
********************************************************************************
*/
var $yearID="yearID";
var $monthID="monthID";
var $dayID="dayID";
/*
********************************************************************************
$startOnSun = false: first day of week is Monday
$startOnSun = true: first day of week is Sunday
********************************************************************************
*/
var $startOnSun=false;
/*
********************************************************************************
You can change below only if you know what you are doing :)
********************************************************************************
*/
var $yearNav=false; // true enables the year's view navigation controls (set by enableYearNav())
var $monthNav=false; // true enables the months's view navigation controls (set by enableMonthNav())
var $dayLinks=false; // true enables links on each day (set by enableDayLinks())
var $url=""; // the day links url (set by enableYearNav or enableMonthNav or enableDayLinks())
/*
********************************************************************************
activeCalendar() -> class constructor, does the main date calculation
********************************************************************************
*/
function activeCalendar($year=false,$month=false,$day=false){
$this->selectedday=-2;
$this->selectedyear=$year;
$this->selectedmonth=$month;
if (!$month) $month=1;
if (!$day) $day=1;
else $this->selectedday=$day;
$this->unixtime=mktime(0,0,1,$month,$day,$year);
if ($this->unixtime==-1 || !$year) $this->unixtime=time();
$this->timenow=time();
$this->daytoday=date("j");
$this->monthtoday=date("n");
$this->yeartoday=date("Y");
$this->actday=date("j",$this->unixtime);
$this->actmonth=date("n",$this->unixtime);
$this->actyear=date("Y",$this->unixtime);
$this->has31days=checkdate($this->actmonth,31,$this->actyear);
$this->isSchalt=checkdate(2,29,$this->actyear);
if ($this->isSchalt==1 && $this->actmonth==2) $this->maxdays=29;
elseif ($this->isSchalt!=1 && $this->actmonth==2) $this->maxdays=28;
elseif ($this->has31days==1) $this->maxdays=31;
else $this->maxdays=30;
$this->firstday=date("w", mktime(0,0,1,$this->actmonth,1,$this->actyear));
}
/*
********************************************************************************
enableYearNav() -> enables the year's navigation controls
********************************************************************************
*/
function enableYearNav($link=false){
if ($link) $this->url=$link;
$this->yearNav=true;
}
/*
********************************************************************************
enableMonthNav() -> enables the month's navigation controls
********************************************************************************
*/
function enableMonthNav($link=false){
if ($link) $this->url=$link;
$this->monthNav=true;
}
/*
********************************************************************************
enableDayLinks() -> enables the day links
********************************************************************************
*/
function enableDayLinks($link=false){
if ($link) $this->url=$link;
$this->dayLinks=true;
}
/*
********************************************************************************
showYear() -> returns the year's view as html table string
********************************************************************************
*/
function showYear(){
if ($this->dayLinks) return $this->showLinkedYear();
$out="<table id=\"year\">\n";
if (!$this->yearNav){
$out.="<tr><td colspan=\"4\" id=\"yearname\">";
$out.=$this->actyear;
$out.="</td></tr>\n";
}
else{
$out.="<tr><td colspan=\"1\" id=\"yearnavigation\">";
$out.="<a href=\"".$this->url."?".$this->yearID."=".($this->actyear-1)."\">";
$out.=$this->yearNavBack."</a></td>";
$out.="<td colspan=\"2\" id=\"yearname\">".$this->actyear."</td>";
$out.="<td colspan=\"1\" id=\"yearnavigation\">";
$out.="<a href=\"".$this->url."?".$this->yearID."=".($this->actyear+1)."\">";
$out.=$this->yearNavForw."</a></td></tr>\n";
}
$out.="<tr>\n";
for ($x=1; $x<=4; $x++) {
$this->activeCalendar($this->actyear,$x);
$out.="<td valign=\"top\">".$this->showMonth()."</td>\n";
}
$out.="</tr>\n";
$out.="<tr>\n";
for ($x=5; $x<=8; $x++) {
$this->activeCalendar($this->actyear,$x);
$out.="<td valign=\"top\">".$this->showMonth()."</td>\n";
}
$out.="</tr>\n";
$out.="<tr>\n";
for ($x=9; $x<=12; $x++) {
$this->activeCalendar($this->actyear,$x);
$out.="<td valign=\"top\">".$this->showMonth()."</td>\n";
}
$out.="</tr>\n";
$out.="</table>\n";
return $out;
}
/*
********************************************************************************
showMonth() -> returns the month's view as html table string
********************************************************************************
*/
function showMonth(){
if ($this->dayLinks) return $this->showLinkedMonth();
$out="<table id=\"month\">\n";
if (!$this->monthNav){
$out.="<tr><td id=\"monthname\" colspan=\"7\">";
$out.=$this->getMonthName()." ".$this->actyear;
$out.="</td></tr>\n";
}
else{
$out.="<tr><td id=\"monthnavigation\" colspan=\"2\">";
if ($this->actmonth==1){
$out.="<a href=\"".$this->url."?".$this->yearID."=".($this->actyear-1)."&".$this->monthID."=12\">";
}
else{
$out.="<a href=\"".$this->url."?".$this->yearID."=".$this->actyear."&".$this->monthID."=".($this->actmonth-1)."\">";
}
$out.=$this->monthNavBack."</a></td>";
$out.="<td id=\"monthname\" colspan=\"3\">";
$out.=$this->getMonthName()." ".$this->actyear."</td>";
$out.="<td id=\"monthnavigation\" colspan=\"2\">";
if ($this->actmonth==12){
$out.="<a href=\"".$this->url."?".$this->yearID."=".($this->actyear+1)."&".$this->monthID."=1\">";
}
else{
$out.="<a href=\"".$this->url."?".$this->yearID."=".$this->actyear."&".$this->monthID."=".($this->actmonth+1)."\">";
}
$out.=$this->monthNavForw."</a></td></tr>\n";
}
if ($this->startOnSun){
$out.="<tr id=\"dayname\"><td>".$this->getDayName(0)."</td>";
$out.="<td>".$this->getDayName(1)."</td>";
$out.="<td>".$this->getDayName(2)."</td>";
$out.="<td>".$this->getDayName(3)."</td>";
$out.="<td>".$this->getDayName(4)."</td>";
$out.="<td>".$this->getDayName(5)."</td>";
$out.="<td>".$this->getDayName(6)."</td></tr>\n";
}
else{
$out.="<tr id=\"dayname\"><td>".$this->getDayName(1)."</td>";
$out.="<td>".$this->getDayName(2)."</td>";
$out.="<td>".$this->getDayName(3)."</td>";
$out.="<td>".$this->getDayName(4)."</td>";
$out.="<td>".$this->getDayName(5)."</td>";
$out.="<td>".$this->getDayName(6)."</td>";
$out.="<td>".$this->getDayName(0)."</td></tr>\n";
$this->firstday=$this->firstday-1;
if ($this->firstday<0) $this->firstday=6;
}
$out.="<tr>";
$monthday=0;
for ($x=0; $x<=6; $x++){
if ($x>=$this->firstday){
$monthday++;
if ($monthday<10){
if ($x==$this->daytoday && $this->actmonth==$this->monthtoday && $this->actyear==$this->yeartoday) $out.="<td id=\"today\">0".$monthday."</td>";
elseif ($monthday==$this->selectedday && $this->actmonth==$this->selectedmonth && $this->actyear==$this->selectedyear) $out.="<td id=\"selectedday\">0".$monthday."</td>";
else $out.="<td id=\"monthday\">0".$monthday."</td>";
}
else{
if ($x==$this->daytoday && $this->actmonth==$this->monthtoday && $this->actyear==$this->yeartoday) $out.="<td id=\"today\">".$monthday."</td>";
elseif ($monthday==$this->selectedday && $this->actmonth==$this->selectedmonth && $this->actyear==$this->selectedyear) $out.="<td id=\"selectedday\">".$monthday."</td>";
else $out.="<td id=\"monthday\">".$monthday."</td>";
} 
}
else{
$out.="<td id=\"nomonthday\"></td>";
}
}
$out.="</tr>\n";
$goon=$monthday+1;
$stop=0;
for ($x=0; $x<=6; $x++){
if ($goon>$this->maxdays) break;
if ($stop==1) break;
$out.="<tr>";
for ($i=$goon; $i<=$goon+6; $i++){
if ($i>$this->maxdays){
$out.="<td id=\"nomonthday\"></td>";
$stop=1;
}
else {
if ($i<10){
if ($i==$this->daytoday && $this->actmonth==$this->monthtoday && $this->actyear==$this->yeartoday) $out.="<td id=\"today\">0".$i."</td>";
elseif ($i==$this->selectedday && $this->actmonth==$this->selectedmonth && $this->actyear==$this->selectedyear) $out.="<td id=\"selectedday\">0".$i."</td>";
else $out.="<td id=\"monthday\">0".$i."</td>";
} 
else{
if ($i==$this->daytoday && $this->actmonth==$this->monthtoday && $this->actyear==$this->yeartoday) $out.="<td id=\"today\">".$i."</td>";
elseif ($i==$this->selectedday && $this->actmonth==$this->selectedmonth && $this->actyear==$this->selectedyear) $out.="<td id=\"selectedday\">".$i."</td>";
else $out.="<td id=\"monthday\">".$i."</td>";
}
}
}
$goon=$goon+7;
$out.="</tr>\n";
}
$out.="</table>\n";
$this->selectedday="-2";
return $out;
}
/*
********************************************************************************
showLinkedYear() -> creates the year's view with day links
********************************************************************************
*/
function showLinkedYear(){
$out="<table id=\"year\">\n";
if (!$this->yearNav){
$out.="<tr><td colspan=\"4\" id=\"yearname\">";
$out.=$this->actyear;
$out.="</td></tr>\n";
}
else{
$out.="<tr><td colspan=\"1\" id=\"yearnavigation\">";
$out.="<a href=\"".$this->url."?".$this->yearID."=".($this->actyear-1)."\">";
$out.=$this->yearNavBack."</a></td>";
$out.="<td colspan=\"2\" id=\"yearname\">".$this->actyear."</td>";
$out.="<td colspan=\"1\" id=\"yearnavigation\">";
$out.="<a href=\"".$this->url."?".$this->yearID."=".($this->actyear+1)."\">";
$out.=$this->yearNavForw."</a></td></tr>\n";
}
$out.="<tr>\n";
for ($x=1; $x<=4; $x++) {
$this->activeCalendar($this->actyear,$x);
$out.="<td valign=\"top\">".$this->showLinkedMonth()."</td>\n";
}
$out.="</tr>\n";
$out.="<tr>\n";
for ($x=5; $x<=8; $x++) {
$this->activeCalendar($this->actyear,$x);
$out.="<td valign=\"top\">".$this->showLinkedMonth()."</td>\n";
}
$out.="</tr>\n";
$out.="<tr>\n";
for ($x=9; $x<=12; $x++) {
$this->activeCalendar($this->actyear,$x);
$out.="<td valign=\"top\">".$this->showLinkedMonth()."</td>\n";
}
$out.="</tr>\n";
$out.="</table>\n";
return $out;
}
/*
********************************************************************************
showLinkedMonth() -> creates the months's view with day links
********************************************************************************
*/
function showLinkedMonth(){
$out="<table id=\"month\">\n";
if (!$this->monthNav){
$out.="<tr><td id=\"monthname\" colspan=\"7\">";
$out.=$this->getMonthName()." ".$this->actyear;
$out.="</td></tr>\n";
}
else{
$out.="<tr><td id=\"monthnavigation\" colspan=\"2\">";
if ($this->actmonth==1){
$out.="<a href=\"".$this->url."?".$this->yearID."=".($this->actyear-1)."&".$this->monthID."=12\">";
}
else{
$out.="<a href=\"".$this->url."?".$this->yearID."=".$this->actyear."&".$this->monthID."=".($this->actmonth-1)."\">";
}
$out.=$this->monthNavBack."</a></td>";
$out.="<td id=\"monthname\" colspan=\"3\">";
$out.=$this->getMonthName()." ".$this->actyear."</td>";
$out.="<td id=\"monthnavigation\" colspan=\"2\">";
if ($this->actmonth==12){
$out.="<a href=\"".$this->url."?".$this->yearID."=".($this->actyear+1)."&".$this->monthID."=1\">";
}
else{
$out.="<a href=\"".$this->url."?".$this->yearID."=".$this->actyear."&".$this->monthID."=".($this->actmonth+1)."\">";
}
$out.=$this->monthNavForw."</a></td></tr>\n";
}
if ($this->startOnSun){
$out.="<tr id=\"dayname\"><td>".$this->getDayName(0)."</td>";
$out.="<td>".$this->getDayName(1)."</td>";
$out.="<td>".$this->getDayName(2)."</td>";
$out.="<td>".$this->getDayName(3)."</td>";
$out.="<td>".$this->getDayName(4)."</td>";
$out.="<td>".$this->getDayName(5)."</td>";
$out.="<td>".$this->getDayName(6)."</td></tr>\n";
}
else{
$out.="<tr id=\"dayname\"><td>".$this->getDayName(1)."</td>";
$out.="<td>".$this->getDayName(2)."</td>";
$out.="<td>".$this->getDayName(3)."</td>";
$out.="<td>".$this->getDayName(4)."</td>";
$out.="<td>".$this->getDayName(5)."</td>";
$out.="<td>".$this->getDayName(6)."</td>";
$out.="<td>".$this->getDayName(0)."</td></tr>\n";
$this->firstday=$this->firstday-1;
if ($this->firstday<0) $this->firstday=6;
}
$out.="<tr>";
$monthday=0;
for ($x=0; $x<=6; $x++){
if ($x>=$this->firstday){
$monthday++;
if ($monthday<10){
if ($x==$this->daytoday && $this->actmonth==$this->monthtoday && $this->actyear==$this->yeartoday){
$out.="<td id=\"today\"><a href=\"".$this->url."?".$this->yearID."=".$this->actyear."&".$this->monthID."=".$this->actmonth."&".$this->dayID."=".$monthday."\">0".$monthday."</a></td>";
}
elseif ($monthday==$this->selectedday && $this->actmonth==$this->selectedmonth && $this->actyear==$this->selectedyear){
$out.="<td id=\"selectedday\"><a href=\"".$this->url."?".$this->yearID."=".$this->actyear."&".$this->monthID."=".$this->actmonth."&".$this->dayID."=".$monthday."\">0".$monthday."</a></td>";
}
else $out.="<td id=\"monthday\"><a href=\"".$this->url."?".$this->yearID."=".$this->actyear."&".$this->monthID."=".$this->actmonth."&".$this->dayID."=".$monthday."\">0".$monthday."</a></td>";
} 
else{
if ($x==$this->daytoday && $this->actmonth==$this->monthtoday && $this->actyear==$this->yeartoday){
$out.="<td id=\"today\"><a href=\"".$this->url."?".$this->yearID."=".$this->actyear."&".$this->monthID."=".$this->actmonth."&".$this->dayID."=".$monthday."\">".$monthday."</a></td>";
}
elseif ($monthday==$this->selectedday && $this->actmonth==$this->selectedmonth && $this->actyear==$this->selectedyear){
$out.="<td id=\"selectedday\"><a href=\"".$this->url."?".$this->yearID."=".$this->actyear."&".$this->monthID."=".$this->actmonth."&".$this->dayID."=".$monthday."\">".$monthday."</a></td>";
}
else $out.="<td id=\"monthday\"><a href=\"".$this->url."?".$this->yearID."=".$this->actyear."&".$this->monthID."=".$this->actmonth."&".$this->dayID."=".$monthday."\">".$monthday."</a></td>";
} 
}
else{
$out.="<td id=\"nomonthday\"></td>";
}
}
$out.="</tr>\n";
$goon=$monthday+1;
$stop=0;
for ($x=0; $x<=6; $x++){
if ($goon>$this->maxdays) break;
if ($stop==1) break;
$out.="<tr>";
for ($i=$goon; $i<=$goon+6; $i++){
if ($i>$this->maxdays){
$out.="<td id=\"nomonthday\"></td>";
$stop=1;
}
else {
if ($i<10){
if ($i==$this->daytoday && $this->actmonth==$this->monthtoday && $this->actyear==$this->yeartoday){
$out.="<td id=\"today\"><a href=\"".$this->url."?".$this->yearID."=".$this->actyear."&".$this->monthID."=".$this->actmonth."&".$this->dayID."=".$i."\">0".$i."</a></td>";
}
elseif ($i==$this->selectedday && $this->actmonth==$this->selectedmonth && $this->actyear==$this->selectedyear){
$out.="<td id=\"selectedday\"><a href=\"".$this->url."?".$this->yearID."=".$this->actyear."&".$this->monthID."=".$this->actmonth."&".$this->dayID."=".$i."\">0".$i."</a></td>";
}
else $out.="<td id=\"monthday\"><a href=\"".$this->url."?".$this->yearID."=".$this->actyear."&".$this->monthID."=".$this->actmonth."&".$this->dayID."=".$i."\">0".$i."</a></td>"; // chnaged
} 
else{
if ($i==$this->daytoday && $this->actmonth==$this->monthtoday && $this->actyear==$this->yeartoday){
$out.="<td id=\"today\"><a href=\"".$this->url."?".$this->yearID."=".$this->actyear."&".$this->monthID."=".$this->actmonth."&".$this->dayID."=".$i."\">".$i."</a></td>";
}
elseif ($i==$this->selectedday && $this->actmonth==$this->selectedmonth && $this->actyear==$this->selectedyear){
$out.="<td id=\"selectedday\"><a href=\"".$this->url."?".$this->yearID."=".$this->actyear."&".$this->monthID."=".$this->actmonth."&".$this->dayID."=".$i."\">".$i."</a></td>";
}
else $out.="<td id=\"monthday\"><a href=\"".$this->url."?".$this->yearID."=".$this->actyear."&".$this->monthID."=".$this->actmonth."&".$this->dayID."=".$i."\">".$i."</a></td>"; 
}
}
}
$goon=$goon+7;
$out.="</tr>\n";
}
$out.="</table>\n";
$this->selectedday="-2";
return $out;
}
/*
********************************************************************************
getMonthName() -> returns the month's name, according to the configuration
********************************************************************************
*/
function getMonthName(){
switch(@$this->actmonth){
case 1: return $this->jan;
case 2: return $this->feb;
case 3: return $this->mar;
case 4: return $this->apr;
case 5: return $this->may;
case 6: return $this->jun;
case 7: return $this->jul;
case 8: return $this->aug;
case 9: return $this->sep;
case 10: return $this->oct;
case 11: return $this->nov;
case 12: return $this->dec;
}
}
/*
********************************************************************************
getDayName() -> returns the day's name, according to the configuration
********************************************************************************
*/
function getDayName($var=false){
switch($var){
case 0: return $this->sun;
case 1: return $this->mon;
case 2: return $this->tue;
case 3: return $this->wed;
case 4: return $this->thu;
case 5: return $this->fri;
case 6: return $this->sat;
}
}
}
?>
