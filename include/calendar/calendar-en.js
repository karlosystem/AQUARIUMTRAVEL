// ** I18N

// Calendar ES (spanish) language
// Author: Mihai Bazon, <mihai_bazon@yahoo.com>
// Updater: Servilio Afre Puentes <servilios@yahoo.com>
// Updated: 2004-06-03
// Encoding: utf-8
// Distributed under the same terms as the calendar itself.

// For translators: please use UTF-8 if possible.  We strongly believe that
// Unicode is the answer to a real internationalized world.  Also please
// include your contact information in the header, as can be seen above.

// full day names
Zapatec.Calendar._DN = new Array
( "Sunday",
  "Monday",
  "Tuesday",
  "Wednesday",
  "Thursday",
  "Friday",
  "Saturday",
  "Sunday");

// Please note that the following array of short day names (and the same goes
// for short month names, _SMN) isn't absolutely necessary.  We give it here
// for exemplification on how one can customize the short day names, but if
// they are simply the first N letters of the full name you can simply say:
//
//   Calendar._SDN_len = N; // short day name length
//   Calendar._SMN_len = N; // short month name length
//
// If N = 3 then this is not needed either since we assume a value of 3 if not
// present, to be compatible with translation files that were written before
// this feature.

// short day names
Zapatec.Calendar._SDN = new Array
( "Dom",
  "Lun",
  "Mar",
  "Wed",
  "Thu",
  "Vie",
  "Sat",
  "Dom");

// First day of the week. "0" means display Sunday first, "1" means display
// Monday first, etc.
Zapatec.Calendar._FD = 1;

// full month names
Zapatec.Calendar._MN = new Array
( "January",
  "February",
  "March",
  "April",
  "May",
  "June",
  "July",
  "August",
  "September",
  "October",
  "November",
  "December");

// short month names
Zapatec.Calendar._SMN = new Array
( "Jan" ,
  "Feb",
  "Mar",
  "Apr",
  "May",
  "Jun",
  "Jul",
  "Ago",
  "Sep",
  "Oct",
  "Nov",
  "Dec");

// tooltips
Zapatec.Calendar._TT_en = Zapatec.Calendar._TT = {};
Zapatec.Calendar._TT["INFO"] = "AmericanExpeditions Calendar";

Zapatec.Calendar._TT["ABOUT"] =
"elector DHTML Date/Time\n" +
"(c) dynarch.com 2002-2005 / Author: Mihai Bazon\n" + // don't translate this this ;-)
"To get the latest version visit: http://www.dynarch.com/projects/calendar/\n" +
"Distributed under license GNU LGPL. visit http://gnu.org/licenses/lgpl.html for details." +
"\n\n" +
"   Date selection:\n" +
"- Use the \xab, \xbb to select year\n" +
"- Use the " + String.fromCharCode(0x2039) + ", " + String.fromCharCode(0x203a) + " to select month\n" +
"- Hold down the mouse on any of these buttons for quick selection.";
Zapatec.Calendar._TT["ABOUT_TIME"] = "\n\n" +
"Time Selection:\n" +
"- Click on any of the time parts to increase it\n" +
"- or press Shift while clicking to actually decrease\n" +
"- or click and drag for faster selection.";


Zapatec.Calendar._TT [ "PREV_YEAR"] = "Año anterior (hold for menu)";
Zapatec.Calendar._TT [ "PREV_MONTH"] = "Mes anterior (hold for menu)";
Zapatec.Calendar._TT [ "GO_TODAY"] = "Go Today";
Zapatec.Calendar._TT [ "NEXT_MONTH"] = "Next month (hold for menu)";
Zapatec.Calendar._TT [ "NEXT_YEAR"] = "Next year (hold for menu)";
Zapatec.Calendar._TT [ "SEL_DATE"] = "Select date";
Zapatec.Calendar._TT [ "DRAG_TO_MOVE"] = "Drag to move";
Zapatec.Calendar._TT [ "PART_TODAY"] = "(today)";

// the following is to inform that "%s" is to be the first day of week
// %s will be replaced with the day name.
	
Zapatec.Calendar._TT [ "DAY_FIRST"] = "Make %s first day of the week";

// This may be locale-dependent.  It specifies the week-end days, as an array
// of comma-separated numbers.  The numbers are from 0 to 6: 0 means Sunday, 1
// means Monday, etc.
Zapatec.Calendar._TT["WEEKEND"] = "0,6";

Zapatec.Calendar._TT["CLOSE"] = "Close";
Zapatec.Calendar._TT["TODAY"] = "Today";
Zapatec.Calendar._TT["TIME_PART"] = "(Shift-) Click or drag to change value";

// date formats
Zapatec.Calendar._TT["DEF_DATE_FORMAT"] = "%d/%m/%Y";
Zapatec.Calendar._TT["TT_DATE_FORMAT"] = "%A, %e de %B de %Y";

Zapatec.Calendar._TT["WK"] = "wk";
Zapatec.Calendar._TT["TIME"] = "Time:";

/* Preserve data */
	if(Zapatec.Calendar._DN) Zapatec.Calendar._TT._DN = Zapatec.Calendar._DN;
	if(Zapatec.Calendar._SDN) Zapatec.Calendar._TT._SDN = Zapatec.Calendar._SDN;
	if(Zapatec.Calendar._SDN_len) Zapatec.Calendar._TT._SDN_len = Zapatec.Calendar._SDN_len;
	if(Zapatec.Calendar._MN) Zapatec.Calendar._TT._MN = Zapatec.Calendar._MN;
	if(Zapatec.Calendar._SMN) Zapatec.Calendar._TT._SMN = Zapatec.Calendar._SMN;
	if(Zapatec.Calendar._SMN_len) Zapatec.Calendar._TT._SMN_len = Zapatec.Calendar._SMN_len;
	Zapatec.Calendar._DN = Zapatec.Calendar._SDN = Zapatec.Calendar._SDN_len = Zapatec.Calendar._MN = Zapatec.Calendar._SMN = Zapatec.Calendar._SMN_len = null