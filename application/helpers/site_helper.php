<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

if ( ! function_exists('trimLongText'))
{
	function trimLongText($message)
	{
		$message=str_replace(PHP_EOL,  ' ', $message);
		$message=str_replace("<br />",  ' ', $message);
		$message=preg_replace("/[\n\r]/",  ' ', $message);
	    $message=trim($message);
		if(mb_strlen($message, 'utf-8')>MAXLENGTHMSG_SHOWN_IN_TABLE)
		{
			$message=trim(substr($message,0,MAXLENGTHMSG_SHOWN_IN_TABLE))."...";
		}
		return $message;
	}
		
}
if(! function_exists('strlen_unicode')){
	function strlen_unicode($str) {
		return count(preg_split(
				'~~u', $str, -1, PREG_SPLIT_NO_EMPTY));
	}

}