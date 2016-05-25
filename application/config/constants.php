<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*
|--------------------------------------------------------------------------
| File and Directory Modes
|--------------------------------------------------------------------------
|
| These prefs are used when checking and setting modes when working
| with the file system.  The defaults are fine on servers with proper
| security, but you may wish (or even need) to change the values in
| certain environments (Apache running a separate process for each
| user, PHP under CGI with Apache suEXEC, etc.).  Octal values should
| always be used to set the mode correctly.
|
*/
define('FILE_READ_MODE', 0644);
define('FILE_WRITE_MODE', 0666);
define('DIR_READ_MODE', 0755);
define('DIR_WRITE_MODE', 0777);

/*
|--------------------------------------------------------------------------
| File Stream Modes
|--------------------------------------------------------------------------
|
| These modes are used when working with fopen()/popen()
|
*/

define('FOPEN_READ',							'rb');
define('FOPEN_READ_WRITE',						'r+b');
define('FOPEN_WRITE_CREATE_DESTRUCTIVE',		'wb'); // truncates existing file data, use with care
define('FOPEN_READ_WRITE_CREATE_DESTRUCTIVE',	'w+b'); // truncates existing file data, use with care
define('FOPEN_WRITE_CREATE',					'ab');
define('FOPEN_READ_WRITE_CREATE',				'a+b');
define('FOPEN_WRITE_CREATE_STRICT',				'xb');
define('FOPEN_READ_WRITE_CREATE_STRICT',		'x+b');
define('MY_PATH','');
define('ITEMS_PER_PAGE',5);
/* End of file constants.php */
/* Location: ./application/config/constants.php */

define("DESCLENGTHINNEWPOST", 450);
define("DESCLENGTHINPROFILE",300);
define("DESCLENGTHINITEMPAGE",300);
define("DESCLENGTHININBOX",300);
define("DESCLENGTHINOUTBOX",300);
define("DESCLENGTHINMYADS",300);
define("DESCLENGTHINARCHIVEADS",300);
define('LOCATIONLEVELSEPARATOR', '&nbsp;');
define('DESCMINLENGTHINNEWPOST', 5);
define('UnReadInBoxBgColor', '#9BCBFF');
define("MAXLENGTHUSERNAME", 20);

define("ZeroUpdateRecordError", "No record updated");
define("THUMBNAILSIZEWIDTH", 300);
define("THUMBNAILSIZEHEIGHT", 300);
define("MAINPICSIZEWIDTH", 600);
define("MAINPICSIZEHEIGHT", 600);

define("NUMOFTIMESPOST", 5);
define("NUMOFDAYSFORPOST", 30);
define("NUMOFDAYSFORPOSTITEMCOMMENTS", 1);
define("NUMOFTIMESPOSTITEMCOMMENTS", 3);
define("PREMIUMPOSTEXPIRYDAYS", 30);
define("REPOSTEXPIRYDAYS", 30);
define("GOLDPOSTEXPIRYDAYS", 15);
define("SILVERPOSTEXPIRYDAYS", 1);
define("TOPADS", "topAds");
define("FEATUREDADS", "featuredAds");
define("URGENTADS", "urgentAds");

define("MAXLENGTHMSG_SHOWN_IN_TABLE", 300);
define("MAXLENGTHMSG_SHOWN_IN_COMMENTS_TABLE", 30);
define("SHOW_BRACKETS_INDEX_PAGE", 0);
define("SHOW_BRACKETS_SEARCH_PAGE", 0);
define("SHOW_BRACKETS_PROFILE_PAGE", 0);
define("MAXSOLDQTY", 10);

define("TITLECOLOR", "RED");
define("PASSWORDEXPIRYDAYS", 30);
define("DIRECTSENDEXPIRYDAYS", 30);

define("PageContactUs",  "ContactUs");
define("PageSignup", "Signup");
define("PageSignin", "Signin");
define("PageSearch", "Search");
define("PageViewItem", "ViewItem" );
define("PageViewProfile", "ViewProfile" );

