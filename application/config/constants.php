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
define('MY_PATH','index.php/');
define('ITEMS_PER_PAGE', 20);
/* End of file constants.php */
/* Location: ./application/config/constants.php */

define("ZeroUpdateRecordError", "No record updated");
define("THUMBNAILSIZEWIDTH", 150);
define("THUMBNAILSIZEHEIGHT", 150);
define("MAINPICSIZEWIDTH", 600);
define("MAINPICSIZEHEIGHT", 600);

define("NUMOFTIMESPOST", 5);
define("NUMOFDAYSFORPOST", 30);
define("PREMIUMPOSTEXPIRYDAYS", 30);
define("GOLDPOSTEXPIRYDAYS", 15);
define("SILVERPOSTEXPIRYDAYS", 1);
define("TOPADS", "topAds");
define("FEATUREDADS", "featuredAds");
define("URGENTADS", "urgentAds");

define("MAXLENGTHMSG_SHOWN_IN_TABLE", 30);

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