define("MAXTIMESDAILY_MARKSOLDPERPOST", 10 );
define("MAXTIMESDAILY_SENDFROMBUYER", 10);
define("MAXTIMESDAILY_REPLYFROMSELLER", 10);
define("MAXTIMESDAILY_DELETEADS",10);

define("MAXTIMEDAILY_DRECTSENDFROMBUYER", 3);
define("MAXTIMEDAILY_SENDMSGFROMBUYER", 3);
define("MAXTIME_SENDMSGFROMBUYER", 10);
define("UNLIMITEDTIMES", 9999);

define("MAXDAYSACTIVATEUSEREXPIRYDAYS", 30);
define("MINCOUNTSHOWREMAINTIMES", 5);
define("MINPRICERANGE", 20);
define("MAXPRICERANGE", 2000);

define("SMTP_PROTOCOL" , "smtp");
define("SMTP_HOST", "ssl://a2plcpnl0127.prod.iad2.secureserver.net" );
define("SMTP_PORT", "465");
define("SMTP_USER", "noreply@girlstrade.com");
define("SMTP_PASSWORD","Eclipse2000" );
define("HOST_EMAIL", "ryanfung@gmail.com");
define("INVALIDUSERNAME", "INVALIDUSERNAME");
define("ACTIVATEUSERNAME", "ACTIVATEUSERNAME");
define("INCORRECTPASSWORD", "INCORRECTPASSWORD");
define("UNKNOWNLOGINERROR", "UNKNOWNLOGINERROR");

define("SHOWQTY", "N");
define("SHOWLASTACTIVITY", "N");
define("SHOWVISITCOUNTINITEMPAGE", "N");
define("SHOWSELLERNAMEINSEARCHBUTTON","N");
define("NONEEDVERIFYITEMCOMMENT", "Y");
define("SHOWBUYERINFORMATION", "Y");

// GETAMDIN
define("APPROVETRADECOMMENT", "APPROVETRADECOMMENT");
define("REJECTTRADECOMMENT", "REJECTTRADECOMMENT");
define("APPROVEFEEDBACK", "APPROVEFEEDBACK");
define("REJECTFEEDBACK", "REJECTFEEDBACK");
define("REJECTITEMCOMMENT", "REJECTITEMCOMMENT" );
define("APPROVEITEMCOMMENT","APPROVEITEMCOMMENT");
define("APPROVEABUSE", "APPROVEABUSE");
define("REJECTABUSE", "REJECTABUSE");
define("APPROVEPOST","APPROVEPOST");
define("REJECTPOST","REJECTPOST");
define("APPROVEUSERPHOTO", "APPROVEUSERPHOTO");
define("REJECTUSERPHOTO", "REJECTUSERPHOTO");
// HOME
define("SIGNUPSENDEMAIL", "SIGNUPSENDEMAIL");
define("FORGETPASSWORDSENDEMAIL", "FORGETPASSWORDSENDEMAIL");
define("RESETPASSWORDSENDEMAIL","RESETPASSWORDSENDEMAIL");
define("CHANGEPASSWORDSENDEMAIL", "CHANGEPASSWORDSENDEMAIL");
define("UPDATEPASSWORDSENDEMAIL", "UPDATEPASSWORDSENDEMAIL");

// MESSAGES
define("DIRECTSENDEMAIL", "DIRECTSENDEMAIL");
define("DELETEABUSEMESSAGESENDEMAIL", "DELETEABUSEMESSAGESENDEMAIL");
define("INSERTABUSEMESSAGESENDEMAIL", "INSERTABUSEMESSAGESENDEMAIL");
define("INSERTMESSAGESENDEMAIL","INSERTMESSAGESENDEMAIL");
define("APPROVEDIRECTSEND", "APPROVEDIRECTSEND");
define("REJECTDIRECTSEND", "REJECTDIRECTSEND");
define("REPLYMESSAGESENDEMAIL", "REPLYMESSAGESENDEMAIL");
define("sendEmailForApproveReject", "sendEmailForApproveReject");		

